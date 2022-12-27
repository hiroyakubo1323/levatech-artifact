<x-app-layout>
      <x-slot name="header">
          <h1 class="font-semibold text-xl text-gray-800 leading-tight">
              {{ __('紹介本一覧') }}
          </h1>
      </x-slot>

    <body>
    
    <div class="right_side">
      <div class="create_recommendation">
        <a href="recommendations/create" class="create_buttom">紹介文を作成する</a>
      </div>
      
      <div class="select_emotions">
        <h2 class="form_title">感情で検索</h2>
        <form action="/recommendation/emotion" method="POST">
          @csrf
          <p class="emotions_array__error" style="color:red">{{ $errors->first('emotions_array') }}</p>
          @foreach($emotions as $emotion)
            <label class="each_emotion">
              <input type="checkbox" value="{{ $emotion->id }}" name="emotions_array[]">
                  {{ $emotion->react}}</br>
              </input>
            </label>
          @endforeach
          <input  class="buttom" type="submit" value="検索する"/>
        </form>
      </div>
    </div>
    
    @foreach($recommendations as $recommendation)    
        <!--article - start-->
        <a href="/recommendation/{{ $recommendation->id }}">
          <div class="article">
              <!--画像-->
            @if (! is_null($recommendation->book->coverImage))
              <img src="{{ $recommendation->book->coverImage }}" loading="lazy" alt="Photo by Minh Pham" class="coverImage" />
            @else
              <p  class="group h-48 md:h-64 block bg-gray-100 overflow-hidden relative">取得できません</p>
            @endif
            
            @if ( !is_null($recommendation->recruite_id) )
              <p>募集箱への回答です。</p>
            @endif
            
            <div class="recommendation">
              <div class="left_recommendation">
                <div class="bookInformation">
                  <h3>
                  <!--著者の表示-->
                    著者：
                    @if (! is_null($recommendation->book->author))
                      {{ $recommendation->book->author }}</br>
                    @else
                      登録なし</br>
                    @endif
                    
                    <!--タイトル-->
                    タイトル：
                      @if (! is_null($recommendation->book->title))
                        {{ $recommendation->book->title }}</br>
                      @else
                        登録なし</br>
                      @endif
                    </h3>
                  </div> 
                  
                  <div class="emotions"> 
                    </br><h3> 抱いた感情：</h3></br>
                    @foreach($recommendation->emotions as $emotion)
                      <span class=reacts>
                        {{ $emotion->react }}
                      </span>
                    @endforeach 
                  </div>
                </div>  
              
              <div class="right_recommendation">
                <div class="impression">
                  <div class="timing">  
                    <h3>こんな人、こんな時におすすめ：</h3>
                    <p>
                    {{ $recommendation->timing }}
                    </p>
                  </div>
                  
                  <div class="feeling">
                    <h3>読後感：</h3>
                    <p>{{ $recommendation->feeling }}</p>
                  </div>
                </div>  
      
                <div class="user">
                  @php
                      //誕生日を数値
                      $birthday = str_replace("-", "", $recommendation->user->birthday);
                      //現在日時
                      $now = date('Ymd');
                      //年齢
                      $age = floor(($now - $birthday) / 10000);
                    @endphp
                  <p>投稿者： {{ $recommendation->user->name }}    {{ $recommendation->user->gender }}   {{ $age }}歳（現在）</p></nobr>
                </div>
              </div>
            </div>
          </div>
        </a>
        <!-- article - end -->
      @endforeach
    </body>
    
    <link rel="stylesheet" href="{{ asset('/css/recommendation_index.css')  }}" >
</x-app-layout>