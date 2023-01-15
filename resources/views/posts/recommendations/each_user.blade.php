<x-app-layout>
      <x-slot name="header">
          <h1 class="font-semibold text-xl text-white leading-tight">
              {{ __('ユーザー別ページ') }}
          </h1>
      </x-slot>

    <body>
    
    @if (isset($selected_emotions))
    <div class="selected_emotions">
        @foreach($selected_emotions as $emotion)
            <h3>"{{ $emotion->react }}"</h3>
        @endforeach
        <p>についての紹介文</p>
    </div>
    @endif
    
    <div class="right_side">
      <div class="create_recommendation">
        <a href="/user/{{ $user_id }}/recruite" class="create_buttom">この人の募集箱を見る</a>
      </div>
      
      <div class="select_emotions">
        <h2 class="form_title">感情で検索</h2>
        <form action="/user/{{ $user_id }}/recommendation/emotion" method="POST">
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
            <div class = "coverImage" >
                <!--画像-->
              @if (! is_null($recommendation->book->coverImage))
                <img src="{{ $recommendation->book->coverImage }}" loading="lazy" alt="Photo by Minh Pham"/>
              @else
                <p  class="group h-48 md:h-64 block bg-gray-100 overflow-hidden relative">取得できません</p>
              @endif
            </div>
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