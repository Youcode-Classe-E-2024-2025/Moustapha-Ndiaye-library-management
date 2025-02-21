<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;

class BookController extends Controller
{
    // Afficher tous les livres
    public function index()
    {
        $books = Book::all();
        $categories = Category::all();
        
        return view('admin.dashboard', compact('books', 'categories'));
    }

    // Afficher le formulaire de création
    public function create()
    {
        $categories = Category::all();
        return view('admin.create-book', compact('categories'));
    }

    // Enregistrer un livre
    public function store(Request $request)
{
    // Validation des données
    $request->validate([
        'title' => 'required|string|max:255',
        'imgURL' => 'required|url',
        'category_id' => 'required|exists:categories,id',
        'isAvailable' => 'required|boolean',
    ]);

    // Création d'un nouveau livre
    $book = new Book();
    $book->title = $request->title;
    $book->imgURL = $request->imgURL;
    $book->category_id = $request->category_id;
    $book->isAvailable = $request->isAvailable;
    $book->user_id = auth()->id(); // L'ID de l'utilisateur connecté
    $book->save();

    return redirect()->route('books.index')->with('success', 'Livre ajouté avec succès');
}


    // Afficher un livre spécifique
    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('admin.show-book', compact('book'));
    }

    // Afficher le formulaire pour modifier un livre
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $categories = Category::all();
        return view('admin.edit-book', compact('book', 'categories'));
    }

    // Mettre à jour un livre
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
        $book->user_id = auth()->id(); // L'ID de l'utilisateur connecté
        $book->save();

        return redirect()->route('books.index')->with('success', 'Livre mis à jour avec succès');
    }

    // Supprimer un livre
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Livre supprimé avec succès');
    }
}
