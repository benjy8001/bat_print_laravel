@extends('layouts.app')


@section('breadcrumbs')
<div id="breadcrumbs-wrapper">
	<div class="container">
		<div class="row">
			<div class="col s12 m12 l12">
				<h5 class="breadcrumbs-title">Stock</h5>
				<ol class="breadcrumbs">
					<li class="active">{{ isset($reference->id) ? 'Mise à jour' : 'Création' }} d'une référence</li>
				</ol>
			</div>
		</div>
	</div>
</div>
@endsection

@section('content')

<div class="row">
	<div class="col s12">
		<ul class="tabs tabs-variable-width z-depth-1">

			<li class="tab col s3">
				<a class="grey darken-2 white-text active" href="#info">Informations</a>
			</li>
			@if(isset($reference->id))
			<li class="tab col s3">
				<a class="grey darken-2 white-text" href="#histo">Historique</a>
			</li>
			@endif
		</ul>
	</div>

	<div class="col s12">
		<div class="col s12" id="info">
			<form method="post" action="{{ isset($reference->id) ? route('updateReference', ['id' => $reference->id]) : route('createReference') }}">
				{{ csrf_field() }}
				<div class="form-group">
					<label for="code_barre">Code barre</label>
					<input type="text" name="code_barre" id="code_barre" placeholder="Code barre" class="form-control" value="{{ $reference->code_barre or '' }}">
				</div>
				<div class="form-group">
					<label for="description">Description</label>
					<input type="text" name="description" id="description" placeholder="Description" class="form-control" value="{{ $reference->description or '' }}">
				</div>
				<div class="form-group">
					<label for="nb_stock">Stock actuel</label>
					<input type="number" name="nb_stock" id="nb_stock" placeholder="Stock en cours" class="form-control" value="{{ $reference->nb_stock or '' }}">
				</div>

				<div class="form-group">
					<a class="btn btn-info" href="{{ url()->previous() }}">Retour</a>
					<button type="submit" class="btn btn-info">{{ isset($reference->id) ? 'Mettre à jour' : 'Ajouter' }}</button>
				</div>
			</form>
		</div>

		@if(isset($reference->id))
		<div class="col s12" id="histo">

			<table id="dataTableHistoriqueReference">
				<thead>
					<tr>
						<th>Date</th>
						<th>Utilisateur</th>
						<th>Mouvement</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($historique as $ligne_historique)
					<tr>
						<td>{{ Carbon\Carbon::parse($ligne_historique->created_at)->format('d/m/Y H:i:s') }}</td>
						<td>{{ $ligne_historique->name }}</td>
						<td>
							@if($ligne_historique->mouvement == 'entree')
							<i class="mdi-content-add-circle-outline green-text"></i>
							@elseif($ligne_historique->mouvement == 'sortie')
							<i class="mdi-content-remove-circle-outline red-text"></i>
							@endif
							{{ $ligne_historique->mouvement }}
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		@endif
	</div>
</div>
@endsection

