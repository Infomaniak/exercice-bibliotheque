<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAuthorRequest;
use App\Models\Author;
use App\Repositories\AuthorRepository;

class AuthorController extends Controller
{
    protected $_paginate = 10;

    public function __construct()
    {
        $this->middleware('islibrarian')->except('show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AuthorRepository $repository)
    {
        $authors = $repository->getPaginate($this->_paginate);
        return view('dashboard.authors', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->home();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAuthorRequest $request, AuthorRepository $repository)
    {
        //dd($request->all());

        $author_image_name = null;
        if ($request->hasFile('photo')) {
            //uplaod
            $file = $request->file('photo');
            $author_image_name = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move(public_path(config('image.path_authors_image')), $author_image_name);
        }

        $repository->store([
            'image' => $author_image_name,
            'lastname' => $request->input('lastname'),
            'firstname' => $request->input('firstname'),
            'biography' => $request->input('biography'),
        ]);
        session()->flash('success', 'Auteur ajouté avec succès.');
        return redirect(url()->previous());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(AuthorRepository $repository, $id)
    {
        if (($author = $repository->getById($id)) == null)
            return redirect(url()->previous())->withErrors('Cet auteur n\'existe pas');
        return view('profiles.author', compact('author'));
    }

    public function staticShow()
    {
        return view('author');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return redirect()->home();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateAuthorRequest $request, AuthorRepository $repository, $id)
    {
        $author_image_name = null;
        $author = Author::find($id);
        if ($request->hasFile('photo')) {
            $file = $request->file('photo'); // get the image data
            $author_image_name = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension(); // Create an unique name
            $file->move(public_path(config('image.path_authors_image')), $author_image_name); // upload the image
            //Delete late image
            if ($author->image){
                unlink(public_path($author->profile_image));
            }
        }

        $author->update([
            'image' => $author_image_name ?? $author->image,
            'lastname' => $request->input('lastname'),
            'firstname' => $request->input('firstname'),
            'biography' => $request->input('biography'),
        ]);
        session()->flash('success', 'L\'auteur a bien été mise à jour.');
        return redirect(url()->previous());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(AuthorRepository $repository, $id)
    {
        $repository->destroy($id);
        session()->flash('success', 'L\'auteur a bien été mise à jour.');
        return redirect(url()->previous());
    }
}
