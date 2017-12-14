<?php

namespace App\Http\Controllers\adminpanel;

use App\Http\Requests\UserDestroyRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends AdminpanelController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->paginate($this->limit);

        $usersCount = $users->count();

        return view('adminpanel.users.index', compact('users', 'usersCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();

        return view('adminpanel.users.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {


        $user = User::create($request->all());

        $user->attachRole($request->role);
        $user->attachPermission($request->role);

        return redirect('adminpanel/users')->with('message', 'new User created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrfail($id);

        return view('adminpanel.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $user = User::findOrFail($id);

        $user->update($request->all());

        $user->detachRole($user->role);
        $user->attachRole($request->role);

        return redirect('adminpanel/users')->with('message', 'user update successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserDestroyRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $deleteOption = $request->delete_option;
        $selectedUser = $request->seleceted_user;


        if ($deleteOption == 'delete') {
            //delete user posts

            $user->posts()->withTrashed()->forceDelete();

        } elseif ($deleteOption == 'attribute') {


            $user->posts()->update(['author_id' => $selectedUser]);


        }

         $user->fresh();
         $user->delete();


        return redirect('adminpanel/users')->with('message', 'User Has been deleted successfully');
    }

    public function confirm(UserDestroyRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $users = User::where('id', '!=', $user->id)->pluck('name', 'id');

        return view('adminpanel.users.confirm', compact('user', 'users'));

    }
}
