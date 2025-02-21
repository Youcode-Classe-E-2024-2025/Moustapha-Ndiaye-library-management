<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use App\Models\User;


class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        $categories = Category::all();
        $users = User::all();
        
        return view('admin.dashboard', compact('books', 'categories', 'users'));
    }

    public function indexUser()
    {
        $books = Book::all();
        $categories = Category::all();
        $users = User::all();
        
        return view('user.dashboard', compact('books', 'categories', 'users'));
    }

    public function create()
    {
        $categories = Category::all();
        $users = User::all();

        return view('admin.create-book', compact('categories', 'users'));
    }

    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'imgURL' => 'required|url',
        'category_id' => 'required|exists:categories,id',
        'isAvailable' => 'required|boolean',
    ]);

    $book = new Book();
    $book->title = $request->title;
    $book->imgURL = $request->imgURL;
    $book->category_id = $request->category_id;
    $book->isAvailable = $request->isAvailable;
    $book->user_id = 1;

    $book->save();

    return redirect()->route('books.index')->with('success', 'Livre ajouté avec succès');
}


    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('admin.show-book', compact('book'));
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $categories = Category::all();
        return view('admin.edit-book', compact('book', 'categories'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'imgURL' => 'required|url',
        'category_id' => 'required|exists:categories,id',
        'isAvailable' => 'required|boolean',
    ]);

    $book = Book::findOrFail($id);

    $book->title = $request->title;
    $book->imgURL = $request->imgURL;
    $book->category_id = $request->category_id;
    $book->isAvailable = $request->isAvailable;
    $book->user_id = auth()->id(); 
    $book->user_id = 6;
    $book->save();

    return redirect()->route('books.index')->with('success', 'Book updated successfully');
}


    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Book deleted successfully');
    }
}
