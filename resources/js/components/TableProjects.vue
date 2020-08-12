<template>
    <div class="row">
        <spinner v-show="loading"></spinner>
        <div class="custom-file col-sm-12">
            <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#createProject">
               Agregar Proyecto <i class=" fas fa-plus-circle"></i>
           </button>
       </div>
       <br>
       <br>
       <div class="col-sm-12">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th scope="col">Job Number</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Gerente del proyecto</th>
                    <th scope="col">Direccion</th>
                    <th scope="col">Color</th>
                    <th scope="col">Costo</th>
                    <th scope="col">Editar/Eliminar/Ver</th>
                </tr>
            </thead>
            <tbody>

                <!-- v- for="(item, index) in items" :key="index" -->
                <tr v-for= "project in list_projects" >
                    <th scope="row">{{project.id}}</th>
                    <td>{{project.description}}</td>
                    <td>{{project.project_manager}}</td>
                    <td>{{project.address}}</td>
                    <td>{{project.color}}</td>
                    <td>{{project.cost}}</td>
                    <td>
                        <a href="#" class="btn btn btn-outline-warning btn-sm" role="button" v-on:click.prevent="editProjects()"><i class="far fa-edit"></i>
                        </a>
                        <a href="#" class="btn btn btn-outline-danger btn-sm" role="button" v-on:click.prevent="deleteProjects(project)"><i class="far fa-trash-alt"></i>
                        </a>
                        <a href="#" class="btn btn btn-outline-info btn-sm" role="button" v-on:click.prevent="infoProjects()"><i class="fas fa-info-circle"></i>
                        </a>
                    </td>
                </tr>

            </tbody>
        </table>

        <!-- Modal AGREGAR -->
        <form method="POST" v-on:submit.stop.prevent="addProject">
            <div class="modal fade" id="createProject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Agregar Departamento</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <label>Job Number</label>
                            <input type="text" class="form-control" v-model="proyecto.id">
                            <br>
                            <label>Descripción</label>
                            <input type="text" class="form-control" v-model="proyecto.description">
                            <br>
                            <label>Gerente del proyecto</label>
                            <input type="text" class="form-control" v-model="proyecto.project_manager">

                            <br>
                            <label>Direccion</label>
                            <input type="text" class="form-control"  v-model="proyecto.address">
                            <br>
                            <label>Costo</label>
                            <input type="text" class="form-control" placeholder="Costo" v-model="proyecto.cost">
                            <br>
                            <label>Color de etiqueta</label>
                            <input type="color" class="form-control" v-model="proyecto.color">


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
</div>

</template>


<script>
export default{
    data() {
        return{
            list_projects: [],
            list_manager: [],
            project: {id: '', description: '', project_manager: '', address:'', cost:'', color:''},
            proyecto: {id: '', description: '', project_manager: '', address:'', cost:'', color:''},

            loading:true
        }
    },
    created(){
        this.getProject();
        this.getnameM();
    },
    methods:{
        getProject: function() {

           var urlProjects='projects/list';
           axios.get(urlProjects).then(response =>{
            this.list_projects = response.data
            //console.log(response);
            this.loading= false;
        })
       },
       getnameM: function(){
        var urlnameM = 'projects/listnameM';
        axios.get(urlnameM).then(response =>{
            this.list_manager = response.data
           // console.log(response);
        })

       },
       addProject: function(){
        var urlGproject = 'projects/store';
        axios.post(urlGproject,{
            id: this.proyecto.id,
            description: this.proyecto.description,
            project_manager: this.proyecto.project_manager,
            address: this.proyecto.address,
            cost: this.proyecto.cost,
            color: this.proyecto.color

        }).then(response=>{
            this.getProject();

            this.proyecto.id = '';
            this.proyecto.description = '';
            this.proyecto.project_manager = '';
            this.proyecto.address= '';
            this.proyecto.cost = '';
            this.proyecto.color = "";

            $('#createProject').modal('hide');
            toastr.success('Proyecto agregado');
        }).catch(error =>{
            $('#createProject').modal('hide');
            toastr.error('Algo salio mal');

        });
       },

        deleteProjects: function(project){
     var me = this;
     toastr["warning"]("Deseas eliminar el proyecto<br /><br /><button type=?button? id='confirmationRevertYes' class='btn btn-outline-secondary'>Si</button>",'Eliminar',
     {
      closeButton: false,
      positionClass: "toast-top-center",
      allowHtml: true,
      onShown: function (toast) {
          $("#confirmationRevertYes").click(function(){
           var urlEliminar= 'projects/destroy/' + project.id;
           console.log(project);
           axios.delete(urlEliminar).then(response =>{
            me.getProject();
            toastr.success('Eliminado correctamente');
        }).catch(error =>{
            console.log(error);
            toastr.error('Error');
        });
    });
      }
  });
 },



    }
}

</script>