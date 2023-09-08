<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $tasks = Task::all();
        $tasks = Task::orderBy('created_at', 'desc')->get();
        return response()->json($tasks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {
            if ($request->hasFile('image')) {
                // ファイルをpublicディレクトリに保存
                Log::debug($request);

                $imagePath = $request->file('image')->store('public');

                // 保存したファイルのURLを取得
                $imageUrl = asset(str_replace('public', 'storage', $imagePath));

                $task = $request->task;
                $description = $request->description;

                // 画像パスとタスク情報をデータベースに保存するなどの処理を追加できます
                $tasks = Task::create([
                    'task' => $task,
                    'description' => $description,
                    'image_path' => $imageUrl,
                ]);

                return response()->json($tasks);
            } else {
                return response()->json(['message' => 'ファイルが選択されていません'], 400);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'アップロードに失敗しました'], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::find($id);
        return response()->json($task);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $task = Task::find($id);
        if (!$task) {
            return response()->json(['message' => 'task not found'], 404);
        }

        $task->update([
            'task' => $request->input('task'),
        ]);
        return response()->json($task);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        if (!$task) {
        // タスクが見つからない場合のエラーハンドリング
        return response()->json(['message' => 'Task not found'], 404);
        }

        $task->delete();

        return response()->json($task);
    }
}
