<template>
    <div class="row">
        <spinner v-show="loading"></spinner>

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
                    <tr v-for= "report in list_reports" >
                        <th scope="row">{{report.user_id}}</th>
                        <td>{{report.title}}</td>
                        <td>{{report.porcentage}}</td>
                        <td>{{report.hours}}</td>
                        <td>{{ formatD(report.date) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import moment from 'moment'

export default{
    data(){
        return{
           list_reports: [],
           loading:true
       }
   },
   created(){
    this.getreporte();
},
methods:{
    getreporte: function() {
       var urlreporte ='times/reportT';
       axios.get(urlreporte).then(response =>{
        this.list_reports = response.data
        this.loading= false;
    })
   },
   formatD: function(fD) {
      return moment(fD).format('L');
  },

}
}
</script>

