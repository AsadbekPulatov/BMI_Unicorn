<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use App\Models\Type;
use App\Services\FilterService;
use App\Services\TypeService;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = TypeService::index();
        return view('admin.types.index', compact('types'));
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = TypeService::store($request);
        return redirect()->back()->with('msg', $response['message']);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Type $type
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Type $type
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Type $type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $response = TypeService::update($request, $id);
        return redirect()->back()->with('msg', $response['message']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Type $type
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = TypeService::delete($id);
        return redirect()->back()->with('msg', $response['message']);
    }
}
