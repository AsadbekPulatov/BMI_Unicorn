<?php

namespace App\Http\Controllers;

use App\Services\DeadlineThemeService;
use Illuminate\Http\Request;

class DeadlineThemeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DeadlineThemeService::index();
        return view('admin.deadline_themes.index', compact('data'));
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
    public function store(Request $request)
    {
        $response = DeadlineThemeService::store($request);
        if ($response['code'] == 200)
            $key = 'msg';
        if ($response['code'] == 400)
            $key = 'error';
        return redirect()->back()->with($key, $response['message']);
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
    public function update(Request $request, $id)
    {
        $response = DeadlineThemeService::update($request, $id);
        if ($response['code'] == 200)
            $key = 'msg';
        if ($response['code'] == 400)
            $key = 'error';
        return redirect()->back()->with($key, $response['message']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = DeadlineThemeService::delete($id);
        return redirect()->back()->with('msg', $response['message']);
    }
}
