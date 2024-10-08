<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class HomeController extends Controller
{
    public function homepage()
    {
        $categoryIcons = [
            '1' => ['shirt'],
            '2' => ['bag-shopping'],
            '3' => ['laptop'],
            '4' => ['couch'],
            '5' => ['car-side'],
            '6' => ['spray-can-sparkles'],
            '7' => ['shirt'],
            '8' => ['baby-carriage'],
            '9' => ['utensils'],
            '10' => ['heart-pulse'],
        ];

        $carouselSlides = [
            [
                'image' => 'img/1.png',
                'title' => 'ui.welcomeToPresto',
                'description' => 'ui.carouselDescription',
                'buttonText' => 'ui.createAnAd',
                'buttonLink' => 'create'
            ],
            [
                'image' => 'img/2.png',
                'title' => 'ui.findAmazingDeals',
                'description' => 'ui.findAmazingDealsDescription',
                'buttonText' => 'ui.exploreAds',
                'buttonLink' => 'products'
            ],
            [
                'image' => 'img/3.png',
                'title' => 'ui.sellYourItems',
                'description' => 'ui.sellYourItemsDescription',
                'buttonText' => 'ui.startSelling',
                'buttonLink' => 'create'
            ]
        ];

        $reviews = [
            ['name' => 'Amit Pandher', 'image' => 'amit.png', 'rating' => 4.5, 'text' => "Un'esperienza di acquisto eccezionale! Prodotti di alta qualità e servizio clienti impeccabile. Tornerò sicuramente!"],
            ['name' => 'DJ Antodav', 'image' => 'antodav.png', 'rating' => 5, 'text' => "Ho venduto diversi oggetti in poco tempo. Piattaforma intuitiva e comunità affidabile. Consigliato!"],
            ['name' => 'Vito Campobasso', 'image' => 'vito.png', 'rating' => 4, 'text' => "Ottimi affari e transazioni sicure. Ho trovato pezzi unici a prezzi convenienti. Lo raccomando vivamente!"],
            ['name' => 'Mario Fiorelli', 'image' => 'mario.png', 'rating' => 5, 'text' => "Spedizioni veloci e imballaggi curati. Ho fatto ottimi affari sia come acquirente che come venditore."],
        ];

        $article = Article::where('is_accepted', true)->latest()->take(4)->get();
        return view('homepage', compact('article', 'categoryIcons', 'carouselSlides', 'reviews'));
    }
}
