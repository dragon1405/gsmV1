@extends('layouts.app')

@section('content')
<div class="container">
	<div>
	<div class="pd-2 mt-4 mb-2 border-bottom">
		<h1 class="page-header">Proyectos</h1>
        <div>
            <table-projects :projects = "{{ json_encode($projects) }}"></table-projects>
        </div>
	</div>
</div>
</div>
@endsection