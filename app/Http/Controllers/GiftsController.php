<?php

namespace App\Http\Controllers;

use App\Models\Gift;
use App\Models\User;
use Illuminate\Http\Request;

class GiftsController extends Controller
{
    protected function getAllGifts()
    {
        return Gift::leftJoin('users', 'christmas_gifts.user_id', 'users.id')
            ->select(
                'christmas_gifts.id',
                'christmas_gifts.gift_name',
                'christmas_gifts.expected_value',
                'christmas_gifts.actual_value',
                'users.name as responsavel'
            )
            ->get();
    }

    public function allGifts()
    {
        $giftsFromDB = $this->getAllGifts();
        // dd($giftsFromDB);
        return view('gifts.allgifts', compact('giftsFromDB'));
    }

    public function addGifts()
    {
        $users = User::all();
        return view('gifts.addgifts', compact('users'));
    }

    public function storeGifts(Request $request)
    {
        $request->validate([
            'gift_name' => 'required|string|max:255',
            'expected_value' => 'required|numeric|min:0',
            'user_id' => 'required|exists:users,id',
            'actual_value' => 'nullable|numeric|min:0',
        ]);

        Gift::insert([
            'gift_name' => $request->gift_name,
            'expected_value' => $request->expected_value,
            'user_id' => $request->user_id,
            'actual_value' => $request->actual_value,
        ]);

        return redirect()->route('gifts.all')
            ->with('message', 'Prenda adicionada com sucesso!');
    }

    public function editGifts(int $id)
    {
        $giftInfo = Gift::leftJoin('users', 'christmas_gifts.user_id', 'users.id')
            ->where('christmas_gifts.id', $id)
            ->select(
                'christmas_gifts.id',
                'christmas_gifts.gift_name',
                'christmas_gifts.expected_value',
                'christmas_gifts.actual_value',
                'users.name as responsavel'
            )
            ->first();

            $users = User::all();

        return view('gifts.editgift', compact('giftInfo', 'users'));
    }

    public function updateGifts(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:christmas_gifts,id',
            'gift_name' => 'required|string|max:255',
            'expected_value' => 'required|numeric|min:0',
            'user_id' => 'required|exists:users,id',
            'actual_value' => 'nullable|numeric|min:0',
        ]);

        Gift::where('id', $request->id)->update([
            'gift_name' => $request->gift_name,
            'expected_value' => $request->expected_value,
            'user_id' => $request->user_id,
            'actual_value' => $request->actual_value,
        ]);

        return redirect()
            ->route('gifts.all')
            ->with('message', 'Prenda atualizada com sucesso!');
    }

    public function deleteGifts(int $id)
    {
        Gift::where('id', $id)->delete();

        return back();
    }
}
