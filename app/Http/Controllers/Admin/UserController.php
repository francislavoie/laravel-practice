<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\UserAddress;

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

        $request->validate([
            'username' => 'required|string|max:255|unique:users,username' . $user->id,
            'email' => 'required|string|email|max:255|unique:users,email' . $user->id,
            'user_roles_id' => 'required|integer',
            'address.user_id' => 'required|integer',
            'address.address' => 'required|string|max:255',
            'address.city' => 'required|string|max:255',
            'address.province' => 'required|string|max:255',
            'address.country' => 'required|string|max:255',
            'address.postal_code' => 'required|string|max:255',
        ]);

        // Update the user model with form inputs
        // Filter out the address from submission
        $user->update(collect($request->all())->except('address')->toArray());

        if (! $user->address) {
            // If the user doesn't have an address, then create one
            $user->address = UserAddress::create(collect($request->all())->only('address')->get('address'));
        } else {
            // Update the user's address
            $user->address->update(collect($request->all())->only('address')->get('address'));
        }

        return redirect(\Auth::user()->isAdmin() ? '/admin/users' : '/home')
            ->with('status', "Successfully updated user $user->username.")
            ->with('status-mode', 'success');
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
