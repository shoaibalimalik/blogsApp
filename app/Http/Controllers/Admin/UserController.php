<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index() : View
    {
        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    public function create() : View
    {
        return view('admin.users.create');
    }

    public function store(StoreUserRequest $request) : RedirectResponse
    {
        $validatedData = $request->validated();
        $validatedData['password'] = bcrypt($validatedData['password']);
        $user = User::create($validatedData);

        return redirect()->route('admin.users.index')->with('message', 'User was created successfully');
    }

    public function edit(User $user) : View
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user) : RedirectResponse
    {

        $validatedData = $request->validated();
        if(!is_null($validatedData['password'])){
            $validatedData['password'] = bcrypt($validatedData['password']);
        }else{
            unset($validatedData['password']);
        }

        $user->update($validatedData);

        return redirect()->route('admin.users.index')->with('message', 'User was updated successfully');;
    }

    public function destroy(User $user)
    {
        $user->delete();

        return back();
    }
}
