<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Task;
use DB;
use Exception;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $task_list = Task::get();
        $daterange = $request->daterange;

        if ($daterange) {
            $date_from = substr($daterange, 0, 10);
            $date_to = substr($daterange, 13);
            $date_to = date('Y-m-d', strtotime($date_to . "+1 days"));
            //$reloads = $reloads->whereBetween('created_at', [$date_from, $date_to]);
        }
        return view('backend.task.list', ['task_list' => $task_list, 'daterange' => $daterange]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.task.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = "";
        DB::beginTransaction();
        try {
            $task = new Task();
            $task->no = $request->no;
            $task->amount = $request->amount;
            $task->note = $request->note;
            $task->save();
            $message = 'Adding Successful';
            DB::commit();
        } catch (Exception $ex) {
            DB::rollBack();
            $message = 'Adding Unsuccessful';
        }
        return redirect('admin/task')->withFlashSuccess($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return view('backend.task.view', ['task' => $task]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $message = "";
        DB::beginTransaction();
        try {
            $task->no = $request->no;
            $task->amount = $request->amount;
            $task->note = $request->note;
            $task->save();
            $message = 'Update Successful';
            DB::commit();
        } catch (Exception $ex) {
            DB::rollBack();
            $message = 'Update Unsuccessful';
        }
        return redirect('admin/client')->withFlashInfo($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        try {
            $task->delete();
            $this->message = "Delete successful";
        } catch (Exception $ex) {
            $this->message = "Delete Unsuccessful. You are not the owner.";
            $this->code = 401;
        }
        return redirect('admin/task')->withFlashInfo($this->message);
    }
}
