<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Message;
use App\Models\Theme;
use App\Services\EmployeeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{

    public function create(Request $request){
        $chat=$request->chat_id;
        $chatModel = Chat::findOrFail($chat);
        if ($chatModel->theme->status != "process")
            return redirect()->back()->withErrors('Jarayon tugatilgan!');
        $message = new Message();
        $message->chat_id=$chat;
        $message->message=$request->message;
        $message->type=$request->type;
        $message->save();
        if ($request->type=='0')
            return redirect()->back();
        else
            return redirect()->route('chat',$chat);
    }
    public function show($id){
        $user = Auth::user();
        $data = json_decode($user->data);
        $messages= Message::all()->where('chat_id',$id);
        $chat_id=$id;
        $student_name=Theme::all()->where('id',Chat::all()->where('id',$id)->first()->theme_id)->first()->student_name;
        $teacher_name=$data->name;
        $messages_status=Message::all()->where('chat_id',$chat_id)->where('type','0');
        $messages_status->each(function ($item){
            $item->is_read=true;
            $item->save();
        });
        return view('admin.chats.show',compact('messages','chat_id','student_name','teacher_name'));
    }
    public function showChatForStudent($theme_id){
//        $user = Auth::user();
//        $data = json_decode($user->data);

        $theme=Theme::FindOrFail($theme_id);
        $chat = Chat::all()->where('theme_id',$theme->id)->first();
        if ($chat == null) abort(404);
        $chat_id = $chat->id;
        $messages= Message::all()->where('chat_id',$chat_id);
        $student_name=$theme->student_name;
        $teacher_name=EmployeeService::getEmployeeForId($theme->teacher_id);
        $messages_status=Message::all()->where('chat_id',$chat_id)->where('type','1');
        $messages_status->each(function ($item){
            $item->is_read=true;
            $item->save();
        });
        return view('admin.chats.show-student',compact('messages','chat_id','student_name','teacher_name'));
    }
}
