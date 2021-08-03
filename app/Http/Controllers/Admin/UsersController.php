<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Exception;
use Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::orderBy('last_name')->paginate(10);
        $count = User::count();

        return view('pages.admin.users.index', [
            'users' => $users,
            'count' => $count
        ]);
    }

    public function create()
    {
        return view('pages.admin.users.create', [
            'roles' => Role::all(),
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => ['nullable', 'max:255'],
            'last_name' => ['nullable', 'max:255'],
            'email' => ['nullable', 'email', 'unique:users', 'max:255'],
            'cellphone' => ['required', 'cellphone', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:8'],
            'role' => ['nullable', 'exists:roles,id'],
        ]);

        $user = new User();
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->email_verified_at = now();
        $user->cellphone = $request->input('cellphone');
        $user->cellphone_verified_at = now();
        $user->password = Hash::make($request->input('password'));
        $user->save();

        if ($role = $request->input('role')) {
            $user->roles()->save(Role::findOrFail($role));
        }

        return back()->with('success', trans('users.registered'));
    }

    public function edit(User $user)
    {
        return view('pages.admin.users.edit', [
            'user' => $user,
            'roles' => Role::all(),
        ]);
    }

    /**
     * @param User $user
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(User $user, Request $request)
    {
        $this->validate($request, [
            'first_name' => ['nullable', 'max:255'],
            'last_name' => ['nullable', 'max:255'],
            'email' => ['nullable', 'email', Rule::unique('users')->ignore($user->id), 'max:255'],
            'cellphone' => ['required', 'cellphone', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable', 'confirmed', 'min:8'],
            'role' => ['nullable', 'exists:roles,id'],
        ]);

        $user->roles()->detach();
        if ($role = $request->input('role')) {
            $user->roles()->save(Role::findOrFail($role));
        }

        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->cellphone = $request->input('cellphone');

        if ($request->input('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        $user->save();

        return back()->with('success', trans('users.updated'));
    }

    /**
     * @param $user
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(int $user)
    {
        User::whereId($user)->delete();

        return back()->with('success', trans('users.deleted'));
    }
}
