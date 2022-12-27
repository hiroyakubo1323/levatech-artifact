<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('本を探す') }}
        </h1>
    </x-slot>
    
    <body>
        <div class="content">
            <form action="/searchbook/" method="POST">
            @csrf
            <div class='inputForm'>
                <h2 class='title'>おすすめしたい本を探しましょう！</h2>
                <div class='author'>
                    <h3>著者名</h3>
                    <input type="text" name="book[author]" placeholder="例）夏目漱石"/>
                    <p class="author__error" style="color:red">{{ $errors->first('book.title') }}</p>
                </div>
                    
                <div class='title'>
                    <h3>作品名</h3>
                    <input type="text" name="book[title]" placeholder="例）吾輩は猫である"/>
                    <p class="title__error" style="color:red">{{ $errors->first('book.title') }}</p>
                </div>
                    
                <input class="buttom" type="submit" value="検索する"/>
            </div>
            </form>
            
            <div class="footer">
                <a class="buttom"href="/index">作成をやめる</a>
            </div>
        </div>
    <body>
    <link rel="stylesheet" href="{{ asset('/css/recommendation_create.css')  }}" >
</x-app-layout>