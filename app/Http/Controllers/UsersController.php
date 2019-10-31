<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\users\UpdateProfileRequest;
class UsersController extends Controller
{
    public function index()
    {
        return view('users.index')->with('users', User::all());
    }
    public function makeAdmin(User $user)
    {
        $user->role = 'admin';
        $user->save();
        session()->flash('success', 'User made admin successfully');
        return redirect(route('users.index'));
    }
    public function editProfile()
    {
        return view('users.edit')->with('users', auth()->user());
    }
    public function updateProfile(UpdateProfileRequest $request)
    {
        $user = auth()->user();
        $user->update([
            'name' => $request->name,
            'about' => $request->about,
        ]);
        session()->flash('success', 'User Update Successfully');
        return redirect(route('users.index'));
    }
}
