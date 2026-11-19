<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use GuzzleHttp\Psr7\Query;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function allUsers()
    {
        $usersWDB = $this->loadUsersWDB();

        $searchPar = request()->query('search')?request()->query('search'):null;

        $query = User::select('id', 'name', 'nif', 'address', 'email');

        if($searchPar){
            $query->where('name','LIKE' , "%{$searchPar}%")
            ->orWhere('email','LIKE' , "%{$searchPar}%");
        }

        $usersFromDB = $query->get();

        // dd($usersFromDB);

        return view('users.allusers', compact('usersWDB', 'usersFromDB'));
    }

    public function addUsers()
    {
        return view('users.addusers');
    }

    public function deleteUser(int $id)
    {
        Task::where('user_id', $id)->delete();
        User::where('id', $id)->delete();
        return back();
    }

    public function editUser(int $id)
    {
        $userInfo = User::where('id', $id)->select('name', 'email', 'id', 'address', 'nif')->first();

        return view('users.edituser', compact('userInfo'));
    }

    public function storeUser(Request $request)
    {
        //validar dados no servidor
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'min:8|required'
        ]);

        //inserir na db
        User::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('users.all')->with('message', 'utilizador adicionado com sucesso!');
    }

    public function updateUser(Request $request)
    {
        User::where('id', $request->id)->update([
            'name' => $request->name,
            'address' => $request->address,
            'nif' => $request->nif,
        ]);

        return redirect()->route('users.all')->with('message', 'user actualizado com sucesso!');
    }

    private function loadUsersWDB()
    {
        $usersWithoutDB = [
            ['id' => 1, 'name' => 'Sara', 'email' => 'sara@gmail.com'],
            ['id' => 2, 'name' => 'Bruno', 'email' => 'bruno@gmail.com'],
            ['id' => 3, 'name' => 'Marco', 'email' => 'marco@gmail.com'],
            ['id' => 4, 'name' => 'António', 'email' => 'antónio@gmail.com']
        ];
        return $usersWithoutDB;
    }
}
