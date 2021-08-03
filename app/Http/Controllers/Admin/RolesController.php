<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use function GuzzleHttp\json_encode;

class RolesController extends Controller
{
    public function index()
    {
        $roles = Role::orderByDesc('id')->paginate(10);
        $count = Role::count();

        return view('pages.admin.roles.index', [
            'roles' => $roles,
            'count' => $count
        ]);
    }

    public function create()
    {
        return view('pages.admin.roles.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => ['required', 'unique:roles', 'max:255'],
            'permissions' => ['required'],
        ]);

        $role = new Role();
        $role->title = $request->input('title');
        $role->permissions = json_encode($request->input('permissions'));
        $role->save();

        return back()->with('success', trans('words.item.created'));
    }

    public function edit(Role $role)
    {
        return view('pages.admin.roles.edit', [
            'role' => $role,
        ]);
    }

    /**
     * @param Role $role
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Role $role, Request $request)
    {
        $this->validate($request, [
            'title' => ['required' , Rule::unique('roles')->ignore($role->id)],
            'permissions' => ['required']
        ]);

        $role->title = $request->input('title');
        $role->permissions = json_encode($request->input('permissions'));
        $role->save();

        return back()->with('success', trans('words.item.updated'));
    }

    /**
     * @param $role
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(int $role)
    {
        Role::whereId($role)->delete();

        return back()->with('success', trans('words.item.deleted'));
    }
}
