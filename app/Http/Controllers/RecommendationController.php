<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Recommendation;

use App\Models\Emotion;

use App\Models\Book;

use App\Http\Controllers\BookController;

use App\Http\Requests\RecommendationRequest;

class RecommendationController extends Controller
{
    public function create($id, Emotion $emotion) 
    {
        $client = new \GuzzleHttp\Client();
        $url = 'https://www.googleapis.com/books/v1/volumes/'.$id;
        
        $response = $client->request(
            'GET',
            $url
        );
        
        $information = json_decode($response->getBody(), true);
        
        return view('posts/recommendations/input')->with([
            'book' => $information['volumeInfo'],
            'id' => $information['id'],
            'emotions' => $emotion->get(),
        ]);
    }
    
    public function store ($googlebook_id, $user_id, RecommendationRequest $request, Recommendation $recommendation, Book $book)
    {
        $book = Book::firstOrCreate([
            'googlebook_id' => $googlebook_id
        ]);
        
        $book_id = $book->id;
        $input_recommendation = $request['recommendation'];
        $input_emotions = $request->emotions_array;
        
        $recommendation -> fill($input_recommendation);
        $recommendation -> user_id = $user_id;
        $recommendation ->book_id = $book_id;
        $recommendation ->save();
        
        $recommendation->emotions()->attach($input_emotions); 
        
        return redirect('/');
    }

}
