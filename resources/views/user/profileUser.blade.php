@extends('layouts.app')


@section('breadcrumbs')
<div id="breadcrumbs-wrapper">
	<div class="container">
		<div class="row">
			<div class="col s12 m12 l12">
				<h5 class="breadcrumbs-title">Utilisateur</h5>
				<ol class="breadcrumbs">
					<li class="active">Mon compte</li>
				</ol>
			</div>
		</div>
	</div>
</div>
@endsection

@section('content')

<form method="post" action="{{ route('profileUser') }}">
	{{ csrf_field() }}
	<div class="form-group">
		<label for="name">Nom</label>
		<input type="text" name="name" id="name" placeholder="Nom" class="form-control" value="{{ old('name',  $user->name) }}">
	</div>
	<div class="form-group">
		<label for="email">Email</label>
		<input type="email" name="email" id="email" placeholder="Email" class="form-control" value="{{ old('email', $user->email) }}" readonly disabled>
	</div>
	<div class="form-group">
		<label for="password">Mot de passe</label>
		<input type="password" name="password" id="password" placeholder="Laissez vide pour inchangé" class="form-control" value="">
	</div>

	<div class="form-group">
		<a class="btn btn-info" href="{{ url()->previous() }}">Retour</a>
		<button type="submit" class="btn btn-info">Mettre à jour</button>
	</div>
</form>
@endsection

