<template>
    <div>
        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Product List
                <router-link to="/add/product" class="float-right btn btn-sm btn-outline-primary">Add New</router-link>
            </h6>
            <div class="table-wrapper">
                <input type="text" v-model="searchText" placeholder="search" class="mb-3">
                <table class="table display responsive nowrap">
                    <thead>
                    <tr>
                        <th class="wd-15p">Product name</th>
                        <th class="wd-15p"> Image</th>
                        <th class="wd-15p"> Buying Price</th>
                        <th class="wd-15p"> Selling Price</th>
                        <th class="wd-15p"> Stock</th>
                        <th class="wd-20p">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="product in  filterSearch" :key="product.id">
                        <td>{{product.product_name}}</td>
                        <td > <img :src="'/'+product.image" id="product_img"> </td>
                        <td>{{product.buying_price}}</td>
                        <td>{{product.selling_price}}</td>
                        <td>{{product.product_quentity}}</td>
                        <td>
                            <router-link :to="{name:'showProduct', params:  { id: product.id}}" class="btn btn-sm btn-primary "> <i class="fa fa-window-maximize" aria-hidden="true"></i> </router-link>
                            <router-link :to="{name:'editProduct', params:  { id: product.id}}" class="btn btn-sm btn-success"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> </router-link>
                            <button class="btn btn-sm btn-danger" @click="deleteProduct(product.id)"> <i class="fa fa-trash-o" aria-hidden="true"></i> </button>
                        </td>
                    </tr>
                    </tbody>
                    <pagination :data="product" @pagination-change-page="getResults"></pagination>
                </table>
            </div><!-- table-wrapper -->
        </div><!-- card -->
    </div>
</template>

<script>
    import User from "../../helper/User";

    export default {
        name: "index",
        created(){
            if (! User.loggedIn()){
                this.$router.push({name:'index'});
            }
            this.getResults();
        },
        data(){
            return {
                product:{},
                searchText:'',
                data:[],
            }
        },
        methods:{
            getResults(page = 1) {
                axios.get('/api/product?page=' + page)
                    .then(response => {
                        this.product = response.data;
                        this.data=this.product.data;
                    });
            },
            deleteProduct(id){
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
                        axios.delete('/api/product/'+ id)
                            .then(()=>{
                                this.data=this.data.filter(data =>{
                                    return data.id !=  id
                                })
                                Swal.fire(
                                    'Deleted!',
                                    'Product delete successfully.',
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
                return this.data.filter( product =>{
                    if ( product.product_name.match(this.searchText) ){
                        return  product
                    }
                })
            }
        },
    }
</script>

<style scoped>
#product_img{
    height: 50px;
    width: 100px;
}
</style>
