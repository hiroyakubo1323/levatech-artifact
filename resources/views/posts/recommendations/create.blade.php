<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('本を探す') }}
        </h2>
    </x-slot>

    <h1 class='title'>①紹介する本を決める</h1>
    <form action="/searchbook" method="POST">
        @csrf
        <div class='inputForm'>
            <div class='author'>
                <h2>著者名</h2>
                <input type="text" name="book[author]" placeholder="例）夏目漱石"/>
                <p class="author__error" style="color:red">{{ $errors->first('book.title') }}</p>
            </div>
            
            <div class='title'>
                <h2>作品名</h2>
                <input type="text" name="book[title]" placeholder="例）吾輩は猫である"/>
                <p class="title__error" style="color:red">{{ $errors->first('book.title') }}</p>
            </div>
            
            <button type="submit">検索する</button>
        </div>
    </form>
    
    <div class="footer">
        <a href="/"><br>作成をやめる</a>
    </div>
</x-app-layout>