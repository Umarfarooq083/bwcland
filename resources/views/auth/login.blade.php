@section('title', 'Login')

@section('formHeading')
    Login to your account
@endsection

<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />
        <form class="form-auth-small register-form" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <x-input-label for="email" :value="__('Email')" class="text-left font-weight-bold w-100"  />
                <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <div class="form-group">
                <x-input-label for="password" :value="__('Password')" class="text-left font-weight-bold w-100" />
                <x-text-input id="password" class="form-control"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <div class="form-group clearfix">
                <label for="remember_me" class="fancy-checkbox element-left">
                    <input id="remember_me" type="checkbox" name="remember">
                    <span>{{ __('Remember me') }}</span>
                </label>							
            </div>
            <x-primary-button class="btn btn-primary btn-lg btn-block text-center m-0">
                {{ __('LOGIN') }}
            </x-primary-button>
            
            <!-- <div class="bottom">
                <span class="helper-text m-b-10">
                    <i class="fa fa-lock"></i> 
                        @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </span>
                <span class="helper-text">Don't have an account? <a href="{{ route('register') }}">Register</a></span>
            </div> -->
        </form>
    </div>
</x-guest-layout>
