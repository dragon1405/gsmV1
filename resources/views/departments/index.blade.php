@extends('layouts.app')

@section('content')
<div class="container">
	<div>
	<div class="pd-2 mt-4 mb-2 border-bottom">
		<h1 class="page-header">Departamentos</h1>
        <div>
            <table-departments :departments = "{{ json_encode($departments) }}"></table-departments>
        </div>
	</div>

</div>

</div>
@endsection