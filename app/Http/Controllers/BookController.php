<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Book;

use App\Http\Requests\BookRequest;

use GuzzleHttp\Client;

class BookController extends Controller
{
    
    public function create()
    {
        return view('posts/recommendations/create');
    }
    
    public function search(BookRequest $request)
    {
        $input = $request['book'];
        $author = $input['author'];
        $title = $input['title'];
        
        //クライアントインスタンス
        $client = new \GuzzleHttp\Client();
        
        //googlebooksのURL
        if (empty($title)) {
            $url = 'https://www.googleapis.com/books/v1/volumes?q=inauthor:'.$author;
        } elseif (empty($author)){
            $url = 'https://www.googleapis.com/books/v1/volumes?q=intitle:'.$title;
        } else {
            $url = 'https://www.googleapis.com/books/v1/volumes?q=inauthor:'.$author.'+intitle:'.$title;
        }
        
        //リクエスト送信とデータ取得
        $response = $client->request(
            'GET',
            $url
        );
        
        $information = json_decode($response->getBody(), true);
        
        return view('posts/recommendations/searchResult') ->with([
            'books' => $information['items'],
        ]);
    }
}
