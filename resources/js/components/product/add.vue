<template>
<div id="add">
        <div class="card pd-20 pd-sm-40 mg-t-50">
            <h6 class="card-body-title">New Product
                <router-link to="/all/product" class="float-right btn btn-sm btn-outline-primary">ALL PRODUCT</router-link>
            </h6>
            <p>Add new Product recode to the database</p>
            <form @submit.prevent="addProduct" enctype="multipart/form-data">
                <div class="form-layout">
                    <div class="row mg-b-25 mb-5">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Product Name: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" v-model="form.product_name">
                                <small class="text-danger" v-if="error.product_name" >{{error.product_name}}</small>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Product Code: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" v-model="form.product_code">
                                <small class="text-danger" v-if="error.product_code" >{{error.product_code}}</small>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Product Stock <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" v-model="form.product_quentity">
                                <small class="text-danger" v-if="error.product_quentity" >{{error.product_quentity}}</small>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-3">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Category: <span class="tx-danger">*</span></label>
                                <select class="form-control select2" data-placeholder="Choose Category" v-model="form.category_id">
                                    <option label="Choose Category"></option>
                                    <option v-for="category in categories":key="category.id"  :value="category.id">{{category.name}}</option>
                                </select>
                                <small class="text-danger" v-if="error.category_id" >{{error.category_id}}</small>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label">Root: </label>
                                <input class="form-control" type="text"v-model="form.root" >
                            </div>
                        </div><!-- col-6 -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label">Buying date: </label>
                                <input class="form-control" type="date" v-model="form.buying_date">
                            </div>
                        </div><!-- col-6 -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label">Expire date </label>
                                <input class="form-control" type="date" v-model="form.product_expiredate">

                            </div>
                        </div><!-- col-6 -->
                        <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Supplier: </label>
                                <select class="form-control select2" data-placeholder="Choose Supplier" v-model="form.supplier_id">
                                    <option label="Choose Supplier"></option>
                                    <option v-for="supplier in suppliers":key="supplier.id"  :value="supplier.id">{{supplier.name}}</option>
                                </select>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Buying Price: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" v-model="form.buying_price">
                                <small class="text-danger" v-if="error.buying_price" >{{error.buying_price}}</small>
                            </div>
                        </div><!-- col-6 -->
                        <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Selling Price <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" v-model="form.selling_price">
                            <small class="text-danger" v-if="error.selling_price" >{{error.selling_price}}</small>
                        </div>
                    </div><!-- col-6 -->
                        <div class="col-lg-4">
                            <label>Image<span class="tx-danger">*</span></label>
                            <label class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile" @change="onfileselect" >
                                <label class="custom-file-label" for="customFile">Choose Image</label>
                                <small class="text-danger" v-if="error.image" >{{error.image}}</small>
                                <img :src="form.image" id="one" class="mt-2" v-if="form.image" style="height:100px; width:100px;">
                            </label>
                        </div>
                    </div><!-- row -->
                    <hr>
                    <div class="form-layout-footer">
                        <button class="btn btn-info mg-r-5" type="submit">Save </button>
                    </div><!-- form-layout-footer -->
                </div>
            </form>
        </div><!-- card -->
</div>
</template>

<script>
    import User from "../../helper/User";

    export default {
        name: "add",
        data(){
            return {
                categories:{},
                suppliers:{},
                form:{
                    category_id:'',
                    supplier_id:'',
                    product_name:'',
                    product_code:'',
                    root:'',
                    image:'',
                    buying_price:'',
                    selling_price:'',
                    buying_date:'',
                    product_quentity:'',
                    product_expiredate:''
                },
                error:{
                    category_id:'',
                    supplier_id:'',
                    product_name:'',
                    product_code:'',
                    root:'',
                    image:'',
                    buying_price:'',
                    selling_price:'',
                    buying_date:'',
                    product_quentity:'',
                    product_expiredate:''
                },
            }
        },
        methods:{
            getCategory(){
                axios.get('/api/all/category')
                    .then(({data})=>{
                        this.categories=data;
                    })
                    .catch(error=>{
                        this.$router.push({name: 'home'})
                    })
            },
            getSupplier(){
                axios.get('/api/all/supplier')
                    .then(({data})=>{
                        this.suppliers=data;
                    })
                    .catch(error=>{
                        this.$router.push({name: 'home'})
                    })
            },
            onfileselect(event){
                let file=event.target.files[0];
                if(file.type === "image/png" || file.type === "image/jpg" || file.type === "image/JPG" ||file.type === "image/jpeg" ){
                    if(file.size >2000000){
                        Toast.fire({
                            icon: 'error',
                            title: 'File Size must be less then 2mb'
                        })
                    }else{
                        let reader = new FileReader();
                        reader.onload= event =>{
                            this.form.image = event.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                }else{
                    Toast.fire({
                        icon: 'error',
                        title: 'File Type not supported'
                    })
                }
            },
            addProduct(){
                axios.post('/api/product',this.form)
                .then(()=>{
                    Toast.fire({
                        icon: 'success',
                        title: 'New Product Added Successfully'
                    })
                    this.$router.push({name:'allProduct'});
                })
                .catch(error =>{
                    if (error.response){
                        Toast.fire({
                            icon: 'error',
                            title: 'Product not added try again'
                        })
                    }
                    if (error.response.data.errors.product_name){
                        this.error.product_name=error.response.data.errors.product_name[0];
                    }else{
                        this.error.product_name="";
                    }
                    if (error.response.data.errors.product_code){
                        this.error.product_code=error.response.data.errors.product_code[0];
                    }else{
                        this.error.product_code="";
                    }
                    if (error.response.data.errors.product_quentity){
                        this.error.product_quentity=error.response.data.errors.product_quentity[0];
                    }else{
                        this.error.product_quentity="";
                    }
                    if (error.response.data.errors.category_id){
                        this.error.category_id=error.response.data.errors.category_id[0];
                    }else{
                        this.error.category_id="";
                    }
                    if (error.response.data.errors.buying_price){
                        this.error.buying_price=error.response.data.errors.buying_price[0];
                    }else{
                        this.error.product_code="";
                    }
                    if (error.response.data.errors.selling_price){
                        this.error.selling_price=error.response.data.errors.selling_price[0];
                    }else{
                        this.error.selling_price="";
                    }
                    if (error.response.data.errors.image){
                        this.error.image=error.response.data.errors.image[0];
                    }else{
                        this.error.image="";
                    }
                })
            }
        },
        created() {
            if (! User.loggedIn()){
                this.$router.push({name:'index'});
            }
            this.getCategory();
            this.getSupplier();
        }
    }
</script>

<style scoped>

</style>
