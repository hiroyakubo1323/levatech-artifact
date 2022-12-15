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
    public function index(Recommendation $recommendation, Book $book)
    {
        return view('posts/recommendations/index')->with([
            'recommendations'=>$recommendation-> getByLimit()
        ]);
        
    }
    
    public function show(Recommendation $recommendation)
    {
        return view('posts/recommendations/show')->with([
            'recommendation'=>$recommendation
        ]);
    }
    
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
        //本の情報登録
        $information = $this->request($book->googlebook_id);
        
        if (array_key_exists('imageLinks', $information['volumeInfo'])) {
            $book->coverImage = $information['volumeInfo']['imageLinks']['thumbnail'];
        }
        
        if (array_key_exists('authors', $information['volumeInfo'])) {
            if (count($information['volumeInfo']['authors']) > 1){
                $authors = implode('　　', $information['volumeInfo']['authors']);
                $book->author = $authors;
            } else {
                $book->author = $information['volumeInfo']['authors'][0];
            }
            
        }
        if (array_key_exists('title', $information['volumeInfo'])) {
            $book->title = $information['volumeInfo']['title'];
        }
        
        if (array_key_exists('publishers', $information['volumeInfo'])) {
            $book->publisher = $information['volumeInfo']['publisher'];
        }
        
        if (array_key_exists('description', $information['volumeInfo'])) {
            $book->description = $information['volumeInfo']['description'];
        }
        $book->save();
        
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
        $book_id = $book->id;
        $recommendation -> fill($input_recommendation);
        $recommendation -> user_id = $user_id;
        $recommendation -> book_id = $book_id;
        if (isset($recruite_id)) {
            $recommendation -> recruite_id = $recruite_id;
        }
        
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
        //本の情報登録
        $information = $this->request($book->googlebook_id);
        
        
        if (array_key_exists('imageLinks', $information['volumeInfo'])) {
            $book->coverImage = $information['volumeInfo']['imageLinks']['thumbnail'];
        }
        
         if (array_key_exists('authors', $information['volumeInfo'])) {
            if (count($information['volumeInfo']['authors']) > 1){
                $authors = implode('　　', $information['volumeInfo']['authors']);
                $book->author = $authors;
            } else {
                $book->author = $information['volumeInfo']['authors'][0];
            }
            
        }
        if (array_key_exists('title', $information['volumeInfo'])) {
            $book->title = $information['volumeInfo']['title'];
        }
        
        if (array_key_exists('publishers', $information['volumeInfo'])) {
            $book->publisher = $information['volumeInfo']['publisher'];
        }
        
        if (array_key_exists('description', $information['volumeInfo'])) {
            $book->description = $information['volumeInfo']['description'];
        }
        $book->save();
        
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
