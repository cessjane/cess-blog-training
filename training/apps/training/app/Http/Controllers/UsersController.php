<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\Password;
use App\Http\Resources\UserCollection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = new UserCollection(User::paginate(10));

        return Inertia::render('User/Index', [
            'can' => [
                'add_user' => Gate::inspect('add-user'),
            ],
            'users' => $users,
            'create_url' => URL::route('users.create'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('User/UsersCreate');
    }

    /**
     * Store a newly created resource or update existing in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Check authorization
        if (!Gate::allows('add-user')) {
            abort(403, 'Unauthorized action.');
        }

        // Error when updating the same username
        $request->validate([
            'user_name' => ['required', 'max:50', 'unique:users,user_name'],
            'first_name' => ['required', 'max:50'],
            'last_name' => ['required', 'max:50'],
            'role' => ['required'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        User::updateOrCreate(['id' => $request->id], [
                'user_name' => $request->user_name,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ],
        );

        // Show flash message 
        self::success('Successfully created a user.');
        return Redirect::route('users.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return Inertia::render('User/UsersEdit', [
            'user' => User::find($id),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Check authorization
        if (!Gate::allows('delete-user')) {
            abort(403, 'Unauthorized action.');
        }

        User::destroy($id);

        // Show flash message 
        self::success('Successfully deleted a user.');
        return Redirect::route('users.index');
    }
}
