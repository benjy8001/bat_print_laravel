@extends('layouts.app')


@section('breadcrumbs')
<div id="breadcrumbs-wrapper">
	<div class="container">
		<div class="row">
			<div class="col s12 m12 l12">
				<h5 class="breadcrumbs-title">Utilisateur</h5>
				<ol class="breadcrumbs">
					<li class="active">{{ isset($user->id) ? 'Mise à jour' : 'Création' }} d'un utilisateur</li>
				</ol>
			</div>
		</div>
	</div>
</div>
@endsection

@section('content')

<form method="post" action="{{ isset($user->id) ? route('updateUser', ['id' => $user->id]) : route('createUser') }}">
	{{ csrf_field() }}
	<div class="form-group">
		<label for="name">Nom</label>
		<input type="text" name="name" id="name" placeholder="Nom" class="form-control" value="@if(isset($user->id)) {{ old('name',  $user->name) }} @else {{ old('name') }} @endif">
	</div>
	<div class="form-group">
		<label for="email">Email</label>
		<input type="email" name="email" id="email" placeholder="Email" class="form-control" value="@if(isset($user->id)){{ old('email',  $user->email) }} @else {{ old('email') }} @endif">
	</div>
	<div class="form-group">
		<label for="role_id">Profil</label>
		<select name="role_id" id="role_id" class="form-control">
			@foreach ($roles as $role)
			<option value="{{ $role->id }}" @if(isset($user->id)) {{ ($role->id==$user->roles()->first()->id) ? 'selected' : '' }} @endif>{{ $role->name }}</option>
			@endforeach
		</select>
	</div>
	<div class="form-group">
		<label for="password">Mot de passe</label>
		<input type="password" name="password" id="password" placeholder="{{ isset($user->id) ? 'Laissez vide pour inchangé': 'Mot de passe' }}" class="form-control" value="">
	</div>

	<div class="form-group">
		<a class="btn btn-info" href="{{ url()->previous() }}">Retour</a>
		<button type="submit" class="btn btn-info">{{ isset($user->id) ? 'Mettre à jour' : 'Ajouter' }}</button>
	</div>
</form>
@endsection

