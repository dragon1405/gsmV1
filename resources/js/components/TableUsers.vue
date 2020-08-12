<template>
    <div class="row">
        <spinner v-show="loading"></spinner>
        <div class="custom-file col-sm-12">
            <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#createUsuar">
             Agregar Usuario <i class=" fas fa-plus-circle"></i>
         </button>
     </div>
     <br>
     <br>
     <div class="col-sm-12">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Editar/Eliminar/Ver</th>
                </tr>
            </thead>
            <tbody>
                <!-- v- for="(item, index) in items" :key="index" -->
                <tr v-for= "user in list_users" >

                    <th scope="row">{{user.id}}</th>
                    <td>{{user.name}}</td>
                    <td>{{user.email}}</td>
                    <td>
                        <a href="#" class="btn btn btn-outline-warning btn-sm" role="button" v-on:click.prevent="editUsuario(usuario)"><i class="far fa-edit"></i>
                        </a>
                        <a href="#" class="btn btn btn-outline-danger btn-sm" role="button" v-on:click.prevent="deleteUsuario(usuario)"><i class="far fa-trash-alt"></i>
                        </a>
                        <a href="#" class="btn btn btn-outline-info btn-sm" role="button" v-on:click.prevent="deleteUsuario(usuario)"><i class="fas fa-info-circle"></i>
                        </a>
                    </td>
                </tr>

            </tbody>
        </table>

        <!-- Modal AGREGAR -->
        <form method="POST" v-on:submit.stop.prevent="addUser">
            <div class="modal fade" id="createUsuar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Agregar Usuario</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <input type="text" class="form-control" placeholder="No. Empleado" v-model="usuario.id">
                            <br>
                            <input type="text" class="form-control" placeholder="Nombre completo" v-model="usuario.name">
                            <br>
                            <select name="department" class="form-control" id="departmentD">
                                <option class="not" value="">Selecciona departamento</option>
                            </select>
                            <br>
                            <select name="department" class="form-control" id="departmentD">
                                <option class="not" value="">Seleccione centro de trabajo</option>
                                 <option class="not" value="">Oficina Central</option>
                                 <option class="not" value="">Oficina Remota</option>
                                 <option class="not" value="">Obra en Construcción</option>

                            </select>
                                 <br>
                            <input type="email" class="form-control" placeholder="Total de vaciones por año" >
                            <br>
                            <input type="email" class="form-control" placeholder="Email" v-model="usuario.email">
                            <br>
                            <input type="password" class="form-control" placeholder="Contraseña" v-model="usuario.password">
                            <br>
                            <input type="text" class="form-control" placeholder="Salario Base" >
                            <br>

                            <input type="text" class="form-control" placeholder="Salario Integrado" >
                            <br>
                            <input type="text" class="form-control" placeholder="Salario Ventas 1" >
                            <br>
                            <input type="text" class="form-control" placeholder="Salario Ventas 2" >
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
import $ from 'jquery'
export default{
    data() {
        return{
            list_users: [],
            user: {id: '',name: '',email: ''},
            usuario:{id:'', name: '', email:'', password:''},

            department:{id:'',name:'' },
            loading:true,
        }
    },
    created(){
        this.getUsers();
        this.getD();
    },
    methods:{
        getUsers: function() {
           var urlUsers="users/list";
           axios.get(urlUsers).then(response =>{
            this.list_users = response.data

            this.loading= false;
        })
       },



       getD: function(){
        let urld = "users/listD";
            $.get(urld)
            .done(function(data){
                console.log(data);
                let output = '';
                $.each(data, function(index, value){

                    output += `<option value="${value.id}">${value.name}</option>`
                })
                $('#departmentD').append(output)
            })

       },
/*
       getD: function(){
        var urld = "users/listD";
        axios.get(urld).then(response=>{
            this.list_departments = response.data

            console.log(this.list_departments);
        })

    },
       */
       addUser: function(){
        var urlGuser='users/store';
        axios.post(urlGuser,{
            id: this.usuario.id,
            name: this.usuario.name,
            email: this.usuario.email,
            password: this.usuario.password

        }).then(response =>{
            this.getUsers();

            this.usuario.id='';
            this.usuario.name='';
            this.usuario.email='';
            this.usuario.password='';
            //console.log(response);

            $('#createUsuar').modal('hide');
            toastr.success('Usuario Agregado');

        }).catch(error =>{
            $('#createUsuar').modal('hide');
            toastr.error('Algo salio mal');
            //console.log(error);

        });
    },

},
}

</script>