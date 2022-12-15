<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('書籍検索結果') }}
        </h2>
        
        <form action="/searchbook" method="POST">
        @csrf
            <div class='inputForm'>
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
                
                <button type="submit">検索する</button>
            </div>
        </form>
    </x-slot>
    
    <body>
        @if ($books['totalItems'] == 0)
            <h3>
                検索できません。正しい検索ワードを入れなおしてください。
            </h3>
        @else    
            @foreach ($books['items'] as $book)
            <div class="flex flex-col md:flex-row items-center gap-4 lg:gap-6">
                <!--画像-->
                @if (array_key_exists('imageLinks', $book['volumeInfo']))    
                    <a href="#" class="group w-full md:w-24 lg:w-40 h-56 md:h-24 lg:h-40 block self-start shrink-0 bg-gray-100 overflow-hidden rounded-lg shadow-lg relative">
                        <img src="{{ $book['volumeInfo']['imageLinks']['thumbnail'] }}" loading="lazy" alt="Photo by Minh Pham" class="w-full h-full object-cover object-center absolute inset-0 group-hover:scale-110 transition duration-200" />
                    </a>
                @else
                     <p class="group w-full md:w-24 lg:w-40 h-56 md:h-24 lg:h-40 block self-start shrink-0 bg-gray-100 overflow-hidden rounded-lg shadow-lg relative">
                        取得できませんでした。
                    </p>
                @endif
                
                <div class="flex flex-col gap-2">
                    <!--出版社-->
                    <span class="text-gray-400 text-sm">
                        @if (array_key_exists('publishers', $book['volumeInfo']))
                            {{ $book['volumeInfo']['publisher'] }}
                        @else
                            登録なし
                        @endif
                    </span>
                    
                    <!--著者の表示-->
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
                        
                    <!--タイトル-->
                    <h2 class="text-gray-800 text-xl font-bold">
                        <p class="hover:text-indigo-500 active:text-indigo-600 transition duration-100">
                            @if (array_key_exists('title', $book['volumeInfo']))
                                {{ $book['volumeInfo']['title'] }}<br>
                            @else
                                登録なし<br>
                            @endif
                        </p>
                    </h2>
                    
                    <!--説明文-->
                    @if (array_key_exists('description', $book['volumeInfo']))
                        <p class="text-gray-500">{{ $book['volumeInfo']['description'] }}</p>
                    @else
                        <p class="text-gray-500">登録なし</p>
                    
                    @endif
                   <!--リンク-->
                    <div>
                        @if (array_key_exists('id', $book))
                            <a href="/recommendations/create/{{ $book['id'] }}" class="text-indigo-500 hover:text-indigo-600 active:text-indigo-700 font-semibold transition duration-100">感想を書く</a>
                        @else
                            <p>この本の感想は書けません</p>
                        @endif
                    </div>
                    
                </div>
            </div>
            @endforeach
        @endif
    
        <div class="footer">
            <a href="/recommendations/create">検索しなおす</a>
        </div>
    </body>
</x-app-layout>