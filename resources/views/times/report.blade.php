@extends('layouts.app')

@section('content')
<div class="container">
	<div>
		<div class="pd-2 mt-4 mb-2 border-bottom">
			<div>
				<form>
					<div class="form-group row">
				<div class="col-md-4"><h1 class="page-header">Time Sheet</h1></div>
						<div class="col-xs-2">

							<input class="form-control" id="ex1" type="text" placeholder="Proyecto">
						</div>
						&nbsp;
						<div class="col-xs-1">

							<input class="form-control" id="ex2" type="text" placeholder="Fecha inicio">
						</div>
						&nbsp;
						<div class="col-xs-1">

							<input class="form-control" id="ex3" type="text" placeholder="Fecha final">
						</div>
						&nbsp;
						<div class="col-xs-2">
							<button id="editTime" type="submit" class="btn btn-outline-primary">Buscar</button>
						</div>
					</div>
				</form>

			</div>

			<div>
				<table-reports :timesR = "{{ json_encode($timesR) }}"></table-reports>
			</div>
		</div>

	</div>

</div>
@endsection
