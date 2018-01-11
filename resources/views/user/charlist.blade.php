@extends('front.layout')

@section('main')
	<div class="d-flex align-items-center section-header"><span aria-hidden="true" class="info-icon"></span><span class="text">Character list</span></div>
	<div class="main_content_background">
    @foreach ($charlist as $user)
			<div class="app__mt2__rank__content align-items-center text-center">
				<div style="display:inline-block;" class="app__mt2__race__style app__mt2__race__<?=viewRace($user->job);?>"></div>
				<div style="margin:0 auto; line-height: 30px;">
					<div style="letter-spacing: 0.5rem;">{{ $user->name }}</div>
					<div style="color: #166848;"><?=$user->guildname ? $user->guildname : 'Sin gremio';?>
						Lv. {{ $user->level }}
					</div>
				</div>
				<div>Reino: <div style="float:none;display:inline-block;" class="app__mt2__reich__style app__mt2__reich__<?=viewEmpire($user->empire);?> app__mt2__reich__custom"></div></div>
				<div>Rango: <?=rango($user->alignment);?></div>
				<div>@lang('strings.uYang'): <div class="stats-value"><?=number_format($user->gold, 2, ',', '.');?></div></div>
				<div>@lang('strings.uTime'): <div class="stats-value"><?=$user->playtime?> minutos</div></div>
				<div>@lang('strings.uLastTime'): <div class="stats-value"><?=$user->last_play?></div></div>
				
				<div style="line-height: 20px; margin-top: 30px"><a style="color:#fff;" href="{{ route('debug', ['id' => $user->id]) }}"> >> DESBUGUEAR PERSONAJE << </a></div>
				<div class="text-debug"> Recuerda esperar entre 15-30 minutos antes de entrar de nuevo a tu cuenta una vez que hayas desbueagdo a tu personaje </div>
			</div> 
			@endforeach
    </div>

@endsection