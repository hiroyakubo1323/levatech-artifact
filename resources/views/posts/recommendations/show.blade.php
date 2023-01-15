<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-white leading-tight">
            {{ __('紹介状詳細') }}
        </h1>
    </x-slot>
    
    <body>
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
    
    @if ( !is_null($recommendation->recruite_id) )
        <div class="recruite">
          <a href="/recruite/show/{{ $recommendation->recruite_id }}" class="recruite_buttom">回答された募集箱を見る</a>
        </div>
    @endif
   　
   　<div class="article">
        <!--article - start-->
        <div class="bookInformation">
          
          
          <a href="/book/recommendation/{{ $recommendation->book->id }}">
          <div class="coverImage">  
            @if (! is_null($recommendation->book->coverImage))
                <img src="{{ $recommendation->book->coverImage }}"/>
            @else
              <p>取得できません</p>
            @endif
          </div>
          
          
          <div class="detailInformation">
            <div class="mainInformation">
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
                  {{ $recommendation->book->title }}
                @else
                  登録なし
                @endif
              </h3>
              
              <!--感情-->
              <div class="emotion_chart">    
                <div class="all_emotion" style="position:relative;width:100;height:100;">
                  <h3>みんなのこの本への感情</h3>
                  <canvas id="myChart">
                  </canvas>
                </div>
                
                <div class="user_emotion">
                  <h3> 投稿者が抱いた感情</h3></br>
                  @foreach($recommendation->emotions as $emotion)
                    <span class="reacts">
                      {{ $emotion->react }}
                    </span>
                  @endforeach 
                </div>
              </div>
            </div>  
            <!--あらすじ-->
            <h3 class="description">あらすじ：</br>{{ $recommendation->book->description }}</h3>
          </div>
          </a>
        </div>
          
        
        <div class="recommendation">
          <h2>投稿者の投稿内容</h2>
          <div>
            <h3>こんな人、時におすすめ</h3></br>
            <p>{{ $recommendation->timing }}</p></br>
          </div>
          
          <div>  
            <h3>読後感</h3></br>    
              <p>{{ $recommendation->feeling }}</p></br>
          </div>
          
          <div>
            <h3>おすすめポイント</h3></br>     
            <p>{{ $recommendation->point }}</p></br>
          </div>
        </div>
  
       
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
              data: [{{ $recommendation->book->happy }}, {{ $recommendation->book->sadness }}, {{ $recommendation->book->anger }}, {{ $recommendation->book->surprised}}, {{ $recommendation->book->fear }},{{ $recommendation->book->disgust }}],
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
      <link rel="stylesheet" href="{{ asset('/css/recommendation_show.css')  }}" >
</x-app-layout>

