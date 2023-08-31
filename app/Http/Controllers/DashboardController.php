<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\BlockUser;
use App\Models\Conversation;
use App\Models\Country;
use App\Models\Message;
use App\Models\PeriodVipUser;
use App\Models\Report;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function dashboard(Request $request)
    {
        $admin = auth()->user()->load(['country']);
        $allUsers = User::query()->with(['country', 'roles'])->whereHas('roles', function ($q) {
            $q->where('name', '!=', 'admin');
        })->paginate(5, ['*'], 'first');

        $normalUsers = User::query()->with(['country', 'roles'])->whereHas('roles', function ($q) {
            $q->where('name', '=', 'basic');
        })->paginate(5, ['*'], 'second');

        $vipUsers = User::query()->with(['country', 'roles'])->whereHas('roles', function ($q) {
            $q->where('name', '=', 'vip');
        })->paginate(5, ['*'], 'third');

        $reportUsers = Report::query()->with(['from.country', 'to.country', 'to.roles'])
            ->paginate(5, ['*'], 'reports');
        $pageName = $request->page_name;
        return view('pages.admin.dashboard', compact('admin', 'allUsers', 'normalUsers', 'vipUsers', 'pageName', 'reportUsers'));
    }


    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function user($id)
    {
        $user = User::query()->with(['country', 'roles', 'periodVipUser'])->where('id', $id)->first()->toArray();
        return response()->json($user, 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeRole(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'start' => 'required',
            'end' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 404);
        }

        $user = User::query()->findOrFail($request->id);
        $user->syncRoles(['vip']);

        PeriodVipUser::query()->updateOrCreate([
            'user_id' => $request->id,
        ],[
            'start_date' =>  $request->start,
            'end_date' =>  $request->end,
        ]);

      return response()->json('Vip period added successfully.', 200);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function blockOrUnblockUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 404);
        }
        $rpt = User::query()->find($request->id);

        if ($rpt->blocked == 1) {
            $rpt->update(['blocked' => 0]);
        }else {
            $rpt->update(['blocked' => 1]);
        }


        return response()->json('User status changed  successfully.', 200);
    }


    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function report($id)
    {
        $report = Report::query()->with(['from.country', 'to.country', 'to.roles'])->where('id', $id)->first()->toArray();
        return response()->json($report, 200);
    }


}
