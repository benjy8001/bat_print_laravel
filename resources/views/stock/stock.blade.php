@extends('layouts.app')


@section('breadcrumbs')
<div id="breadcrumbs-wrapper">
	<div class="container">
		<div class="row">
			<div class="col s12 m12 l12">
				<h5 class="breadcrumbs-title">Stock</h5>
				<ol class="breadcrumbs">
					<li class="active">Récapitulatif</li>
				</ol>
			</div>
		</div>
	</div>
</div>
@endsection

@section('content')
<div class="right">
	<a class="btn btn-app" href="{{ route('createReference') }}">
		<i class="fa fa-plus-square"></i> Ajouter
	</a>
</div>

<table id="dataTableStock">
	<thead>
		<tr>
			<th data-field="id">Code barre</th>
			<th data-field="name">Description</th>
			<th data-field="price">Stock</th>
			<th data-field="action"></th>
		</tr>
	</thead>
	<tbody>
		@foreach ($references as $reference)
		<tr>
			<td>{{ $reference->code_barre }}</td>
			<td>{{ $reference->description }}</td>
			<td>{{ $reference->nb_stock }}</td>
			<td>
				<a class="btn-floating waves-effect waves-light grey" href="{{ route('updateReference', ['id' => $reference->id]) }}"><i class="mdi-editor-border-color"></i></a>
				@if(Auth::user()->hasRole('administrateur'))
				<a class="btn-floating waves-effect waves-light red" href="javascript:deleteThis('{{ route('deleteReference', ['id' => $reference->id]) }}');"><i class="mdi-content-clear"></i></a>
				@endif
			</td>
		</tr>
		@endforeach

	</tbody>
</table>

<form class="delete" id="formDelete" action="" method="POST" style="display: none;">
	{{ csrf_field() }}
	<input type="hidden" name="_method" value="DELETE">
</form>

@endsection


@section('custom_css')
<link href="{{ asset('assets/js/plugins/data-tables/css/jquery.dataTables.min.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
@endsection

@section('custom_js')
document.write('<script src="{{ asset('assets/js/plugins/data-tables/js/jquery.dataTables.min.js') }}"><\/script>');
	document.write('<script src="{{ asset('assets/js/stock/stock.js') }}"><\/script>');
	@endsection
