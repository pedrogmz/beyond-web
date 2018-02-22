@extends('front.layout')

@section('main')
	<div class="d-flex align-items-center section-header"><span aria-hidden="true" class="info-icon"></span><span class="text">Donate to us!</span></div>

	<section id="buycoins">
		<div class="main_content_background">
			<div class="main_board_subtitle_centeralign">Usando e-Payouts</div>
			<div id="wizard">
				<h1><div class="main_board_subtitle_centeralign"> Metodo de pago </div></h1>
				<div class="step-content">
					<div id="progress_bar" class="progress_bar_stage1"></div>
					<div class="main_board_regular_text" id="first_step">
						<h2>Selecciona el metodo con el cual deseas pagar</h2>
						<p id="payment_methods"><?= getPaymentMethodsByCountry($_SERVER["HTTP_CF_IPCOUNTRY"]) ?></p>
					</div>
				</div>
			
				<h1><div class="main_board_subtitle_centeralign"> Monto </div></h1>
				<div class="step-content">
					<div id="progress_bar" class="progress_bar_stage2"></div>
					<div class="main_board_regular_text" id="second_step">
					<h2>Elige el monto de coins a recibir</h2>
						<p class="select_price"></p>
					</div>
				</div>

				<h1><div class="main_board_subtitle_centeralign"> Completar pago </div></h1>
				<div class="step-content">
					<div id="progress_bar" class="progress_bar_stage3"></div>
					<div class="main_board_regular_text">
						<h2>Completa tu pago con e-Payouts</h2>
						<p class="epay_content"></p>
					</div>
				</div>
			</div>
		</div>
		<div class="main_content_background">
			@php
				if(isset($_POST["pay_paypal"])) {
					if($_POST["type"] == '5') {
						$coins = '500';
					} elseif($_POST["type"] == '10') {
						$coins = '1100';
					} elseif($_POST["type"] == '15') {
						$coins = '1650';
					} elseif($_POST["type"] == '20') {
						$coins = '2200';
					} elseif($_POST["type"] == '50') {
						$coins = '6000';
					}
					$price = $_POST["type"];
					$return_url = route('buycoins');
					$cancel_url = route('buycoins');
					$notify_url = 'http://billing.btmt2.com/zRuzkSqcXfi.php';

					$item_name = 'Server: Beyond - PVP - '.$coins.' coins - Account: '.Auth::user()->login;
					$item_amount = $price;
					$querystring = '';

					// Firstly Append paypal account to querystring
					$querystring .= "?business=".urlencode('billing@cerclexarxes.com')."&";

					// Append amount& currency (£) to quersytring so it cannot be edited in html

					//The item name and amount can be brought in dynamically by querying the $_POST['item_number'] variable.
					$querystring .= "item_name=".urlencode($item_name)."&";
					$querystring .= "amount=".urlencode($item_amount)."&";

					//loop for posted values and append to querystring
					foreach($_POST as $key => $value){
						$value = urlencode(stripslashes($value));
						$querystring .= "$key=$value&";
					}

					// Append paypal return addresses
					$querystring .= "return=".urlencode(stripslashes($return_url))."&";
					$querystring .= "cancel_return=".urlencode(stripslashes($cancel_url))."&";
					$querystring .= "notify_url=".urlencode($notify_url);

					// Append querystring with custom field
					$querystring .= "&custom=".Auth::user()->login;

					// Redirect to paypal IPN
					//echo $querystring;
					$destination = 'https://www.paypal.com/cgi-bin/webscr'.$querystring;
					echo '<meta http-equiv="refresh" content="0; url='.$destination.'">';
					exit();
				}
				//Paypal - END
			@endphp
			<form action="{{ route('buycoins') }}" role="form" method="POST">
				{{ csrf_field() }}
				<div class="justify-content-center form-group">
					<select style="width: 200px; margin: auto;" class="form-control select-custom" id="type" name="type">
						<option value="5">500 Coins - 5 EUR</option>
						<option value="10">1100 Coins - 10 EUR</option>
						<option value="15">1650 Coins - 15 EUR</option>
						<option value="20">2200 Coins - 20 EUR</option>
						<option value="50">6000 Coins - 50 EUR</option>
					</select>
					<input type="hidden" name="cmd" value="_xclick" />
					<input type="hidden" name="no_shipping" value="1" />
					<input type="hidden" name="no_note" value="1" />
					<input type="hidden" name="rm" value="2" />
					<input type="hidden" name="currency_code" value="EUR" />
				</div>
				<button type="submit" name="pay_paypal" class="btn-custom">PayPal</button>
			</form>
			<br />
			@lang('strings.uPaypalText')
		</div>
	</section>
@endsection
