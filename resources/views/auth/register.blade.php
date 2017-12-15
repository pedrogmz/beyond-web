@extends('front.layout')

@section('main')
   <section id="content-wrap">
		<div style=" display: flex;" class="align-items-center section-header"><span aria-hidden="true" class="info-icon"></span><span class="text">Create an account</span></div>
		<div class="primary-content">
			@if ($errors->any())
			    <div class="alert alert-danger">
			        <ul>
			            @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
			        </ul>
			    </div>
			@endif
			@if (session('confirmation-success'))
				@component('front.components.alert')
					@slot('type')
						success
					@endslot
					{!! session('confirmation-success') !!}
				@endcomponent
			@endif
			<form role="form" method="POST" action="{{ route('register') }}">
				{{ csrf_field() }}
				@if ($errors->has('username_mt2'))
					@component('front.components.error')
						{{ $errors->first('username_mt2') }}
					@endcomponent
				@endif
				<div class="form-group">
					<input type="text" class="form-control" id="username_mt2" name="username_mt2" placeholder="@lang('Username')" required autofocus>
				</div>
				@if ($errors->has('password_mt2'))
					@component('front.components.error')
						{{ $errors->first('password_mt2') }}
					@endcomponent
				@endif 
				<div class="form-group">
					<input type="password" class="form-control" id="password_mt2" name="password_mt2" placeholder="@lang('Password')" required>
				</div>
				<div class="form-group">
					<input type="password" class="form-control" id="password_mt2_confirmation" name="password_mt2_confirmation" placeholder="@lang('Confirm your password')" required>
				</div>
				@if ($errors->has('email_mt2'))
					@component('front.components.error')
						{{ $errors->first('email_mt2') }}
					@endcomponent
				@endif
				<div class="form-group">
					<input type="email" class="form-control" id="email_mt2" name="email_mt2" placeholder="@lang('Email Address')" required>
				</div>
				<div class="form-group row">
					<label for="del_code" style="color: #949494; font-size: 1.7rem;" class="col-sm-8 col-form-label">Character deletion code</label>
    				<div class="col-sm-4">
      					<input type="number" class="form-control" id="del_code_mt2" name="del_code_mt2" placeholder="1234567" required>
    				</div>
				</div>
				<div class="form-check">
					<input type="checkbox" name="tyc_checkbox" id="tyc_checkbox">
					<label for="tyc_checkbox" style="color: #949494; font-size: 1.2rem;" class="form-check-label">I agree with the Terms and Conditions</label>
				</div>
				@captcha()
				<!-- <div class="g-recaptcha justify-content-center" data-sitekey="6LfG8zwUAAAAAFwd3HMsp5rdMBOe1k9BDMGbx438"></div> -->
				<button type="submit" class="btn-custom"><span>Register</span></button>
			</form>
		</div>
	</section>
@endsection
