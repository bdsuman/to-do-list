<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Resources\TaskCollection;

class TaskController extends Controller
{

    function TaskCreate(Request $request){
        $user_id=$request->header('id');
        Task::create([
            'title'=>$request->input('title'),
            'description'=>$request->input('description'),
            'completed'=>$request->input('completed'),
            'user_id'=>$user_id
        ]);
        return $this->success('Task Successfull Created');
    }


    function TaskList(Request $request){
        $user_id=$request->header('id');
        $tasks = Task::where('user_id',$user_id)->get();
        return new TaskCollection($tasks);

    }


    function TaskDelete(Request $request){
        $Task_id=$request->input('id');
        $user_id=$request->header('id');
        Task::where('id',$Task_id)->where('user_id',$user_id)->delete();
        return $this->success('Task Successfull Deleted');
    }


     function TaskUpdate(Request $request){
        $Task_id=$request->input('id');
        $user_id=$request->header('id');
        return Task::where('id',$Task_id)->where('user_id',$user_id)->update([
            'title'=>$request->input('title'),
            'description'=>$request->input('description'),
            'completed'=>$request->input('completed'),
        ]);
        return $this->success('Task Successfull Updated');
    }



}
