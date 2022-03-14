@extends('layouts.app')


@section('breadcrumbs')
<div id="breadcrumbs-wrapper">
	<div class="container">
		<div class="row">
			<div class="col s12 m12 l12">
				<h5 class="breadcrumbs-title">Utilisateurs</h5>
				<ol class="breadcrumbs">
					<li class="active">Liste des utilisateurs</li>
				</ol>
			</div>
		</div>
	</div>
</div>
@endsection

@section('content')
<div class="right">
	<a class="btn btn-app" href="{{ route('createUser') }}">
		<i class="fa fa-plus-square"></i> Ajouter
	</a>
</div>

<table id="dataTableUsers">
	<thead>
		<tr>
			<th data-field="id">Nom</th>
			<th data-field="mail">Email</th>
			<th data-field="name">Profil</th>
			<th data-field="price">Date de création</th>
			<th data-field="action"></th>
		</tr>
	</thead>
	<tbody>
		@foreach ($users as $user)
		<tr>
			<td>{{ $user->name }}</td>
			<td>{{ $user->email }}</td>
			<td>{{ $user->roles()->first()->name }}</td>
			<td>{{ Carbon\Carbon::parse($user->created_at)->format('d/m/Y H:i:s')  }}</td>
			<td>
				<a class="btn-floating waves-effect waves-light grey" href="{{ route('updateUser', ['id' => $user->id]) }}"><i class="mdi-editor-border-color"></i></a>
				<a class="btn-floating waves-effect waves-light red" href="javascript:deleteThis('{{ route('deleteUser', ['id' => $user->id]) }}');"><i class="mdi-content-clear"></i></a>
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
	document.write('<script src="{{ asset('assets/js/user/liste.js') }}"><\/script>');
	@endsection
