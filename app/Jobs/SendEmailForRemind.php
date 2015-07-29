<?php

namespace App\Jobs;

use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailer;
use App\User;
use App\Book;

class SendEmailForRemind extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;
    
	protected $user;
	protected $book;


    public function __construct(User $user, Book $book)
    {
        $this->user = $user;
        $this->book = $book;
    }

    public function handle(Mailer $mailer)
    {
		
		Mail::send(
            'emails.return_book_to_library',
            ['user' => $this->user, 'book' => $this->book],			
            function ($message) 
			{
                $message->to($this->user->email, $this->user->firstname)->subject('Remind! Return the book!');
            }
        );
    }
}
