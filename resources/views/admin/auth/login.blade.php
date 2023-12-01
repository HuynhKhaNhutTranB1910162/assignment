@extends('layouts.app')
@section('title', 'Đăng nhập Admin')
@section('content')
    <div class="flex items-center min-h-screen p-6 bg-gray-50 dark:bg-gray-900">
        <div
            class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800">
            <div class="flex flex-col overflow-y-auto md:flex-row">
                <div class="h-32 md:h-auto md:w-1/2">
                    <img
                        aria-hidden="true"
                        class="object-cover w-full h-full dark:hidden"
                        src="{{asset('admin/assets/img/login-office.jpeg')}}"
                        alt="Office"/>
                    <img
                        aria-hidden="true"
                        class="hidden object-cover w-full h-full dark:block"
                        src="{{asset('admin/assets/img/login1.jpg')}}"
                        alt="Office"/>
                </div>
                <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
                    <div class="w-full">
                        <form method="POST" action="{{ route('admin.login') }}">
                            @csrf

                            <h1 class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200">
                                Đăng nhập
                            </h1>

                            <div class="row mb-3">
                                <label for="email" class="block mt-4 text-sm">{{ __('Email') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="text-xs text-red-600" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="password" class="block mt-4 text-sm">{{ __('Mật khẩu') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                    <span class="text-xs text-red-600" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Ghi nhớ tài khoản') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                {{ __('Đăng nhập') }}
                            </button>

                            @if (Route::has('password.request'))
                                <p class="mt-4">
                                    <a
                                        class="text-sm font-medium text-purple-600 dark:text-purple-400 hover:underline"
                                        href="{{ route('password.request') }}"
                                    >
                                        {{ __('Bạn đã quên mật khẩu ?') }}
                                    </a>
                                </p>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
