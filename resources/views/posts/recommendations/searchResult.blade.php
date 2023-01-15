<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('書籍検索結果') }}
        </h2>
    </x-slot>
    
   <body>
        <div class="right_side">
            <div class='inputForm'>    
                <form action="/searchbook" method="POST">
                @csrf
                    <div class='author'>
                        <h5>著者名</h5>
                        <input type="text" name="book[author]" placeholder="例）夏目漱石" value={{ $author }}>
                        <p class="author__error" style="color:red">{{ $errors->first('book.title') }}</p>
                    </div>
                
                    <div class='title'>
                        <h5>作品名</h5>
                        <input type="text" name="book[title]" placeholder="例）吾輩は猫である" value={{ $title }}>
                        <p class="title__error" style="color:red">{{ $errors->first('book.title') }}</p>
                    </div>
                    
                <input class="buttom" type="submit" value="検索する"/>
                </form>
            </div>    
        </div>
        
         <div class="contents">
            @if ($books['totalItems'] == 0)
                <h3>
                    検索できません。正しい検索ワードを入れなおしてください。
                </h3>
            @else    
                @foreach ($books['items'] as $book)
                <div class="items">
                    <div class="bookInformation">
                        <!--画像-->
                        <div class="coverImage">
                            @if (array_key_exists('imageLinks', $book['volumeInfo']))
                                <img src="{{ $book['volumeInfo']['imageLinks']['thumbnail'] }}" loading="lazy" alt="Photo by Minh Pham" />
                            @else
                                 <p>
                                    取得できませんでした。
                                </p>
                            @endif
                        </div>
                        
                        <div class="detailInformation">
                            <div class="identifiedInformation">
                                <!--出版社-->
                                <p class="publisher">
                                    出版社：
                                    @if (array_key_exists('publishers', $book['volumeInfo']))
                                        {{ $book['volumeInfo']['publisher'] }}
                                    @else
                                        登録なし
                                    @endif
                                </p>
                                
                                <!--著者の表示-->
                                <div class="author">
                                   <h2>著者：</h2>
                                   @if (array_key_exists('authors', $book['volumeInfo']))
                                        <!--複数著者-->    
                                        @if (count($book['volumeInfo']['authors']) > 1)    
                                            @php
                                                $authors = implode('　', $book['volumeInfo']['authors']);
                                            @endphp
                                            
                                            <h2 class="text-gray-800 text-xl font-bold">
                                                <p class="hover:text-indigo-500 active:text-indigo-600 transition duration-100">
                                                    {{ $authors }}<br>
                                                </p>
                                            </h2>
                                        <!--単一著者-->
                                        @else
                                            <h2 class="text-gray-800 text-xl font-bold">
                                                <p class="hover:text-indigo-500 active:text-indigo-600 transition duration-100">
                                                    {{ $book['volumeInfo']['authors'][0] }}<br>
                                                </p>
                                            </h2>
                                        @endif
                                    
                                    @else
                                        <h2 class="text-gray-800 text-xl font-bold">
                                            <p class="hover:text-indigo-500 active:text-indigo-600 transition duration-100">
                                                登録なし<br>
                                            </p>
                                        </h2>
                                    @endif
                                </div>    
                                
                                <!--タイトル-->
                                <div class="title">
                                    <h2>タイトル：</h2>
                                    <h2 class="text-gray-800 text-xl font-bold">
                                        <p class="hover:text-indigo-500 active:text-indigo-600 transition duration-100">
                                            @if (array_key_exists('title', $book['volumeInfo']))
                                                {{ $book['volumeInfo']['title'] }}<br>
                                            @else
                                                登録なし<br>
                                            @endif
                                        </p>
                                    </h2>
                                </div>
                            </div>
                            
                            <!--説明文-->
                            <div class="description">
                                <h2>あらすじ：</br></h2>
                                @if (array_key_exists('description', $book['volumeInfo']))
                                    <p class="text-gray-500">{{ $book['volumeInfo']['description'] }}</p>
                                @else
                                    <p class="text-gray-500">登録なし</p>
                                
                                @endif
                            </div>
                       </div>     
                    </div>
                    <!--リンク-->
                    <div class="link">
                        @if (array_key_exists('id', $book))
                            <a class="buttom" href="/recommendations/create/{{ $book['id'] }}" class="text-indigo-500 hover:text-indigo-600 active:text-indigo-700 font-semibold transition duration-100">感想を書く</a>
                        @else
                            <p>この本の感想は書けません</p>
                        @endif
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </body>
    
    <link rel="stylesheet" href="{{ asset('/css/recommendation_searchResult.css')  }}" >
</x-app-layout>