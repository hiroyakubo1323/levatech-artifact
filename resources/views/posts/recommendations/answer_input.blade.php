<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('感想を書く') }}
        </h2>
    </x-slot>

    <body>
        
        <div class="content">
            <!--募集内容の表示-->
            <div class="recruite">
                <h3>募集内容</h3>
                <p>投稿者：{{ $user->name }} </p>
                <p>抱えている感情や直面している状況：</p>
                <h4>{{ $recruite->scene }}</h4>
            </div>
          <div class="selectBook">
            <div class="bookInformation">
              <!--選択した本の表示-->
              <!-- image - start -->
                <div class="coverImage">
                @if (array_key_exists('imageLinks', $book))
                    <img src="{{ $book['imageLinks']['thumbnail'] }}" loading="lazy" alt="picture" />
                 @else
                    <p>
                        取得できませんでした。
                    </p>
                @endif
                 </div>
              <!-- image - end -->
        
              <!-- content - start -->
                <div class="detailInformation">
                    <div class="identifiedInformation">
                        <!--出版社-->
                        <div class="publisher">
                            <span class="text-gray-400 text-sm">
                                出版社：
                                @if (array_key_exists('publishers', $book))
                                    {{ $book['publisher'] }}
                                @else
                                    登録なし
                                @endif
                            </span>
                        </div>
                        <!--著者の記載-->
                        <div class="author">
                            @if (array_key_exists('authors', $book))
                                <!--複数著者-->
                                @if (count($book['authors']) > 1)    
                                    @php
                                        $authors = implode('　', $book['authors']);
                                    @endphp
                                            
                                <h2>
                                    <p>
                                    著者：{{ $authors }}<br>
                                    </p>
                                </h2>
                                <!--単一著者-->
                                @else
                                    <h2>
                                        <p>
                                            著者：{{ $book['authors'][0] }}<br>
                                        </p>
                                    </h2>
                                @endif
                                    
                            @else
                                <h2>
                                    <p>
                                        著者：登録なし<br>
                                    </p>
                                </h2>
                            @endif
                        </div>
                        <!--タイトル-->
                        <div class="title">
                            @if (array_key_exists('title', $book))
                                <h2>
                                    <p>
                                    タイトル：{{ $book['title'] }}<br>
                                    </p>
                                </h2>
                            @else
                                <h2>
                                    <p>
                                        タイトル：登録なし<br>
                                    </p>
                                </h2>
                            @endif
                        </div>
                    </div>
                    <!--説明文-->
                    <div class="description">
                        <p>
                            あらすじ：</br>
                            @if (array_key_exists('description', $book))
                            {{ $book['description'] }}
                            @else
                            登録なし
                            @endif
                        </p>
                    </div>
                  </div>
              <!-- content - end -->
            </div>
          </div>
        
            <div class='inputForm'>
            <!--感想文入力-->
                <form action="/recommendations/store/{{ $book_id }}/{{ Auth::user()->id }}/{{ $recruite->id }}" method="POST">
                @csrf
                    <div class="recommendation">
                        <div class="left_recommendation">
                            <div class='timing'>
                                <h2>どのような時、人にお勧めですか</h2>
                                <textarea name="recommendation[timing]" placeholder="例）「就活中で将来が不安」「失恋したとき」" >{{ old('recommendation.timing') }}</textarea>
                                <p class="timing__error" style="color:red">{{ $errors->first('recommendation.timing') }}</p>
                            </div>
                            
                            <div class='feeling'>
                                <h2>読後感</h2>
                                <textarea name="recommendation[feeling]" placeholder="例）「自信がついた。」「失恋から立ち直れた」など"/>{{ old('recommendation.feeling') }}</textarea>
                                <p class="feeling__error" style="color:red">{{ $errors->first('recommendation.feeling') }}</p>
                            </div>
                        </div>
                        
                        <div class="right_recommendation">
                            <div class='point'>
                                <h2>注目してほしいポイント</h2>
                                <textarea class="inputPoint"name="recommendation[point]" placeholder="例）「主人公の心情変化。」「情景描写が美しい。」など"/>{{ old('recommendation.point') }}</textarea>
                                <p class="point__error" style="color:red">{{ $errors->first('recommendation.point') }}</p>
                            </div>
                            
                            <div class='emotion'>
                            <h2>抱いた感情</h2>
                            <p class="emotions_array__error" style="color:red">{{ $errors->first('emotions_array') }}</p>
                            @foreach($emotions as $emotion)
                                <label>
                                    <input type="checkbox" value="{{ $emotion->id }}" name="emotions_array[]">
                                        {{ $emotion->react}}
                                    </input>
                                </label>
                            @endforeach         
                            </div>
                        </div>
                    </div>
                    
                    <input class="buttom "type="submit" value="登録する" />
                </form>
            </div>
        </div>
        
        <div class="footer">
            <a href="#" onclick="window.history.back(); return false;">直前のページに戻る</a>
        </div>
    
    </body>
    <link rel="stylesheet" href="{{ asset('/css/recommendation_input.css')  }}" >
</x-app-layout>