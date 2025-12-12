@section('title', 'Register')

@section('formHeading')
    Create an account
@endsection

<x-guest-layout>
    <form  class="form-auth-small register-form" method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="form-group">
            <x-input-label for="name" :value="__('Name')" class="text-left font-weight-bold w-100 mb-1" />
            <x-text-input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="form-group">
            <x-input-label for="email" :value="__('Email')" class="text-left font-weight-bold w-100 mb-1" />
            <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="form-group">
            <x-input-label for="password" :value="__('Password')" class="text-left font-weight-bold w-100 mb-1" />

            <x-text-input id="password" class="form-control"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="form-group">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-left font-weight-bold w-100 mb-1" />

            <x-text-input id="password_confirmation" class="form-control"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>
        <x-primary-button class="btn btn-primary btn-lg btn-block text-center m-0">
            {{ __('Register') }}
        </x-primary-button>
        <div class="bottom">
            <span class="helper-text">
                <span class="helper-text">
                    Already have an account? <a href="{{ route('login') }}">Login</a>
                </span>
            </span>
        </div>
    </form>
</x-guest-layout>
