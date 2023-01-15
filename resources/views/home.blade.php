<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
    </head>
    <body class="backgroundImage">
        <div class="transparent">    
            <div class="content">  
               <h1 class="title">感情をもとにおすすめの本募集・紹介サイト</h1>
                <div class="main">               
                    <div class="function">
                        <h2>機能一覧</h2>
                        <ul>    
                            <li><h3>募集機能</h3></li>
                            <p>
                                あなたの抱いている感情、また直面している状況など、吐露してください。
                                その感情や状況にあった本を紹介してもらえます。
                            </p>
                            
                            <li><h3>紹介機能</h3></li>
                            <p>
                                おすすめの本を読んだとき感じた感情と合わせて投稿してください。
                                共感してくれる人や、その本に興味を抱いている方もいるかもしれません。
                                また募集機能に投稿された感情に合う本も紹介してください
                            </p>
                        </ul>
                    </div>
                    
                    <div class="login">
                        <h2>ログイン</h2>
                        
                        <form method="POST" action="{{ route('login') }}">
                        @csrf
                            <div class="input_form">
                                <h3>メールアドレス</h3>
                                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus/>
                                <p class="email__error" style="color:red">{{ $errors->first('email') }}</p>
                            </div>
                            
                            <div class="input_form">
                                <h3 for="password">パスワード</h3>
        
                                <input id="password" type="password" name="password" required autocomplete="current-password"/>
        
                                <p class="password__error" style="color:red">{{ $errors->first('password') }}</p>
                            </div>
                            
                            <div class="forget_password">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}">
                                    {{ __('パスワードを忘れてしまった方') }}
                                </a>
                            @endif
                            </div>
                            
                            <input class="buttom" type="submit" value="ログイン"/>
                        </form>
                        <div class="register">
                            @if (Route::has('register'))
                                <a class="buttom" href="{{ route('register') }}">新規登録</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    
    <link rel="stylesheet" href="{{ asset('/css/home.css')  }}" >
</html>