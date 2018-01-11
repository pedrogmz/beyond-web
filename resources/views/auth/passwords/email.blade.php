@extends('front.layout')

@section('main')
    <div class="d-flex align-items-center section-header"><span aria-hidden="true" class="info-icon"></span><span class="text">Password reset</span></div>
	<section id="password-email">
		<div class="primary-content">
            @if (session('status'))
                @component('front.components.alert')
                    @slot('type')
                        success
                    @endslot
                    <p>{{ session('status') }}</p>
                @endcomponent
            @endif
            @if ($errors->has('email'))
                @component('front.components.alert')
                    @slot('type')
                        error
                    @endslot
                    {{ $errors->first('email') }}
                @endcomponent
            @endif
            <br>
            <div class="section_text">Introduce tu usuario y correo electronico para recuperar tu contraseña</div>
            <form role="form" method="POST" action="{{ route('password.email') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <input id="email" type="email" placeholder="@lang('Email')" class="form-control" name="email" value="{{ old('email') }}" required>
                </div>
                <div class="form-group">
                <input id="login" type="text" placeholder="@lang('Username')" class="form-control" name="login" value="{{ old('login') }}" required>
                </div>
                <button type="submit" class="btn-custom"><span>Enviar</span></button>
            </form>
        </div>
	</section>
@endsection
