<?php

namespace App\Http\Controllers;

use App\Author;
use App\Book;
use App\Http\Requests\StoreBookPost;
use App\Http\Requests\UpdateBookPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(Book::all());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function author_books(Request $request, $author_id)
    {
        return response()->json(Book::all()->where('author_id', $author_id));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreBookPost $request)
    {
        $data = $request->all();
        $user = \Illuminate\Support\Facades\Auth::user();
        $author = $user->author;

        $data['author_id'] = $author->id;


        # Image-part
        $image = $request->image;  // your base64 encoded
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = Str::random(10).'.'.'png';

        Storage::disk('public')->put($imageName, base64_decode($image));
        # End-image-part

        $data['image'] = url('uploads/' . $imageName);
        $book = Book::create($data);

        return response()->json($book, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Book  $book_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Book $book_id)
    {
        return response()->json($book_id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Book  $book_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateBookPost $request, Book $book_id)
    {
        $data = $request->only(['title', 'pages', 'annotation', 'image']);

        # Image-part
        if($request->has('image')) {
            $image = $request->image;
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = Str::random(10).'.'.'png';

            Storage::disk('public')->put($imageName, base64_decode($image));
            $data['image'] = url('uploads/' . $imageName);
        }
        # End-image-part
        # --------------------------

        $book_id->update($data);
        return response()->json($book_id, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Book $book_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Book $book_id)
    {
        $book_id->delete();
        return response()->json([], 204);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_auth_user_books(Request $request)
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        $author = $user->author;
        $books = $author->books;

        return response()->json($books, 200);
    }
}
