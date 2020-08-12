<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <!--  Calendar -->
                <div id='calendar'></div>
            </div>
        </div>

        <!-- Modal Calendar-->
        <form method="POST" v-on:submit.stop.prevent="addTime">

            <div class="modal fade" id="timeSheetDay" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Dia de trabajo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">


                <input type="text" class="form-control" placeholder="Proyecto" v-model="tarea.project_id">
                <br>
                <input type="text" class="form-control" placeholder="Porcentaje de dia trabajado" v-model="tarea.porcentage">
                <br>
                <input type="text" class="form-control" placeholder="Dia" v-model="tarea.date">
                <br>
                <input type="text" class="form-control" name="dateF" id="dateF" placeholder="Dia" v-model="dateF">


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-outline-primary">Agregar</button>
            </div>
        </div>
    </div>
</div>
</form>

</div>

</template>
<script>



export default {
   data(){
    return{
        tarea: {project_id:'', porcentage:'', date:''},
        dateF:'',
    }

},

created() {
 this.getcalendar();
 //this.getdate();
// this.dateF = this.info.dateStr;
 //$('#dateF').val(info.dateStr);
},
methods:{
    getcalendar: function(){
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
            $('#timeSheetDay').modal();
            //this.tarea.date = info.dateStr;
               // $('#dateF').val(info.dateStr);
               $('#dateF').val(info.dateStr);

               console.log(info);
                //calendar.addEvent({ title:"Evento X", date:info.dateStr,color:"#688197",textColor:"#f3f6f9"});
            },
            eventClick:function(info){
               /* console.log(info);
                console.log(info.event.title);
                console.log(info.event.start);

                console.log(info.event.end);
                console.log(info.event.textColor);
                console.log(info.event.backgroundColor);

                console.log(info.event.extendedProps.project);
                console.log(info.event.extendedProps.descripcion);*/
            },
            events:[
            {
                title:"Test",
                start:"2020-02-04 12:30:00",
                project:"Proyecto Iztapl",
                descripcion:"80%",
                color:"#688197",
                textColor:"#f3f6f9"
            },{
                title:"Test 2",
                start:"2020-02-04 12:30:00",
                project:"Proyecto playa",
                descripcion:"50%",
                color:"#688197",
                textColor:"#f3f6f9"
            }
            ]
        });
        calendar.setOption('locale','es')
        calendar.render();
    });
   },
   getdate: function(){
    this.tarea.date = dateF ;

   },
   addTime: function(){
    var urlGtime ='times/store';
    axios.post(urlGtime, {
        project_id: this.tarea.project_id,
        porcentage:this.tarea.porcentage,
        date : this.tarea.date

    })
    .then(response =>{

        this.tarea.project_id='';
        this.tarea.porcentage='';
        this.tarea.date='';

        toastr.success('Tareas Agregado');
        $('#timeSheetDay').modal('hide');

    }).catch(error =>{
        $('#timeSheetDay').modal('hide');
        console.log(error);
        toastr.error('Algo salio mal');

    });

},
}
}


</script>