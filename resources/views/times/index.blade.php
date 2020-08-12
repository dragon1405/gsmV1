
@extends('layouts.app')

@section('fullcalendar')

<link rel="stylesheet" href="{{ asset('fullcalendar/core/main.css') }}">
<link rel="stylesheet" href="{{ asset('fullcalendar/daygrid/main.css') }}">

<script src="{{ asset('fullcalendar/core/main.js') }}"></script>
<script src="{{ asset('fullcalendar/interaction/main.js') }}"></script>
<script src="{{ asset('fullcalendar/daygrid/main.js') }}"></script>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		var calendarEl = document.getElementById('calendar');

		var calendar = new FullCalendar.Calendar(calendarEl, {
			plugins: [ 'dayGrid','interaction' ],
			header:{
				left:'title',
				center:'',
				right:'prev today next'
			},

			buttonText:{
				today: 'hoy'
			},
			dateClick:function(info){
				var checkDay = info.dateStr;

				var today = (new Date()).toISOString().split('T')[0];
				//alert(today);
				if (checkDay <= today) {
					$('#timeSheetDay').modal();
					$('#date').val(info.dateStr);

				} else {
					toastr["error"]("No se pueden seleccionar días futuros", "Error");

				}

            	//this.tarea.date = info.dateStr;
               // $('#dateF').val(info.dateStr);


               //console.log(info);
                //calendar.addEvent({ title:"Evento X", date:info.dateStr,color:"#688197",textColor:"#f3f6f9"});
            },
            eventClick:function(info){
            	$('#timeSheetDayE').modal();

            	$('#idE').val(info.event.id);
            	$('#projectE').val(info.event.title);
            	$('#percentageE').val(info.event.extendedProps.porcentage);
            	//
            	mes= (info.event.start.getMonth()+1);
            	dia= (info.event.start.getDate());
            	anio= (info.event.start.getFullYear());

            	mes=(mes<10)?"0"+mes:mes;
            	dia=(dia<10)?"0"+dia:dia;

            	$('#dateE').val(anio+"-"+mes+"-"+dia);
            },
            events:"{{ url('times/list') }}",
            eventRender: function(event, element) {
            	//element.find('.fc-title').append("<br/>" + event.extendedProps.porcentage);

            },

        });
		calendar.setOption('locale','es');
		calendar.render();

		//Click al boton, optienen los datos
		$('#addTime').click(function(){

			var TotalH = $("#totalT").val();

			if (TotalH === '100') {
				objDate=getdate("POST");
				savedate(objDate);
			}
			else {
				toastr["info"]("El total de horas no es 100");
			}
		});




		//cambio de variable
		$("input[name='percentage[]']").on("keyup", function(){
			var chks = document.getElementsByName('percentage[]');
			var total = 0;
			for(var i = 0; i < chks.length; i++) {
				var valor = parseInt(chks[i].value);
				if(isNaN(valor) == false) {
					total += parseInt(chks[i].value);
				}
			}
			$("#totalT").val(total);

		});


		$('#deleteTine').click(function(){
			objDate=getdate("DELETE");
			deletedate(objDate);
		});

		//Optener datos del modal
		function getdate(method){

			var item_projectx = $("input[name='project[]']")
			.map(function(){return $(this).val();}).get();

			var item_porcentagex = $("input[name='percentage[]']")
			.map(function(){return $(this).val();}).get();

			newTarea={
				item_project:JSON.stringify(item_projectx),
				item_porcentage:JSON.stringify(item_porcentagex),

				date:$('#date').val(),
				color : '#688197',
				textColor:'#f3f6f9',

				'_token':$("meta[name='csrf-token']").attr("content"),
				'_method': method
			}
			//console.log(newTarea);
			return(newTarea);
		}


		function savedate(objDate){
			$.ajax({
				type:"POST",
				url:"{{ url('times/store') }}",
				data:objDate,
				success: function(msg){
					$('#timeSheetDay').modal('hide');
					$('#project').val('');
					$('#percentage').val('');
					toastr.success('Dia agregado');
					calendar.refetchEvents();
				},
				error:function(){
					toastr.error('Algo salio mal');
				}
			});

		}

		function deletedate(objDate){

			let ide = $('#idE').val();

			$.ajax({
				type:"POST",
				url: 'times/destroy/'+ ide ,
				data: objDate,
				success: function(msg){
					$('#timeSheetDayE').modal('hide');
					toastr.success('Se ha eliminado ');
					calendar.refetchEvents();
				},
				error:function(){
					toastr.error('Algo salio mal');
				}
			});
		}
	});
</script>




@endsection

@section('content')

