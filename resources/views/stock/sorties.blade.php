@extends('layouts.app')

@section('content')

<form action="{{ route('removeStock') }}" name="formRemoveStock" id="formRemoveStock" method="POST">
	{{ csrf_field() }}
	<div class="row">
		<div class="input-field col s12 m5 l5">
			<i class="mdi-content-reply-all prefix"></i>
			<input id="code_barre" type="text" name="code_barre" class="validate" value="">
			<label for="code_barre">Référence à sortir</label>
		</div>
		<div class="input-field col s12 m2 l2">
			<button class="btn cyan waves-effect waves-light right" type="submit" name="action">Retirer
				<i class="mdi-content-remove-circle right"></i>
			</button>
		</div>
	</div>
</form>

<div class="divider"></div>



<div class="row">
	<div class="col s12 m12 l6 offset-l3">
		<ul id="issues-collection" class="collection">
			<li class="collection-item avatar avatar2">
				<i class="mdi-action-announcement circle red darken-2"></i>
				<span class="collection-header">Sorties du jour</span>
			</li>

			@forelse ($references as $reference)
			<li class="collection-item">
				<div class="row">
					<div class="col s7">
						<p class="collections-title"><strong>{{ $reference->code_barre }}</strong></p>
						<p class="collections-content">{{ $reference->description }}</p>
					</div>
					<div class="col s2">
						<span class="task-cat pink accent-2">{{ $reference->nb }}</span>
					</div>
					<div class="col s3">
						<span class="task-cat pink accent-2">{{ $reference->nb_stock }}</span>
						<div class="progress">
							<div class="determinate" style="width: 10%"></div>
						</div>
					</div>
				</div>
				@empty
				<li class="collection-item">
					<div class="row">
						<div class="col s12">
							<p class="collections-title"><strong>Aucune sorties ce jour</strong></p>
							<p class="collections-content"></p>
						</div>
					</div>
				</li>
				@endforelse
			</ul>
		</div>
	</div>

	@endsection


	@section('custom_js')
	document.write('<script src="{{ asset('assets/js/stock/sorties.js') }}"><\/script>');
		@endsection
