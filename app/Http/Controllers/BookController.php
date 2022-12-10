<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Book;

use App\Models\Recruite;

use App\Http\Requests\BookRequest;

use GuzzleHttp\Client;

use Illuminate\Pagination\LengthAwarePaginator;

class BookController extends Controller
{
    
    public function create()
    {
        return view('posts/recommendations/create');
    }
    
    
    public function create_answer($recruite_id, Recruite $recruite)
    {
        $recruite = Recruite::find($recruite_id);
        $user = $recruite->user()->get();
        
        return view('posts/recommendations/answer_create') ->with([
            'recruite'=>$recruite, 'user'=>$user[0],
        ]);
    }
    
    
    //GoogleBooksAPIを使用する関数
    public function request($author, $title)
    {
        //クライアントインスタンス
        $client = new \GuzzleHttp\Client();
        
        //googlebooksのURL
        if (empty($title)) {
            $url = 'https://www.googleapis.com/books/v1/volumes?q=inauthor:'.$author.'&maxResults=40';
        } elseif (empty($author)){
            $url = 'https://www.googleapis.com/books/v1/volumes?q=intitle:'.$title.'&maxResults=40';
        } else {
            $url = 'https://www.googleapis.com/books/v1/volumes?q=inauthor:'.$author.'+intitle:'.$title.'&maxResults=40';
        }
        
        //リクエスト送信とデータ取得
        $response = $client->request(
            'GET',
            $url
        );
        
        $information = json_decode($response->getBody(), true);
        return $information;
    }
    
    
    public function search(BookRequest $request)
    {
        $input = $request['book'];
        $author = $input['author'];
        $title = $input['title'];
        
        $information = $this->request($author, $title);
        
        return view('posts/recommendations/searchResult') ->with([
            'books' => $information, 'author' => $author, 'title' => $title,
        ]);
    }
    
    
    public function search_answer(BookRequest $request, $recruite_id, Recruite $recruite)
    {
        $input = $request['book'];
        $author = $input['author'];
        $title = $input['title'];
        
        $information = $this->request($author, $title);
        
        //user情報を取得
        $recruite = Recruite::find($recruite_id);
        $user = $recruite->user()->get();
        
        return view('posts/recommendations/answer_searchResult') ->with([
            'books' => $information, 'author' => $author, 'title' => $title, 'recruite' => $recruite,'user'=>$user[0]
        ]);
    }
    
    
}
