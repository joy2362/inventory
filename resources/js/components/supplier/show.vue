<template>
    <div class="card pd-20 pd-sm-40">
        <h6 class="card-body-title">All Supplier
            <router-link to="/add/supplier" class="float-right btn btn-sm btn-outline-primary">Add Supplier</router-link>
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
                    <th class="wd-15p">shop name</th>
                    <th class="wd-10p">Avatar</th>
                    <th class="wd-25p">Action</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="supplier in  filterSearch" :key="supplier.id">
                    <td>{{ supplier.name }}</td>
                    <td>{{ supplier.email }}</td>
                    <td>{{ supplier.phone }}</td>
                    <td>{{ supplier.address }}</td>
                    <td>{{ supplier.shopname }}</td>
                    <td > <img :src="'/'+supplier.avatar" id="supplier_avatar"> </td>
                    <td>
                        <router-link :to="{name:'editSupplier', params:  { id: supplier.id}}" class="btn btn-sm btn-success"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </router-link>
                        <button class="btn btn-sm btn-danger" @click="deletesupplier(supplier.id)"><i class="fa fa-trash-o" aria-hidden="true"></i>
                        </button>
                    </td>
                </tr>
                <pagination :data="supplier" @pagination-change-page="getResults"></pagination>
                </tbody>

            </table>
        </div><!-- table-wrapper -->
    </div><!-- card -->
</template>

<script>
    import User from "../../helper/User";

    export default {
        name: "show",
        mounted() {
            if (! User.loggedIn()){
                this.$router.push({name:'index'});
            }
            this.getResults();
        },
        data(){
            return{
                supplier:{},
                searchText:'',
                data:[],
            }
        },
        methods:{
            getResults(page = 1) {
                axios.get('/api/supplier?page=' + page)
                    .then(response => {
                        this.supplier = response.data;
                        this.data=this.supplier.data;
                    });
            },
            deletesupplier(id){
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
                        axios.delete('/api/supplier/'+ id)
                            .then(()=>{
                                this.data=this.data.filter(data =>{
                                    return data.id !=  id
                                })
                                Swal.fire(
                                    'Deleted!',
                                    'Supplier recode delete successfully.',
                                    'success'
                                )
                            } )
                            .catch(error => {
                                this.$route.push({name:'allSupplier'});
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
                return this.data.filter( supplier =>{
                    if (supplier.phone.match(this.searchText) || supplier.name.match(this.searchText) || supplier.email.match(this.searchText) || supplier.address.match(this.searchText) ){
                        return  supplier
                    }
                })
            }
        },
    }
</script>

<style scoped>
#supplier_avatar{
    height: 50px;
    width: 100px;
}
</style>
