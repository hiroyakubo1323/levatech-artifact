<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('作品別感想') }}
        </h2>
    </x-slot>
    
    <body>
   　  
        <!--article - start-->
      <div class="article">
        <!--article - start-->
        <div class="bookInformation">
          <div class="coverImage">  
            @if (! is_null($book->coverImage))
                <img src="{{ $book->coverImage }}"/>
            @else
              <p>取得できません</p>
            @endif
          </div>
          
          <div class="detailInformation">
            <div class="mainInformation">
              <h3>
                <!--著者の表示-->
                著者：
                @if (! is_null($book->author))
                  {{ $book->author }}</br>
                @else
                  登録なし</br>
                @endif
                
                <!--タイトル-->
                タイトル：
                @if (! is_null($book->title))
                  {{ $book->title }}
                @else
                  登録なし
                @endif
              </h3>
              
              <div style="position:relative;width:100;height:100;" class="emotion_chart">
                <h3>みんなのこの本への感情：</h3>
                <canvas id="myChart">
                </canvas>
              </div>
            </div>
            
            <h3 class="description">あらすじ：</br>{{ $book->description }}</h3>
          </div>
        </div>
        
        @foreach($recommendations as $recommendation)
          <div class="contents">
            <div class="user">
              @php
                //誕生日を数値
                $birthday = str_replace("-", "", $recommendation->user->birthday);
                //現在日時
                $now = date('Ymd');
                //年齢
                $age = floor(($now - $birthday) / 10000);
              @endphp
              <a href="/user/{{ $recommendation->user->id }}/recommendation">投稿者： {{ $recommendation->user->name }}    {{ $recommendation->user->gender }}   {{ $age }}歳（現在）</a></nobr>
            </div>
            
            <div class="recommendation">
              <h3>こんな人、時におすすめ</h3></br>
                <p>{{ $recommendation->timing }}</p></br>
              <h3>読後感</h3></br>    
                <p>{{ $recommendation->feeling }}</p></br>
              <h3>おすすめポイント</h3></br>     
                  <p>{{ $recommendation->point }}</p></br>
            </div>
            
            <div class="user_emotion">
              <h3> 読者が抱いた感情</h3></br>
              @foreach($recommendation->emotions as $emotion)
                <span class="reacts">
                  {{ $emotion->react }}
                </span>
              @endforeach 
            </div>
            
          </div>
        @endforeach
      </div>
        <!-- article - end -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>
      <script>
        const ctx = document.getElementById("myChart");
        const myChart = new Chart(ctx, {
          type: 'radar', 
          data: { 
            labels: ["喜び", "悲しみ", "怒り", "驚き", "恐怖","嫌悪"],
            datasets:[{
              label: "この本で選択された感情",
              data: [{{ $book->happy }}, {{ $book->sadness }}, {{ $book->anger }}, {{ $book->surprised}}, {{ $book->fear }},{{ $book->disgust }}],
              backgroundColor: "rgba(67, 133, 215, 0.5)",
              borderColor: "rgba(67, 133, 215, 1)",
            }]
          },
          options: {
            scale: {
              ticks:{
                beginAtZero:true,
                min: 0,
                max: 10
            }
           }
         }
       });
      </script>
      
      </body>
      <link rel="stylesheet" href="{{ asset('/css/recommendation_book.css')  }}" >
</x-app-layout>