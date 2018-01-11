@extends('front.layout')

@section('main')
    <div class="d-flex align-items-center section-header"><span aria-hidden="true" class="info-icon"></span><span class="text">Password reset</span></div>
    <section id="password-reset">
        <div class="primary-content">
            @if (session('status'))
                @component('front.components.alert')
                    @slot('type')
                        success
                    @endslot
                    <p>{{ session('status') }}</p>
                @endcomponent
            @endif
            <br>
            <div class="section_text">Introduce la nueva contraseña para tu cuenta</div>
            <form role="form" method="POST" action="{{ route('password.request') }}">
                {{ csrf_field() }}
                <input type="hidden" name="token" value="{{ $token }}">
                @if ($errors->has('email'))
                    @component('front.components.error')
                        {{ $errors->first('email') }}
                    @endcomponent
                @endif     
                <div class="form-group">                     
                    <input id="email" placeholder="@lang('Email')" type="email" class="form-control"  name="email" value="{{ old('email') }}" required>
                </div>
                @if ($errors->has('login'))
                    @component('front.components.error')
                        {{ $errors->first('login') }}
                    @endcomponent
                @endif     
                <div class="form-group">                     
                    <input id="login" placeholder="@lang('Username')" type="text" class="form-control"  name="login" value="{{ old('login') }}" required>
                </div>
                @if ($errors->has('password'))
                    @component('front.components.error')
                        {{ $errors->first('password') }}
                    @endcomponent
                @endif 
                <div class="form-group">
                    <input id="password" placeholder="@lang('Password')" type="password" class="form-control"  name="password" required>
                </div>
                <div class="form-group">
                    <input id="password-confirm" placeholder="@lang('Confirm your password')" type="password" class="form-control" name="password_confirmation" required>
                </div>
                <button type="submit" class="btn-custom"><span>Cambiar</span></button>
            </form>
        </div>
    </section>
@endsection
