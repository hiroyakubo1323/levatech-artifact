<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Recommendation;

use App\Models\Emotion;

use App\Models\Book;

use App\Models\Recruite;

use App\Http\Controllers\BookController;

use App\Http\Requests\RecommendationRequest;

class RecommendationController extends Controller
{
    public function request($googlebook_id)
    {
        $client = new \GuzzleHttp\Client();
        $url = 'https://www.googleapis.com/books/v1/volumes/'.$googlebook_id;
        
        $response = $client->request(
            'GET',
            $url
        );
        
        $information = json_decode($response->getBody(), true);
        return $information;
    }
    
    public function create($googlebook_id, Emotion $emotion) 
    {
        $information = $this->request($googlebook_id);
        
        return view('posts/recommendations/input')->with([
            'book' => $information['volumeInfo'], 'book_id' => $information['id'], 'emotions' => $emotion->get(),
        ]);
    }
    
    public function answer_create($googlebook_id, $recruite_id, Recruite $recruite,Emotion $emotion)
    {
        $information = $this->request($googlebook_id);
        $recruite = Recruite::find($recruite_id);
        $user = $recruite->user()->get();
        
        return view('posts/recommendations/answer_input')->with([
            'book' => $information['volumeInfo'], 'book_id' => $information['id'], 'recruite' => $recruite,'user'=>$user[0], 'emotions' => $emotion->get(),
        ]);
        
    }
    
    public function store($googlebook_id, $user_id, RecommendationRequest $request, Recommendation $recommendation, Book $book)
    {
        $book = Book::firstOrCreate([
            'googlebook_id' => $googlebook_id
        ]);
        
        $book_id = $book->id;
        $input_emotions = $request->emotions_array;
        
        $react = ["happy", "sadness", "anger", "surprised", "fear", "disgust"];
        
        for ($i=0; $i<=5; $i++) {
            if (in_array($i+1,$input_emotions)) {
                ${"sum_".$i} = $book->find($book_id, [$react[$i]])[$react[$i]] + 1;
                ${"react_".$i} = $react[$i];
                $book->${"react_".$i} = ${"sum_".$i};
                $book->save();
            }
        }
        
        $input_recommendation = $request['recommendation'];
        
        $recommendation -> fill($input_recommendation);
        $recommendation -> user_id = $user_id;
        $recommendation -> book_id = $book_id;
        $recommendation ->save();
        
        $recommendation->emotions()->attach($input_emotions); 
        
        return redirect('/');
    }
    
    public function answer_store($googlebook_id, $user_id, RecommendationRequest $request, Recommendation $recommendation, Book $book, $recruite_id)
    {
        $book = Book::firstOrCreate([
            'googlebook_id' => $googlebook_id
        ]);
        
        $book_id = $book->id;
        $input_emotions = $request->emotions_array;
        
        $react = ["happy", "sadness", "anger", "surprised", "fear", "disgust"];
        
        for ($i=0; $i<=5; $i++) {
            if (in_array($i+1,$input_emotions)) {
                ${"sum_".$i} = $book->find($book_id, [$react[$i]])[$react[$i]] + 1;
                ${"react_".$i} = $react[$i];
                $book->${"react_".$i} = ${"sum_".$i};
                $book->save();
            }
        }
        
        $input_recommendation = $request['recommendation'];
        
        $recommendation -> fill($input_recommendation);
        $recommendation -> user_id = $user_id;
        $recommendation -> book_id = $book_id;
        $recommendation -> recruite_id = $recruite_id;
        $recommendation ->save();
        
        $recommendation->emotions()->attach($input_emotions);
        
        return redirect('/');
    }

}
