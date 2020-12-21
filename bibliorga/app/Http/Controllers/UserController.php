<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    protected $_paginate = 15;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UserRepository $repository)
    {
        $users = $repository->getPaginate($this->_paginate);
        return view('dashboard.users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, UserRepository $repository, $id)
    {
        $profile_image_name = null;
        $attachment_image_name = null;
        $user = User::find($id);
        if ($request->hasFile('profile_image')) {
            //upload a new image
            $file = $request->file('profile_image');
            $profile_image_name = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move(public_path(config('image.path_user_profile_image')), $profile_image_name);
            //Delete late image
            if ($user->image){
                unlink(public_path($user->profile_image));
            }
        } else if ($request->hasFile('attachment_image')) {
            $file = $request->file('attachment_image');
            $attachment_image_name = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move(public_path(config('image.path_user_attachment_image')), $attachment_image_name);
        }

        // Check if user wants change his role
        if ($request->has('role') && !Auth::user()->isAdmin()) //Just the admin can change the role of a user
            return redirect(url()->previous())->withErrors('Désolé vous n\'avez pas les permissins requis, pour changer de role.');

        // Update datas in DB
        $repository->update($id, [
            'firstname' => $request->has('firstname') ? $request->input('firstname') : $user->firstname,
            'lastname' => $request->has('lastname') ? $request->input('lastname') : $user->lastname,
            'image' => $profile_image_name ?? $user->image,
            'attachment' => $attachment_image_name ?? $user->attachment,
            'birthday' => $request->has('birthday') ? $request->input('birthday') : $user->birthday,
            'sex' => $request->has('sex') ? $request->input('sex') : $user->sex,
            'role' => $request->input('role') ?? $user->role,
        ]);
        session()->flash('success', 'Vos changements ont bien été enregistrer');
        return redirect(url()->previous());
    }

    public function updatePassword(UpdatePasswordRequest $request, $id)
    {
        $user = Auth::user();
        $current_password = $user->password;
        $new_password = bcrypt($request->input('password'));
        if ($current_password != $request->input('current_password')) {
            return redirect(\url()->previous())->withErrors('Votre mot de passe ne corresponds pas');
        }
        $user->update([
            'password' => $new_password
        ]);
        session()->flash('success', 'Votre mot de passe a bien été modifié.');
        return redirect(url()->previous());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
