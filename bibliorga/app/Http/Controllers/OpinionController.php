<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOpinionRequest;
use App\Repositories\OpinionRepository;

class OpinionController extends Controller
{
    public function __construct()
    {
        $this->middleware('islibrarian')->except(['store', 'update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateOpinionRequest $request, OpinionRepository $repository)
    {
        $repository->store([
            'grade' => $request->input('grade'),
            'description' => $request->input('description'),
            'title' => $request->input('title'),
            'user_id' => auth()->user()->id,
            'book_id' => $request->input('book_id'),
        ]);
        session()->flash('success', 'Votre avis a bien été tenu compte');
        return redirect(url()->previous());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateOpinionRequest $request, OpinionRepository $repository, $id)
    {
        $repository->update($id, [
            'grade' => $request->input('grade'),
            'description' => $request->input('description'),
            'title' => $request->input('title'),
            'book_id' => $request->input('book_id'),
        ]);
        session()->flash('success', 'Votre avis a bien été mise à jour');
        return redirect(url()->previous());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
