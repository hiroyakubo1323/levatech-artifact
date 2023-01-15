<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('募集箱一覧') }}
        </h2>
    </x-slot>

    <div class="right_side">
        <a class="buttom" href="/recruites/create">募集箱を作成する</a>
        <a class="buttom" href="/recruites/nonanswered">回答された募集箱</a>
    </div>
    
    @foreach ($recruites as $recruite)
        @php
            //誕生日を数値
            $birthday = str_replace("-", "", $recruite->user->birthday);
            //現在日時
            $now = date('Ymd');
            //年齢
            $age = floor(($now - $birthday) / 10000);
        @endphp
        <div class="article">
            <div class="information">
                <p class="user">投稿者：{{ $recruite->user->name }} {{ $recruite->user->gender}} {{ $age }}歳（現在）</p>
                <div class="scene">
                    <p>抱えている感情や直面している状況：</p>
                    <h3>{{ $recruite->scene}}</h3>
                </div>
            </div>
            
            <div class="detail">
                <a href="/recruite/show/{{ $recruite->id }}" class="answer">回答を見る</a>
            </div>
        </div>
    @endforeach
    
    <link rel="stylesheet" href="{{ asset('/css/recruite_index.css')  }}" >
</x-app-layout>