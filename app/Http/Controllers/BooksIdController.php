<?php

namespace App\Http\Controllers;

use App\Book;
use App\User;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BooksIdController extends Controller
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
		$id = Auth::user()->id;
		$user = User::find($id); 		  
        $books = $user->books()->paginate(10);		
		return view('books/index', array('books' => $books, 'user'=> Auth::user()));
		
    }
}