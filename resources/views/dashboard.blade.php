@extends('layouts.app')

@section('content')
<div id="card-stats">
	<div class="row">
		<div class="col s12 m6 l3">
			<div class="card">
				<div class="card-content  green white-text">
					<p class="card-stats-title"><i class="mdi-content-content-paste"></i> Stock ajouté</p>
					<h4 class="card-stats-number">{{ $today_add->nb }}</h4>
					<p class="card-stats-compare"><i class="mdi-hardware-keyboard-arrow-up"></i> {{ $pourcentage_add_from_yesterday }}% <span class="green-text text-lighten-5">par rapport à hier</span>
					</p>
				</div>
				<div class="card-action  green darken-2 center-align">
					<!--<div id="clients-bar" class="center-align"><canvas width="227" height="25" style="display: inline-block; width: 227px; height: 25px; vertical-align: top;"></canvas></div>-->

					<a class="waves-effect waves-light  btn" href="{{ route('entrees') }}"><i class="mdi-content-add left"></i>Ajouter</a>
				</div>
			</div>
		</div>
		<div class="col s12 m6 l3">
			<div class="card">
				<div class="card-content blue-grey white-text">
					<p class="card-stats-title"><i class="mdi-content-inbox"></i> Stock retiré</p>
					<h4 class="card-stats-number">{{ $today_remove->nb }}</h4>
					<p class="card-stats-compare"><i class="mdi-hardware-keyboard-arrow-up"></i> {{ $pourcentage_remove_from_yesterday }}% <span class="blue-grey-text text-lighten-5">par rapport à hier</span>
					</p>
				</div>
				<div class="card-action blue-grey darken-2 center-align">

					<a class="waves-effect waves-light  btn" href="{{ route('sorties') }}"><i class="mdi-content-remove left"></i>Retirer</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
