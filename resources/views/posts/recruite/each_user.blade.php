<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('ユーザー別ページ') }}
        </h2>
    </x-slot>
    
    <div class="right_side">
        <a class="buttom" href="/user/{{ $user_id }}/recommendation">この人の紹介文を見る</a>
        <a class="buttom" href="/recruites/create">募集箱を作成する</a>
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
                <a href="/recommendations/answer/{{ $recruite->id }}" class="answer">本を紹介する</a>
            </div>
        </div>
    @endforeach
    
    <link rel="stylesheet" href="{{ asset('/css/recruite_index.css')  }}" >
</x-app-layout>