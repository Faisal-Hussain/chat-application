<?php

namespace App\Http\Controllers;

use App\Events\IsOnline;
use App\Models\PeriodVipUser;
use App\Models\Report;
use App\Models\User;
use App\Models\UserSetting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
        $admin = auth()->user()->load(['country','setting']);
        $allUsers = User::query()->with(['country', 'roles'])->whereHas('roles', function ($q) {
            $q->where('name', '!=', 'admin');
        })->paginate(50, ['*'], 'first');

        $normalUsers = User::query()->with(['country', 'roles'])->whereHas('roles', function ($q) {
            $q->where('name', '=', 'basic');
        })->paginate(50, ['*'], 'second');

        $vipUsers = User::query()->with(['country', 'roles'])->whereHas('roles', function ($q) {
            $q->where('name', '=', 'vip');
        })->paginate(50, ['*'], 'third');

        $reportUsers = Report::query()->with(['from.country', 'to.country', 'to.roles'])
            ->paginate(50, ['*'], 'reports');
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
            'start_date' =>  Carbon::today(),
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
            if($request->block !='f'){
                $rpt->block_release_date=strtotime('+24 hour',time());
            }
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


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeSetting(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 404);
        }

        UserSetting::query()->where('user_id', Auth::id())
            ->update([$request->type => (integer)$request->status]);
        broadcast(new IsOnline());
        return response()->json('Setting updated successfully.', 200);
    }



    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeParams(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nick_name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'The nick name field is required.'], 404);
        }

        $user = User::query()->where('id', '!=', Auth::id())
            ->where('nick_name', $request->nick_name)->first();

        if($user) {
            return response()->json(['error' => 'Nick name already taken.'], 400);
        }

        $admin = Auth::user();
        $admin->nick_name = $request->nick_name;

        if($request->has('password') and $request->password) {
            $admin->password = bcrypt($request->password);
        }
        $admin->save();

        return response()->json('Params updated successfully.', 200);
    }


    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function reportRemove($id)
    {
        Report::query()->where('id', '=', $id)->delete();
        return response()->json('Params updated successfully.', 200);
    }


}
