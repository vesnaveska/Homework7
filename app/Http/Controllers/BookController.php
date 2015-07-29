<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Book;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Jobs;

class BookController extends Controller
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
		
		return view('book/index', array('books' => $book));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('book/create');
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
            'title' => 'required',
            'author' => 'required|regex:/^([A-Za-z]+)$/',
            'year' => 'required|numeric',
            'genre' => 'required|regex:/^([A-Za-z]+)$/'
        ); 
		
		$validator = Validator::make($request->all(), $rules);
		
		if ($validator->fails()) {
            return Redirect::to('book/create')
                ->withErrors($validator)
                ->withInput();
        } else {			
            $book = new Book();
			$book->title = $request->title;
            $book->author = $request->author;
            $book->year = $request->year;
            $book->genre = $request->genre;
            $book->save();

            Session::flash('message', 'Successfully created book');
			
			$job = (new Jobs\SendEmailAboutNewBook($book));
            $this->dispatch($job);
			
            return Redirect::to('book');
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
        $book = Book::find($id);
		return view('book/show', array('book'=>$book));
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
        return view('book/edit', array('book' => $book));
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
            'genre' => 'required|regex:/^([A-Za-z]+)$/'
        ); 
		
       $validator = Validator::make($request->all(), $rules);
		
		if ($validator->fails()) {
            return Redirect::to('book/edit')
                ->withErrors($validator)
                ->withInput();
        } else {			
           		
			$book = Book::find($id);
            $book->title = $request->title;
            $book->author = $request->author;
            $book->year = $request->year;
            $book->genre = $request->genre;
            $book->save();

            Session::flash('message', 'Successfully updated book');
            return Redirect::to('book');
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
        $book->delete();
        Session::flash('message', 'Successfully deleted book');
        return Redirect::to('book');
    }
}