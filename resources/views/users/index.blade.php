@extends('layouts.app')

@section('content')
<div class="container">
	<div>
	<div class="pd-2 mt-4 mb-2 border-bottom">
		<h1 class="page-header">Usuarios</h1>
        <div>
            <table-users :users = "{{ json_encode($users) }}"
            >
            </table-usesr>
        </div>
	</div>

</div>

</div>
@endsection