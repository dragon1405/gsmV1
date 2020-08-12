<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Reporte</title>
</head>
<body>
	<table>
		<thead>
			<tr>
				<th>Usuario</th>
				<th>Proyecto</th>
				<th>porcentaje</th>
				<th>Horas</th>
				<th>Fecha</th>
			</tr>
		</thead>
		<tbody>
			@foreach($alltimeP as $allTime )
			<tr >
				<th>{{$allTime->user_id}}</th>
				<td>{{$allTime->title}}</td>
				<td>{{$allTime->porcentage}}</td>
				<td>{{$allTime->hours}}</td>
				<td>{{ $allTime->date }}</td>
			</tr>
			@endforeach

		</tbody>
	</table>


</body>
</html>