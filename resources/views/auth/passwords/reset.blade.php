@extends('layouts.app')

@section('content')

    <div class="flex items-center min-h-screen p-6 bg-gray-50 dark:bg-gray-900">
        <div
            class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800"
        >
            <div class="flex flex-col overflow-y-auto md:flex-row">
                <div class="h-32 md:h-auto md:w-1/2">
                    <img
                        aria-hidden="true"
                        class="object-cover w-full h-full dark:hidden"
                        src="{{asset('admin/assets/img/forgot-password-office-dark.jpeg')}}"
                        alt="Office"
                    />

                </div>
                <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
                    <div class="w-full">
                        <h1
                            class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200"
                        >
                            {{ __('Đặt lại mật khẩu') }}
                        </h1>
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400">{{ __('Địa chỉ email') }}</span>
                            <input
                                id="email" type="email" name="email" value="{{ $email ?? old('email') }}"
                                class="@error('email') is-invalid @enderror block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                required autocomplete="new-password"
                            />
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </label>
                            <div class="row mb-3">
                                <label for="password" class="block mt-4 text-sm">{{ __('Mật khẩu') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="@error('password') is-invalid @enderror block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input "
                                           name="password" required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                         <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm" class="block mt-4 text-sm">{{ __('Nhập lại mật khẩu') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password"
                                           class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                           name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                        <!-- You should use a button here, as the anchor is only used for the example  -->
                        <button
                            class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"

                        >
                            {{ __('Đặt lại mật khẩu') }}
                        </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
