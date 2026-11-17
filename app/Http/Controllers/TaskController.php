<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected function getAllTasks()
    {
        return Task::leftJoin('users', 'tasks.user_id', 'users.id')
            ->select(
                'tasks.id',
                'tasks.name',
                'tasks.due_at',
                'tasks.status',
                'users.name as responsavel'
            )
            ->get();
    }

    // Listar todas as tarefas
    public function allTasks()
    {
        $tasksFromDB = $this->getAllTasks();

        return view('tasks.alltasks', compact('tasksFromDB'));
    }

    // Carregar formulário de criação com os usuarios
    public function createTasks()
    {
        $users = User::all();

        return view('tasks.addtasks', compact('users'));
    }

    // Guardar nova tarefa
    public function storeTasks(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'due_at' => 'required|date',
            'status' => 'required|integer|in:0,1',
            'user_id' => 'required|exists:users,id',
        ]);

        Task::insert([
            'name' => $request->name,
            'due_at' => $request->due_at,
            'status' => $request->status,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('tasks.all')->with('message','Tarefa adicionada com sucesso!');
    }

    // Editar tarefa
    public function editTasks(int $id)
    {
        $taskInfo = Task::where('id', $id)
            ->select('id', 'name', 'due_at', 'status', 'user_id')
            ->first();

        return view('tasks.edittask', compact('taskInfo'));
    }

    // Eliminar tarefa
    public function deleteTasks(int $id)
    {
        Task::where('id', $id)->delete();

        return back();
    }
}
