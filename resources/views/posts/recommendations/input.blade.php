<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('感想を書く') }}
        </h2>
    </x-slot>

    <h1 class='title'>紹介する本</h1>
    <div class="bg-white py-6 sm:py-8 lg:py-12">
      <div class="max-w-screen-2xl px-4 md:px-8 mx-auto">
        <div class="md:h-80 flex flex-col sm:flex-row bg-gray-200 rounded-lg overflow-hidden">
          <!--選択した本の表示-->
          <!-- image - start -->
         
            <div class="w-full sm:w-1/2 lg:w-2/5 h-48 sm:h-auto order-first sm:order-none bg-gray-300">
            @if (array_key_exists('imageLinks', $book))
                <img src="{{ $book['imageLinks']['thumbnail'] }}" loading="lazy" alt="Photo by Andras Vas" class="w-full h-full object-cover object-center" />
             @else
                <p class="group w-full md:w-24 lg:w-40 h-56 md:h-24 lg:h-40 block self-start shrink-0 bg-gray-100 overflow-hidden rounded-lg shadow-lg relative">
                    取得できませんでした。
                </p>
            @endif
             </div>
              
          <!-- image - end -->
    
          <!-- content - start -->
        <div class="w-full sm:w-1/2 lg:w-3/5 flex flex-col p-4 sm:p-8">
            <!--出版社-->
             <span class="text-gray-400 text-sm">
                @if (array_key_exists('publishers', $book))
                    {{ $book['publisher'] }}
                @else
                    登録なし
                @endif
            </span>
            
            <!--著者の記載-->
            @if (array_key_exists('authors', $book))
                <!--複数著者-->
                @if (count($book['authors']) > 1)    
                    @php
                        $authors = implode(',', $book['authors']);
                    @endphp
                            
                <h2 class="text-gray-800 text-xl md:text-2xl lg:text-4xl font-bold mb-4">
                    <p class="hover:text-indigo-500 active:text-indigo-600 transition duration-100">
                    {{ $authors }}<br>
                    </p>
                </h2>
                <!--単一著者-->
                @else
                    <h2 class="ttext-gray-800 text-xl md:text-2xl lg:text-4xl font-bold mb-4">
                        <p class="hover:text-indigo-500 active:text-indigo-600 transition duration-100">
                            {{ $book['authors'][0] }}<br>
                        </p>
                    </h2>
                @endif
                    
            @else
                <h2 class="text-gray-800 text-xl md:text-2xl lg:text-4xl font-bold mb-4">
                    <p class="hover:text-indigo-500 active:text-indigo-600 transition duration-100">
                        登録なし<br>
                    </p>
                </h2>
            @endif
    
            <!--タイトル-->
            @if (array_key_exists('title', $book))
                <h2 class="text-gray-800 text-xl md:text-2xl lg:text-4xl font-bold mb-4">
                    <p class="hover:text-indigo-500 active:text-indigo-600 transition duration-100">
                    {{ $book['title'] }}<br>
                    </p>
                </h2>
            @else
                <h2 class="text-gray-800 text-xl md:text-2xl lg:text-4xl font-bold mb-4">
                    <p class="hover:text-indigo-500 active:text-indigo-600 transition duration-100">
                        登録なし<br>
                    </p>
                </h2>
            @endif
            
            <!--説明文-->
            <p class="max-w-md text-gray-600 mb-8">
                @if (array_key_exists('description', $book))
                {{ $book['description'] }}
                @else
                登録なし
                @endif
            </p>
          </div>
          <!-- content - end -->
        </div>
      </div>
    </div>
    
    <!--感想文入力-->
    <form action="/recommendations/store/{{ $id }}/{{ Auth::user()->id }}" method="POST">
        @csrf
        <div class='inputForm'>
            <div class='timing'>
                <h2>読んだタイミング</h2>
                <input type="text" name="recommendation[timing]" placeholder="例）「受験期」「就活中」「失恋したとき」" value="{{ old('recommendation.timing') }}"/><br>
                <p class="timing__error" style="color:red">{{ $errors->first('recommendation.timing') }}</p>
            </div>
            
            <div class='feeling'>
                <h2>読後感</h2>
                <textarea name="recommendation[feeling]" placeholder="例）「自信がついた。」「失恋から立ち直れた」など"/>{{ old('recommendation.feeling') }}</textarea>
                <p class="feeling__error" style="color:red">{{ $errors->first('recommendation.feeling') }}</p>
            </div>
            
            <div class='point'>
                <h2>注目してほしいポイント</h2>
                <textarea name="recommendation[point]" placeholder="例）「主人公の心情変化。」「情景描写が美しい。」など"/>{{ old('recommendation.point') }}</textarea>
                <p class="point__error" style="color:red">{{ $errors->first('recommendation.point') }}</p>
            </div>
            
            <div class='emotion'>
            <h2>抱いた感情</h2>
            @foreach($emotions as $emotion)
                <p class="emotions_array__error" style="color:red">{{ $errors->first('emotions_array') }}</p>
                <label>
                    <input type="checkbox" value="{{ $emotion->id }}" name="emotions_array[]">
                        {{ $emotion->react}}
                    </input>
                </label>
                
                
            @endforeach         
            </div>
            
            <button type="submit">登録する</button>
        </div>
        
        
    </form>
    
    
    <div class="footer">
        <a href="#" onclick="window.history.back(); return false;">直前のページに戻る</a>
    </div>
    <script src="{{ asset('/js/limitation.js') }}"></script>
</x-app-layout>
