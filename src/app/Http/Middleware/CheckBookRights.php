<?php

namespace App\Http\Middleware;

use App\Book;
use Closure;

class CheckBookRights
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $book = Book::all()->find('id', $request->route('book_id'));
        $user = \Illuminate\Support\Facades\Auth::user();
        $author_id = $user->author->id;

        if($author_id == $book->author_id) {
            return $next($request);
        }
        else {
            return response()->json(['status' => 'Not enough rights to perform the operation']);
        }
    }
}
