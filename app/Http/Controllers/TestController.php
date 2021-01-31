<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Test;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \view('crud.create');
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
           'firstName'=>'required',
           'lastName'=>'required',
           'phone'=>'required',
           'email'=>'required',
       ]);

       $student = new Test;

       $student->firstName= $request->firstName;
       $student->lastName= $request->lastName;
       $student->phone= $request->phone;
       $student->email= $request->email ;

       if($request->has('image')){
        $image = $request->image;
        $image_new_name =time(). '.' .$image->getClientOriginalExtension();
        $image->move('storage/post/', $image_new_name);
        $student->image ='/storage/post/'. $image_new_name;
        
    }

       $student->save();

       return \redirect(route('home'))->with('success', 'Data successfull add');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Test::find($id);
        return view('crud.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Test::find($id);
        return \view('crud.edit' , compact('data'));

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
        $this->validate($request,[
            'firstName'=>'required',
            'lastName'=>'required',
            'phone'=>'required',
            'email'=>'required',
        ]);

        $student = Test::find($id);
        $student->firstName= $request->firstName;
        $student->lastName= $request->lastName;
        $student->phone= $request->phone;
        $student->email= $request->email;

        if($request->hasFile('image')){
            $image = $request->image;
            $image_new_name =time(). '.' .$image->getClientOriginalExtension();
            $image->move('storage/post/', $image_new_name);
            $post->image ='/storage/post/'. $image_new_name;
            $post->save();
        }
       

        return \redirect(route('home'))->with('success', 'Data successfull Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Test::find($id)->delete();
        return \redirect(route('home'))->with('success', 'Data delete');
    }
}
