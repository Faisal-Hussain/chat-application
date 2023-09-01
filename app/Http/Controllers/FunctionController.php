<?php

namespace App\Http\Controllers;

use App\Models\BlockUser;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class FunctionController extends Controller
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
     * @return array
     */
    public static function getOnlineUsers($type='array')
    {
        $data = [];

        $users = User::query()->with('setting')->where('id', '!=', Auth::id())->get();

        foreach ($users as $user) {
            if (Cache::has('user-online' . $user->id)) {
                if($user->setting){
                    if($user->setting->visible_chat_mode == 1) {
                        $data[]=$user->id;
                    }
                }else {
                    $data[]=$user->id;
                }

            }
        }

        if($type=='array'){
            $onlineUsers = User::query()->with(['country', 'setting'])->whereIn('id', $data)->get()->toArray();
        }elseif($type == 'obj'){
            $onlineUsers = User::query()->with(['country', 'setting'])->whereIn('id', $data)->get();
        }

        return $onlineUsers;
    }


    /**
     * @param $id
     * @return array
     */
    public static function getNotificationUsers($id)
    {
        $blockUserFrom = BlockUser::query()->where('from_id', '=',  $id)->pluck('to_id')->toArray();
        $blockUserTo = BlockUser::query()->where('to_id', '=',  $id)->pluck('from_id')->toArray();
        $blockUsers = array_unique(array_merge($blockUserFrom, $blockUserTo));
        $messagesUsersId = Message::query()
            ->where('to_id', '=', $id)
            ->where('read', '!=', Message::READED)
            ->whereNotIn('from_id',$blockUsers)
            ->pluck('from_id')->toArray();

        $users = User::query()->with('country')->whereIn('id', $messagesUsersId)->get()->toArray();

        return $users;
    }
}
