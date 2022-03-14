@extends('layouts.login')

@section('content')


<div id="login-page" class="row">
	<div class="col s12 z-depth-4 card-panel">
		<form class="login-form right-alert" id="loginForm" action="{{ route('doLogin') }}" method="post">
			{{ csrf_field() }}
			<div class="row">
				<div class="input-field col s12 center">
					<img src="assets/images/logo-roto.png" alt="" class=" responsive-img valign profile-image-login">
					<h1 class="center login-form-text">Gestion Stocks <br />Roto Picardie</h1>
				</div>
			</div>

			<div class="row margin">
				<div class="col s12">
					<div id="card-alert" class="card deep-purple lighten-5">
						<div class="card-content">
							<p>Saisissez vos identifiants personnels pour vous connecter.</p>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="input-field col s12{{ $errors->has('email') ? ' has-error' : '' }}">
					<i class="mdi-social-person-outline prefix"></i>
					<input id="email" name="email" type="text" value="{{ old('email') }}" required>
					<label for="email">Email</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12{{ $errors->has('password') ? ' has-error' : '' }}">
					<i class="mdi-action-lock-outline prefix"></i>
					<input id="password" name="password" type="password" required>
					<label for="password">Mot de passe</label>
				</div>
			</div>
			<!--
			<div class="row">
				<div class="input-field col s12 m12 l12  login-text">
					<input type="checkbox" id="remember" name="remember"  />
					<label for="remember">Se souvenir de moi</label>
				</div>
			</div>
		-->
		<div class="row">
			<div class="input-field col s12">
				<input type="submit" value="Connexion" class="btn waves-effect waves-light col s12" />
			</div>
		</div>

		@if ($errors->has('email'))
		<div id="card-alert" class="card red">
			<div class="card-content white-text">
				{{ $errors->first('email') }}
			</div>
		</div>
		@endif

		@if ($errors->has('password'))
		<div id="card-alert" class="card red">
			<div class="card-content white-text">
				{{ $errors->first('password') }}
			</div>
		</div>
		@endif

		<div class="row">
			<div class="input-field col s12 m12 l12">
				<p class="margin medium-small">&copy; 2017 | Réalisation <a href="https://www.plug-it.com">Plug-it</a></p>
			</div>
		</div>

	</form>
</div>
</div>
@endsection
