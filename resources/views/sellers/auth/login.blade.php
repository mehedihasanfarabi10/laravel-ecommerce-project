{{-- Extend the main layout --}}
@extends('sellers.layout.authapp')


@section('content')
    {{-- LogIn Seller --}}
    <x-guest-layout>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('seller.login.submit') }}">
            @csrf

            <div class="card mb-2" style="align-items: center; " >
                <h1>Seller LogIn</h1>
            </div>
            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                    autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-between mt-4">
               

                <x-primary-button class="ms-3">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>

            <!-- Register Option -->
            <div class="flex items-center justify-center mt-4">
                <p class="text-sm text-gray-600">Don't have an account?</p>
                <a class="underline text-sm text-blue-600 hover:text-blue-900 ms-2" href="{{ route('seller.register') }}">
                    {{ __('Register') }}
                </a>
            </div>
        </form>
    </x-guest-layout>
@endsection
