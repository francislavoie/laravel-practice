<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    /**
     * Show the list of users
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(\Auth::user()->cannot('user_management_access'), 403, 'Unauthorized.');

        return view('admin.users.index', [
        	'users' => User::all()
        ]);
    }

    public function view(User $user)
    {
        abort_if(\Auth::user()->cannot('user_view', $user), 403, 'Unauthorized.');

        return view('admin.users.view', compact('user'));
    }

    public function editView(User $user)
    {
        abort_if(\Auth::user()->cannot('user_edit', $user), 403, 'Unauthorized.');

        return view('admin.users.edit', compact('user'));
    }

    public function edit(Request $request, User $user)
    {
        abort_if(\Auth::user()->cannot('user_edit', $user), 403, 'Unauthorized.');

        // TODO: Handle editing
    }

    public function delete(User $user)
    {
        abort_if(\Auth::user()->cannot('user_delete', $user), 403, 'Unauthorized.');

        $user->delete();

        return redirect('/admin/users')
            ->with('status', "Deleted user $user->username.")
            ->with('status-mode', 'info');
    }
}
