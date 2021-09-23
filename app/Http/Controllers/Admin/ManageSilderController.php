<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ManageSliderService;
use Illuminate\Http\Request;

class ManageSilderController extends Controller
{
    public function __construct(ManageSliderService $manageSliderService)
    {
        $this->service = $manageSliderService;
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
    public function store(Request $request)
    {
        $this->validate($request, [
            'text' => 'required|regex:/^[\pL\s\-]+$/u',
            'image' => 'required|file',
        ]);
        $imageFile = $request->file('image') ? $request->file('image') : null;
        if($imageFile = $request->file('image')){
            //$name =  $file->getClientOriginalName();
            $imageFileName = time().'.'.$imageFile->getClientOriginalExtension();
            $request['image_path'] = 'image_'.$imageFileName;
        }
        return $this->service->saveSliderInfo($request->all(), $imageFile);
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
        //
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
