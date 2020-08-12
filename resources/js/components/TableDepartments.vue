<template>
    <div class="row">
        <spinner v-show="loading"></spinner>

        <div class="custom-file col-sm-12">
            <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#createdDepartment">
             Agregar Departamento <i class=" fas fa-plus-circle"></i>
         </button>



     </div>
     <br>
     <br>
     <div class="col-sm-12">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th scope="col">Departamentos</th>
                    <th scope="col">Gerente</th>
                    <th scope="col">Editar/Eliminar/Ver</th>
                </tr>
            </thead>
            <tbody>

                <!-- v- for="(item, index) in items" :key="index" -->
                <tr v-for= "department in list_departments" >
                    <th scope="row">{{department.name}}</th>
                    <td>{{department.manager}}</td>
                    <td>
                        <a href="#" class="btn btn btn-outline-warning btn-sm" role="button" v-on:click.prevent="editDepartment()"><i class="far fa-edit"></i>
                        </a>
                        <a href="#" class="btn btn btn-outline-danger btn-sm" role="button" v-on:click.prevent="deleteDepartment(department)"><i class="far fa-trash-alt"></i>
                        </a>
                        <a href="#" class="btn btn btn-outline-info btn-sm" role="button" v-on:click.prevent="infoDepartment()"><i class="fas fa-info-circle"></i>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>


        <!-- Modal AGREGAR -->
        <form method="POST" v-on:submit.stop.prevent="addDepartment">
            <div class="modal fade" id="createdDepartment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Agregar Departamento</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="text" class="form-control" placeholder="Departamento" v-model="departamento.name">
                            <br>
                            <input type="text" class="form-control" placeholder="Gerente" v-model="departamento.manager">
                            <br>

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
    data(){
        return{
            list_departments: [],
            department: {id: '', name: '', manager: '' },
            departamento: {name: '', manager: ''},
            loading:true
        }
    },
    created(){
        this.getDepartment();
    },
    methods:{
        getDepartment: function () {
            var urlDepartments='departments/list';
            axios.get(urlDepartments).then(response =>{
                this.list_departments = response.data
                this.loading= false;
            })
        },
        addDepartment: function(){
            var urlGdepartment ='departments/store';
            axios.post(urlGdepartment, {
                name: this.departamento.name,
                manager: this.departamento.manager

            })
            .then(response =>{
                this.getDepartment();

                this.departamento.name = '';
                this.departamento.manager = '';

                toastr.success('Departamento Agregado');


                $('#createdDepartment').modal('hide');
            }).catch(error =>{
                $('#createdDepartment').modal('hide');
                console.log(error);
            toastr.error('Algo salio mal');


            });
        },
        deleteDepartment: function(department){
         var me = this;
         toastr["warning"]("Deseas eliminar el departamento <br /><br /><button type=?button? id='confirmationRevertYes' class='btn btn-outline-secondary'>Si</button>",'Eliminar',
         {
          closeButton: false,
          positionClass: "toast-top-center",
          allowHtml: true,
          onShown: function (toast) {
              $("#confirmationRevertYes").click(function(){
                 var urlEliminar= 'departments/destroy/' + department.id;
                 axios.delete(urlEliminar).then(response =>{
                    me.getDepartment();
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
