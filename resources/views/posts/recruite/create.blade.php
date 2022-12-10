<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('本を募集する') }}
        </h2>
    </x-slot>
    
    <form action="/recruites/store/{{ Auth::user()->id }}" method="POST">
        @csrf
        <div class='inputForm'>
            <div class='scene'>
                <h2>募集要項</h2> 
                <p>（抱えている葛藤や、直面している現状を教えてください）</p>
                <textarea type="text" name="recruite[scene]" placeholder="例）自分に自信が持てない。">{{ old('recruite.scene') }}</textarea>
                <p class="scene__error" style="color:red">{{ $errors->first('recruite.scene') }}</p>
            </div>
            
            <button type="submit">作成する</button>
        </div>
    </form>
    
    <div class="footer">
        <a href="/"><br>作成をやめる</a>
    </div>
</x-app-layout>