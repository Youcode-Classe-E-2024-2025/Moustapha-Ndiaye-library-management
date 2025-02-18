<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;


class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Supprimer les données existantes avant l'insertion
        Category::truncate();

        // Tableau des catégories à insérer
        $categories = ['Roman', 'Science', 'Informatique', 'Histoire', 'Biographie'];

        // Insertion des catégories, en évitant les doublons
        foreach ($categories as $category) {
            Category::firstOrCreate(['name' => $category]);
        }
    }
}

