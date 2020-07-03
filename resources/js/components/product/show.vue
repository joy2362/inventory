<template>
<div>
    <div class="card pd-20 pd-sm-40 mg-t-50">
        <h6 class="card-body-title mb-3">Product Details</h6>
        <div class="form-layout">
            <div class="row mg-b-25 mb-5">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label class="form-control-label">Product Name: {{product.product_name}} </label>
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-control-label">Product Code: {{product.product_code}}</label>
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-control-label">Product Quantity:  {{product.product_quentity}}  </label>
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-3">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Category:  {{product.category}} </label>
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-3">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Supplier name:  {{product.supplier}} </label>
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-3">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Product stock: {{product.product_quentity}} </label>
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-control-label">Buying Price: {{product.buying_price}}
                        </label>
                    </div>
                </div><!-- col-6 -->
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-control-label">Selling Price: {{product.selling_price}} </label>
                    </div>
                </div><!-- col-6 -->

                <div class="col-lg-3">
                    <div class="form-group" v-if="product.root">
                        <label class="form-control-label">Store: {{product.root}} </label>
                    </div>
                </div><!-- col-6 -->
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-control-label">Buying Date: {{product.buying_date}} </label>
                    </div>
                </div><!-- col-6 -->

                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-control-label">Expire Date:  {{product.product_expiredate}}</label>
                    </div>
                </div>
                <div class="col-lg-4">
                    <lebel>Image </lebel>
                    <img :src="'/'+product.image" id="one"  class="mt-2">
                </div>

            </div><!-- row -->
        </div>
    </div><!-- card -->
</div>
</template>

<script>
    import User from "../../helper/User";

    export default {
        name: "show",
        created(){
            if (! User.loggedIn()){
                this.$router.push({name:'index'});
            }
            this.getResults();
        },
        data(){
            return {
                product:[],
            }
        },
        methods:{
            getResults() {
                let id=this.$route.params.id;
                axios.get('/api/product/'+id)
                    .then(response => {
                        this.product = response.data[0];

                    })
                    .catch(error => {
                        Swal.fire(
                            'Sorry!',
                            'Product not found',
                            'error'
                        )
                        this.$router.push({name:'allProduct'});
                    })
            },
        },

    }
</script>

<style scoped>

</style>
