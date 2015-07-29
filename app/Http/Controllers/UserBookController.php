<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Book;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Jobs;

class UserBookController extends Controller
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
        $book = Book::paginate(10);	
		//$user = User::All();	

		return view('userbook/index', array('books' => $book));
		
		//return view('userbook/index', array('books' => $book), array('users' => $user));
	
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
		return view('userbook/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
		
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
       $book = Book::find($id);
	   return view('userbook/show', array('book'=>$book));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
       $book = Book::find($id);
       return view('userbook/edit', array('book' => $book)); 
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
            'title' => 'required',
            'author' => 'required|regex:/^([A-Za-z]+)$/',
            'year' => 'required|numeric',
            'genre' => 'required|regex:/^([A-Za-z]+)$/',
			'user_id' => 'numeric'
        ); 
		
       $validator = Validator::make($request->all(), $rules);
		
		if ($validator->fails()) {
            return Redirect::to('userbook/edit')
                ->withErrors($validator)
                ->withInput();
        } else {			
           		
			$book = Book::find($id);
            $book->title = $request->title;
            $book->author = $request->author;
            $book->year = $request->year;
            $book->genre = $request->genre;
			$book->user_id = $request->user_id;
            $book->save();
			
            Session::flash('message', 'Successfully updated link user-book');
			
			$user = User::find($book->user_id);
			
			$job = (new Jobs\SendEmailForRemind($user, $book))->delay('30 * 24 * 60 * 60');  
			$this->dispatch($job);			
			
            return Redirect::to('userbook');
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
        $book = Book::find($id);
        $book->user_id = null;
		$book->save();
        Session::flash('message', 'Successfully deleted link user-book');
        return Redirect::to('userbook');    
    }
}