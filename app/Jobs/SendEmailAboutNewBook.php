<?php

namespace App\Jobs;

use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailer;
use App\Book;
use App\User;

class SendEmailAboutNewBook extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $book;

    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    public function handle(Mailer $mailer)
    {
		$users = User::all();
		foreach ($users as $user) {

			Mail::send('emails.new_book', 
			['first_name' => $user->first_name, 'book_title' => $this->book['title'], 'book_author' => $this->book['author']],
			function($message)
			{
				$message->to($user->email, $user->firstname)->subject('We add new book to our library!');
			});
        }
    }
}