<div class="container">
	<div>
		<div class="pd-2 mt-4 mb-2 border-bottom">
			<div class="row">
				<div class="col-sm-6">
					<h1 class="page-header">Time Sheet</h1>
					<!-- style="color: #688197;"  -->

				</div>
				<div class="col-md-6">
					<button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#modalinfo"><h4>Selecciona un dia para agregar las horas de tarbajo<i class="fas fa-info-circle"></i></h4></button>

				</div>

			</div>

		</div>
		<div>
			<div class="container">
				<div class="row justify-content-center">

					<div class="col-md-10">
						<!--  Calendar -->
						<div id='calendar'></div>
					</div>
				</div>

				<!-- Modal Calendar ADD
					<hr>
				-->

				<div class="modal fade bd-example-modal-lg" id="timeSheetDay" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#modalinfo2"><h5 class="modal-title" id="exampleModalCenterTitle">Dia de trabajo <i class="fas fa-info-circle"></i></h5></button>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<div class="container">
									<div class="row">
										<div class="col-md-4">
											<input type="text" class="form-control" name="date" id="date" placeholder="Dia" disabled>
											<br>
										</div>
									</div>
									<div class="row">
										<div class="col-md-8">
											Proyectos
										</div>
										<div class="col-md-4">
											Horas
										</div>
										<br>
									</div>
									@foreach($projectSel as $projects)
									<div class="row">
										<div class="col-md-8">
											<input type="text" class="form-control"  value="{{ $projects->id }}" name="project[]"  disabled>
											<br>
										</div>
										<div class="col-md-4">
											<div class="input-group">
												<div class="input-group-prepend">
													<input type="number" class="form-control" placeholder="Porcentaje trabajado" name="percentage[]"  />
												</div>
												<span class="input-group-text" id="inputGroupPrepend">%</span>
											</div>
										</div>
										<br>
									</div>
									@endforeach
									<div class="row">
										<div class="col-8">
											<div class="col-sm">
												<label class="radio-inline">

													<div class="input-group">
														<div class="input-group-prepend">
															<input type="number" class="form-control" placeholder="Holiday" name="percentage[]"  />
														</div>
														<span class="input-group-text" id="inputGroupPrepend">%</span>
													</div>
												</label>
												&nbsp;
												&nbsp;
												&nbsp;
												<label class="radio-inline">
													<div class="input-group">
														<div class="input-group-prepend">
															<input type="number" class="form-control" placeholder="Sick leave" name="percentage[]"  />
														</div>
														<span class="input-group-text" id="inputGroupPrepend">%</span>
													</div>
												</label>
											</div>
											<div class="col-sm">
												<label class="radio-inline">
													<div class="input-group">
														<div class="input-group-prepend">
															<input type="number" class="form-control" placeholder="Vacation Leave" name="percentage[]"  />
														</div>
														<span class="input-group-text" id="inputGroupPrepend">%</span>
													</div>
												</label>
												&nbsp;
												&nbsp;
												&nbsp;
												<label class="radio-inline">
													<div class="input-group">
														<div class="input-group-prepend">
															<input type="number" class="form-control" placeholder="Other" name="percentage[]"  />
														</div>
														<span class="input-group-text" id="inputGroupPrepend">%</span>
													</div>
												</label>
											</div>
										</div>
										<div class="col-4">
											<div>&nbsp;</div>
											<div>&nbsp;</div>
											<br>
											<br>
											<br>
											<br>
											<div><input type="text" class="form-control" placeholder="Other" name=""  /></div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-8">
										</div>
										<div class="col-md-4">
											Total
											<div class="input-group">
												<div class="input-group-prepend">
													<input type="text" class="form-control" placeholder="Total" name="total" id="totalT" disabled>
												</div>
												<span class="input-group-text" id="inputGroupPrepend">%</span>
											</div>
										</div>
										<br>
									</div>
									<br>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
								<button id="addTime" type="submit" class="btn btn-outline-primary">Agregar</button>
							</div>
						</div>
					</div>
				</div>

				<!-- Modal Calendar EDITAR-->
				<div class="modal fade" id="timeSheetDayE" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalCenterTitle">Editar dia de trabajo</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">

								<input type="hidden" class="form-control" placeholder="Id" name="idE" id="idE">
								<br>
								<input type="text" class="form-control" placeholder="Proyecto" name="projectE" id="projectE">
								<br>
								<input type="text" class="form-control" placeholder="Porcentaje de dia trabajado" name="percentageE" id="percentageE">

								<br>
								<input type="text" class="form-control" name="dateE" id="dateE" placeholder="Dia">


							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
								<button id="editTime" type="submit" class="btn btn-outline-primary">Guardar cambio</button>
								<button id="deleteTine" type="submit" class=" btn btn-outline-danger">Eliminar</button>
							</div>
						</div>
					</div>
				</div>


				<!-- Button trigger modal -->


				<!-- Modal  instructivo-->
				<div class="modal fade" id="modalinfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLongTitle">Información</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<p class="font-weight-bold"><h4>Haz click sobre en dia donde vayas a ingresar el porcentaje de horas trabajadas</h4></p>


								<img src="{{ asset('images/calendar1.gif') }}" class="Logo rounded" alt="Cinque Terre" style="width:450px;">
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>

							</div>
						</div>
					</div>
				</div>

					<!-- Modal  instructivo2-->
				<div class="modal fade" id="modalinfo2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLongTitle">Información</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<p class="font-weight-bold"><h4>Favor de introducir las horas trabajadas a manera de porcentaje, recuerda que la suma diaria debe ser el 100%.</h4></p>


								<img src="{{ asset('images/info2.gif') }}" class="Logo rounded" alt="Cinque Terre" style="width:450px;">

								<p class="font-weight-bold"><h4>Si es necesario </h4></p>


								<img src="{{ asset('images/info3.gif') }}" class="Logo rounded" alt="Cinque Terre" style="width:450px;">
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>

							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>
@endsection