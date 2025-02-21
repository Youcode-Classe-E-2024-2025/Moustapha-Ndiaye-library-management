<?php

// namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Factories\HasFactory;


// class Book extends Model
// {
//     use HasFactory; 

//     protected $fillable = ['title', 'imgURL', 'isAvailable', 'borrowsBY', 'user_id', 'category_id'];

//     public function category()
//     {
//         return $this->belongsTo(Category::class);
//     }
// }


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    use HasFactory;

    // Colonnes qui peuvent être massivement assignées
    protected $fillable = ['user_id', 'title', 'imgURL', 'category_id', 'isAvailable'];

    // Relation "Appartient à" avec l'utilisateur
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relation avec la catégorie
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // Méthode pour créer un livre
    public static function createBook(array $data)
    {
        return self::create($data);
    }

    // Méthode pour mettre à jour un livre
    public static function updateBook($id, array $data)
    {
        $book = self::find($id);
        if ($book) {
            $book->update($data);
            return $book;
        }

        return null;
    }

    // Méthode pour supprimer un livre
    public static function deleteBook($id)
    {
        $book = self::find($id);
        if ($book) {
            $book->delete();
            return true;
        }

        return false;
    }

    // Méthode pour récupérer tous les livres d'un utilisateur
    public static function getBooksByUser($userId)
    {
        return self::where('user_id', $userId)->get();
    }

    // Méthode pour récupérer un livre par son titre
    public static function getBookByTitle($title)
    {
        return self::where('title', $title)->first();
    }
}

