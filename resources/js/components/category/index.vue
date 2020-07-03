<template>
<div>
    <div class="card pd-20 pd-sm-40">
        <h6 class="card-body-title">Category List
            <router-link to="/add/category" class="float-right btn btn-sm btn-warning">Add new</router-link>
        </h6>
        <div class="table-wrapper">
            <input type="text" v-model="searchText" placeholder="search" class="mb-3">
            <table class="table display responsive nowrap">
                <thead>
                <tr>
                    <th class="wd-15p">ID</th>
                    <th class="wd-15p">Category name</th>
                    <th class="wd-20p">Action</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="category in  filterSearch" :key="category.id">
                    <td>{{ category.id }}</td>
                    <td>{{ category.name }}</td>
                    <td>
                        <router-link :to="{name:'editCategory', params:  { id: category.id}}" class="btn btn-sm btn-success"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></router-link>
                        <button class="btn btn-sm btn-danger" @click="deletecategory(category.id)"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                    </td>
                </tr>
                <pagination :data="category" @pagination-change-page="getResults"></pagination>
                </tbody>
            </table>
        </div><!-- table-wrapper -->
    </div><!-- card -->
</div>
</template>

<script>
    import User from "../../helper/User";

    export default {
        name: "index",
        created() {
            if (! User.loggedIn()){
                this.$router.push({name:'index'});
            }
            this.getResults();
        },
        data(){
            return{
                category:{},
                searchText:'',
                data:[],
            }
        },
        methods:{
            getResults(page = 1) {
                axios.get('/api/category?page=' + page)
                    .then(response => {
                        this.category = response.data;
                        this.data=this.category.data;
                    });
            },
            deletecategory(id){
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
                        axios.delete('/api/category/'+ id)
                            .then(()=>{
                                this.data=this.data.filter(data =>{
                                    return data.id !=  id
                                })
                                Swal.fire(
                                    'Deleted!',
                                    'Category delete successfully.',
                                    'success'
                                )
                            } )
                            .catch(error => {
                                this.$route.push({name:'allCategory'});
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
                return this.data.filter( category =>{
                    if ( category.name.match(this.searchText) ){
                        return  category
                    }
                })
            }
        },
    }
</script>

<style scoped>

</style>
