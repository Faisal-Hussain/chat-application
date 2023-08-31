<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\BlockUser;
use App\Models\Conversation;
use App\Models\Country;
use App\Models\Message;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function search(Request $request)
    {
        $min = $request->min;
        $max = $request->max;
        $nickName = $request->nick_name;
        $country = $request->country;
        $countries = Country::query()->orderBy('name', 'asc')->get()->toArray();
        $gender = $request->gender;
        $users = [];
        if(count($request->all()) > 0) {
            $users = User::query()->with('country')->where('id', '!=', Auth::id())
                ->when($min, function ($q) use ($min) {
                    return $q->where('age', '>=', $min);
                })->when($max, function ($q) use ($max) {
                    return $q->where('age', '<=', $max);
                })->when($nickName, function ($q) use ($nickName) {
                    return $q->where('nick_name', 'LIKE', '%'.$nickName.'%');
                })->when($country, function ($q) use ($country) {
                    return $q->whereHas('country', function ($qu) use ($country){
                        $qu->where('id', '=', $country);
                    });
                })->when($gender, function ($q) use ($gender) {
                    return $q->where('gender', '=', $gender);
                })->get()->toArray();
        }
        return view('pages.search', compact('countries', 'users'));
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function chat(Request $request, $id)
    {
        if($id == Auth::id()){
            return redirect()->route('home');
        }

        $user = User::query()->with(['country', 'roles'])->findOrFail($id);
        $conversation_1 = Conversation::where(['from_id' => Auth::id(), 'to_id' => (int) $id])->first();
        $conversation_2 = Conversation::where(['from_id' => (int) $id, 'to_id' => Auth::id()])->first();

        $check_conversation = $conversation_1 ? $conversation_1 : $conversation_2;

        if($check_conversation){
            $conversation = $check_conversation;
        }else {
            $conversation = Conversation::create([
                'from_id' => Auth::id(),
                'to_id' => $id,
            ]);
        }
        $conversationId = $conversation->id;

        Message::query()->where('from_id', $id)->where('to_id', Auth::id())->update([
            'read' => Message::READED
        ]);

        return view('pages.chat', compact('conversationId', 'user'));
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function chatHistory()
    {
        $conversation_1 =  Conversation::query()->whereHas('messages')
            ->where('from_id',  Auth::id())->pluck('to_id')->toArray();
        $conversation_2 = Conversation::query()->whereHas('messages')->where('to_id',  Auth::id())->pluck('from_id')->toArray();
        $data = array_unique(array_merge($conversation_1,  $conversation_2));
        $users = User::query()->with('country')->whereIn('id', $data)->get()->toArray();
        return view('pages.chat_history', compact('users'));
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function inbox()
    {
        return view('pages.inbox');
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function blockUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 404);
        }

        $user = User::query()->with('roles')->where('id', $request->id)->first();

        if($user->roles[0]['name']  != 'admin')  {
            BlockUser::query()->create([
                'from_id' => Auth::id(),
                'to_id' => $request->id,
            ]);

            Message::query()->where('from_id', $request->id)
                ->where('to_id', Auth::id())
                ->update(['read' => Message::READED]);
        }


        return response()->json('User blocked successfully!', 200);
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function messages(Request $request, $id)
    {
        User::query()->findOrFail($id);
        $conversation_1 = Conversation::where(['from_id' => Auth::id(), 'to_id' => (int) $id])->first();
        $conversation_2 = Conversation::where(['from_id' => (int) $id, 'to_id' => Auth::id()])->first();

        $check_conversation = $conversation_1 ? $conversation_1 : $conversation_2;

        if($check_conversation){
            $conversation = $check_conversation;
        }else {
            $conversation = Conversation::create([
                'from_id' => Auth::id(),
                'to_id' => $id,
            ]);
        }
        $conversationId = $conversation->id;

        $messages = Message::query()->with(['media'])->where('conversation_id', $conversationId)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return $messages;
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function messagesAllRead(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 404);
        }

        Message::query()->where('from_id', $request->id)
                        ->where('to_id', Auth::id())
                        ->update(['read' => Message::READED]);
        return response()->json('User all message mark as read successfully!', 200);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function messageSend(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'recipient_id' => 'required',
            'conversationId' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 404);
        }

        if (! $request->has('message') and ! $request->file('file')) {
            return response()->json('Message or image is required!', 404);
        }

        $data =  Message::query()->create([
            'conversation_id' => request('conversationId'),
            'message' => request('message'),
            'from_id' => Auth::id(),
            'to_id' =>  request('recipient_id'),
        ]);

        if($request->file('file')) {
            foreach ($request->file('file') as $file) {
                $data->addMedia($file)->toMediaCollection('image');
            }
        }

        $info = Message::query()->with(['media'])->where('id', $data->id)->first();
        $recipient = User::query()->find( request('recipient_id'));

        $notificationUsers = FunctionController::getNotificationUsers(request('recipient_id'));
        broadcast(new MessageSent($recipient, $info, $notificationUsers));
        return response()->json($info, 200);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function reportSend(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'message' => 'required',
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 404);
        }

        Report::query()->create([
            'from_id' => Auth::id(),
            'to_id' => $request->id,
            'message' => $request->message,
        ]);

        return response()->json('Report created successfully.', 200);
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function onlineUsers()
    {
        $data = FunctionController::getOnlineUsers();
        return response()->json($data, 200);
    }
}
