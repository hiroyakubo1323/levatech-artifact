<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            
        </x-slot>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div　class="mt-4">
                <x-input-label for="name" :value="__('Name')" />

                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />

                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            
            <!--Gender-->
            <div class = "mt-4">
                <x-input-label　for="gender" :value"__('Gender')" />
                <label><input class="block mt-1" type="radio" name="gender" value="男性"> 男性</label>
                <label><input class="block mt-1" type="radio" name="gender" value="女性"> 女性</label>
                <label><input class="block mt-1" type="radio" name="gender" value="どちらでもない"> どちらでもない</label>
                <x-input-error :messages="$errors->get('gender')" class="mt-2" />
            </div>
            
            
            <!--birthday-->
             <div class = 'mt-4'>
                <x-input-label　for="birthday" :value"__('birthday')" />
                <input class="block mt-1" name="birthday" type="date" min="1920-04-01" :value="old('birthday')"/>
                <x-input-error :messages="$errors->get('birthday')" class="mt-2" />
            </div>
            
            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />

                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            
            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="ml-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
