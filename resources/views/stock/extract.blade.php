@extends('layouts.app')


@section('breadcrumbs')
<div id="breadcrumbs-wrapper">
	<div class="container">
		<div class="row">
			<div class="col s12 m12 l12">
				<h5 class="breadcrumbs-title">Stock</h5>
				<ol class="breadcrumbs">
					<li class="active">Extractions</li>
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
				<a class="grey darken-2 white-text active" href="#etat">Etat du stock</a>
			</li>
			<li class="tab col s3">
				<a class="grey darken-2 white-text" href="#conso">Consommation</a>
			</li>
		</ul>
	</div>

	<div class="col s12">
		<div class="col s12" id="etat">
			<form method="post" action="{{ route('getExtractEtatStock') }}" name="formExtractEtatStock" id="formExtractEtatStock">
				{{ csrf_field() }}
				<div class="form-group">
					<button type="button" class="btn btn-info" id="btnGetExtractEtatStock"><i class="mdi-action-assignment-returned left"></i> Sortir l'état du stock</button>
				</div>
			</form>
			<div id="divExtractEtatStock"></div>
		</div>

		<div class="col s12" id="conso">

			<form method="post" action="{{ route('getExtractConso') }}" name="formExtractConso" id="formExtractConso">
				{{ csrf_field() }}
				<div class="row">
					<div class="form-group col s6">
						<label for="code_barre">Code barre</label>
						<input type="text" name="code_barre" id="code_barre" placeholder="Code barre" class="form-control" value="">
					</div>
				</div>
				<div class="row">
					<div class="form-group col s6">
						<label for="date_debut">Date début</label>
						<input type="text" name="date_debut" id="date_debut" placeholder="" class="pickadate form-control" value="{{ date('d/m/Y') }}">
					</div>
					<div class="form-group col s6">
						<label for="date_fin">Date fin</label>
						<input type="text" name="date_fin" id="date_fin" placeholder="" class="pickadate form-control" value="{{ date('d/m/Y') }}">
					</div>
				</div>

				<div class="form-group">
					<button type="button" class="btn btn-info"  id="btnGetExtractConso"><i class="mdi-action-assignment-returned left"></i> Extraction</button>
				</div>
			</form>
			<div id="divExtractConso"></div>

		</div>
	</div>
</div>

@endsection


@section('custom_js')
document.write('<script src="{{ asset('assets/js/stock/extract.js') }}"><\/script>');
	@endsection
