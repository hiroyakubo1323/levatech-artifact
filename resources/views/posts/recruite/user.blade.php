<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('募集箱一覧') }}
        </h2>
    </x-slot>

    @foreach ($recruites as $recruite)
        @php
            //誕生日を数値
            $birthday = str_replace("-", "", $recruite->user->birthday);
            //現在日時
            $now = date('Ymd');
            //年齢
            $age = floor(($now - $birthday) / 10000);
        @endphp
        <div class="flex flex-col border rounded-lg p-4 md:p-6">
            <h3 class="text-lg md:text-xl font-semibold mb-2">{{ $recruite->user->name }} {{ $recruite->user->gender}} {{ $age }}歳（現在）</h3>
            <p class="text-gray-500 mb-4">{{ $recruite->scene}}</p>
            <a href="/recruite/show/{{ $recruite->id }}" class="text-indigo-500 hover:text-indigo-600 active:text-indigo-700 font-bold transition duration-100 mt-auto">回答を見る</a>
        </div>
    @endforeach
</x-app-layout>