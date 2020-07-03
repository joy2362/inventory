<template>
    <div>

        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">All Supplier
                <router-link to="/add/employee" class="float-right btn btn-sm btn-outline-primary">Add Supplier</router-link>
            </h6>
            <div class="table-wrapper">
                    <input type="text" v-model="searchText" placeholder="search" class="mb-3">
                <table  class="table display responsive nowrap">
                    <thead>
                    <tr>
                        <th class="wd-15p">Name</th>
                        <th class="wd-15p">E-mail</th>
                        <th class="wd-20p">Phone</th>
                        <th class="wd-15p">Address</th>
                        <th class="wd-10p">Salary</th>
                        <th class="wd-10p">Avatar</th>
                        <th class="wd-25p">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="employee in  filterSearch" :key="employee.id">
                        <td>{{ employee.name }}</td>
                        <td>{{ employee.email }}</td>
                        <td>{{ employee.phone }}</td>
                        <td>{{ employee.address }}</td>
                        <td>{{ employee.salary }}</td>
                        <td > <img :src="'/'+employee.avatar" id="emp_img"> </td>
                        <td>
                            <router-link :to="{name:'edit/employee', params:  { id: employee.id}}" class="btn btn-sm btn-success"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></router-link>
                            <button class="btn btn-sm btn-danger" @click="deleteEmp(employee.id)"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                        </td>
                    </tr>
                        <pagination :data="employees" @pagination-change-page="getResults"></pagination>
                    </tbody>

                </table>
            </div><!-- table-wrapper -->
        </div><!-- card -->
    </div>
</template>

<script>
    import User from "../../helper/User";

    export default {
        name: "allEmployee",
        mounted() {
            if (! User.loggedIn()){
                this.$router.push({name:'index'});
            }
            this.getResults();
        },
        data(){
            return{
                employees:{},
                searchText:'',
                data:[],
            }
        },
        methods:{
            getResults(page = 1) {
                axios.get('/api/employee?page=' + page)
                    .then(response => {
                        this.employees = response.data;
                        this.data=this.employees.data;
                    });
            },
            deleteEmp(id){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        axios.delete('/api/employee/'+ id)
                        .then(()=>{
                            this.data=this.data.filter(data =>{
                                return data.id !=  id
                            })
                            Swal.fire(
                                'Deleted!',
                                'Employee recode delete successfully.',
                                'success'
                            )
                        } )
                        .catch(error => {
                            this.$route.push({name:'allEmployee'});
                            Swal.fire(
                                'Sorry!',
                                'Something wrong try again.',
                                'error'
                            )

                        })
                    }
                })

            }
        },
        computed:{
            filterSearch(){
               return this.data.filter( employee =>{
                   if (employee.phone.match(this.searchText) || employee.name.match(this.searchText) || employee.email.match(this.searchText) || employee.address.match(this.searchText) ){
                       return  employee
                   }
                })
            }
        },

    }
</script>

<style scoped>
    #emp_img{
        height: 50px;
        width: 100px;
    }

</style>
