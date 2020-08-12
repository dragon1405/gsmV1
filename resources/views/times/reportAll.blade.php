@extends('layouts.app')


@section('Testf')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

<script>
	var projectsG =[];
	var hoursG=[];

	window.onload = function ()
	{
		generarGrafica();

	}

	function generarGrafica() {

		var allTimesG = @json ($allTimesG, true);


		for (var i = 0; i < allTimesG.length; i++)
		{
			projectsG.push(allTimesG[i].title);
			hoursG.push(allTimesG[i].hours);
		}
		console.log(projectsG);

		var ctx = document.getElementById('myChart').getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: projectsG,
				datasets: [{
					label: 'Numero de horas por proyecto',
					data: hoursG,
					backgroundColor: [
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 206, 86, 0.2)',
					'rgba(75, 192, 192, 0.2)',
					'rgba(153, 102, 255, 0.2)',
					'rgba(255, 159, 64, 0.2)',
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 206, 86, 0.2)',
					'rgba(75, 192, 192, 0.2)',
					'rgba(153, 102, 255, 0.2)',
					'rgba(255, 159, 64, 0.2)',
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 206, 86, 0.2)',
					'rgba(75, 192, 192, 0.2)',
					'rgba(153, 102, 255, 0.2)',
					'rgba(255, 159, 64, 0.2)',
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 206, 86, 0.2)',
					'rgba(75, 192, 192, 0.2)',
					'rgba(153, 102, 255, 0.2)',
					'rgba(255, 159, 64, 0.2)'
					],
					borderColor: [
					'rgba(255, 99, 132, 1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)',
					'rgba(153, 102, 255, 1)',
					'rgba(255, 159, 64, 1)',
					'rgba(255, 99, 132, 1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)',
					'rgba(153, 102, 255, 1)',
					'rgba(255, 159, 64, 1)',
					'rgba(255, 99, 132, 1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)',
					'rgba(153, 102, 255, 1)',
					'rgba(255, 159, 64, 1)',
					'rgba(255, 99, 132, 1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)',
					'rgba(153, 102, 255, 1)',
					'rgba(255, 159, 64, 1)'
					],
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero: true
						}
					}]
				}
			}
		});
	};

	function excel(alltimepdf) {

		console.log(projectsG);
	};


	$(document).ready(function(){


	});


</script>


</script>
@endsection

@section('content')
<div class="container">
	<div>
		<div class="pd-2 mt-4 mb-2 border-bottom">
			<div>
				<div class="col-md-4"><h1 class="page-header">Time Sheet</h1></div>
				<form class="navbar-form" action="{{url('times/search')}}">

					<div class="form-group row">
						<div class="col-xs-2">
							<select class="form-control" size="3" multiple name="Busuario[]">
								<optgroup label="Selecciona Usuario">
									@foreach($allUsers as $allUser)
									<option value="{{ $allUser->id }}">{{ $allUser->id }}</option>
									@endforeach
								</optgroup>
							</select>
						</div>
						&nbsp;
						<div class="col-xs-2">
							<select class="form-control" size="3" multiple name="Bproyecto[]">
								<optgroup label="Selecciona Proyecto">
									@foreach($allProjects as $allProject)
									<option value="{{ $allProject->id }}">{{ $allProject->id }}</option>
									@endforeach
								</optgroup>
							</select>
						</div>

						&nbsp;
						<div class="col-xs-1">
							<div class="input-group date">
								<input type="text" class="form-control"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
							</div>

						</div>
						&nbsp;
						<div class="col-xs-1">

							<input class="form-control" id="Bff" name="Bff" type="text" placeholder="Fecha final">
						</div>
						&nbsp;
						<div class="col-xs-2">
							<button id="editTime" type="submit" class="btn btn-outline-primary">Buscar <i class="fas fa-search"></i></button>
						</div>
					</form>
					&nbsp;
					<div class="col-xs-2">
						<a class=" btn btn-outline-danger" href="{{ route('times.Rpdf') }}">PDF <i class="far fa-file-pdf"></i></a>

					</div>
					&nbsp;
					<div class="col-xs-2">
						<a class="btn btn-outline-success" href="{{ route('times.Rexcel') }}" >Excel <i class="far fa-file-excel"></i></a>
					</div>

				</div>

			</div>

			<div>
				{{-- <table-reportsall :timesR = "{{ json_encode($timesAll) }}"></table-reportsall> --}}

				<div class="row">
					{{-- <spinner v-show="loading"></spinner> --}}

					<div class="custom-file col-sm-12">
					</div>
					<br>
					<br>
					<div class="col-sm-12">
						<table class="table table-hover table-striped">
							<thead>
								<tr>
									<th scope="col">Usuario</th>
									<th scope="col">Proyecto</th>
									<th scope="col">porcentaje</th>
									<th scope="col">Horas</th>
									<th scope="col">Fecha</th>
								</tr>
							</thead>
							<tbody>
								<!-- v- for="(item, index) in items" :key="index" -->
								@foreach($allTimes as $allTime )
								<tr >
									<th scope="row">{{$allTime->user_id}}</th>
									<td>{{$allTime->title}}</td>
									<td>{{$allTime->porcentage}}</td>
									<td>{{$allTime->hours}}</td>
									<td>{{ $allTime->date }}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
						{{ $allTimes -> links() }}
					</div>

				</div>

			</div>
		</div>

	</div>
	<div class="col-sm-6">
		<canvas id="myChart" width="300" height="300"></canvas>
	</div>

</div>
@endsection