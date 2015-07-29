<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
	 
	public function __construct()
    {
        $this->middleware('auth');
    }
	
    public function index()
    {
        $user = User::paginate(10);
		
		return view('user/index', array('users' => $user));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('user/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
		$rules = array(
            'first_name' => 'required|regex:/^([A-Za-z]+)$/',
            'last_name' => 'required|regex:/^([A-Za-z]+)$/',
            'email' => 'required|email|unique:users',
			'password' => 'required|confirmed|min:5'
        ); 
		
		$validator = Validator::make($request->all(), $rules);
		
		if ($validator->fails()) {
            return Redirect::to('user/create')
                ->withErrors($validator)
                ->withInput();
        } else {			
            $user = new User();
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->save();

            Session::flash('message', 'Successfully created user');
            return Redirect::to('user');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $user = User::find($id);
		return view('user/show', array('user'=>$user));		
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('user/edit', array('user' => $user));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
		$rules = array(
            'first_name' => 'required|regex:/^([A-Za-z]+)$/',
            'last_name' => 'required|regex:/^([A-Za-z]+)$/',
            'email' => 'required|email|unique:users',
			'password' => 'required|confirmed|min:5'
        );  
		
       $validator = Validator::make($request->all(), $rules);
		
		if ($validator->fails()) {
            return Redirect::to('user/edit')
                ->withErrors($validator)
                ->withInput();
        } else {			
            $user = User::find($id);
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->save();

            Session::flash('message', 'Successfully updated user');
            return Redirect::to('user');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        Session::flash('message', 'Successfully deleted user');
        return Redirect::to('user');
    }
}