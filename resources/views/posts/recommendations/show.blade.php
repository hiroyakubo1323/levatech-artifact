<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('紹介状詳細') }}
        </h2>
    </x-slot>
    
    <body>
   　  
        <!--article - start-->
        <div class="flex flex-col bg-white border rounded-lg overflow-hidden">
            
            <!--画像-->
            @if (! is_null($recommendation->book->coverImage))
              <a href="#" class="group h-48 md:h-64 block bg-gray-100 overflow-hidden relative">
                <img src="{{ $recommendation->book->coverImage }}" loading="lazy" alt="Photo by Minh Pham" class="w-full h-full object-cover object-center absolute inset-0 group-hover:scale-110 transition duration-200" />
              </a>
            @else
              <p  class="group h-48 md:h-64 block bg-gray-100 overflow-hidden relative">取得できません</p>
            @endif
          
          @if ( !is_null($recommendation->recruite_id) )
            <p>募集箱への回答です。</p>
          @endif
          
          <div class="flex flex-col flex-1 p-4 sm:p-6">
            <h2 class="text-gray-800 text-lg font-semibold mb-2">
              <!--著者の表示-->
              @if (! is_null($recommendation->book->author))
                  <a href="#" class="hover:text-indigo-500 active:text-indigo-600 transition duration-100">{{ $recommendation->book->author }}</a>
              @else
                <a href="#" class="hover:text-indigo-500 active:text-indigo-600 transition duration-100">登録なし</a>
              @endif
              
              <!--タイトル-->
              <a href="#" class="hover:text-indigo-500 active:text-indigo-600 transition duration-100">
                @if (! is_null($recommendation->book->author))
                  {{ $recommendation->book->author }}
                @else
                  登録なし
                @endif
                
              </a>
            </h2>
  
            <p class="text-gray-500 mb-8overflow:hidden text-overflow: ellipsis">
              {{ $recommendation->timing }}</br>
              {{ $recommendation->feeling }}</br>
              {{ $recommendation->point }}
            </p>
  
            <div class="flex justify-between items-end mt-auto">
              <div class="flex items-center gap-2">
                <div>
                  <span class="block text-indigo-500">{{ $recommendation->name }}</span>
                  @php
                    //誕生日を数値
                    $birthday = str_replace("-", "", $recommendation->user->birthday);
                    //現在日時
                    $now = date('Ymd');
                    //年齢
                    $age = floor(($now - $birthday) / 10000);
                  @endphp
                  <span class="block text-gray-400 text-sm">{{ $recommendation->user->gender }} {{ $age }}歳（現在）</span>
                </div>
              </div>
              @foreach($recommendation->emotions as $emotion)
                <span class="text-gray-500 text-sm border rounded px-2 py-1">
                  {{ $emotion->react }}
                </span>
              @endforeach
            </div>
          </div>
        
        </div>
        <!-- article - end -->
      
    </body>
</x-app-layout>