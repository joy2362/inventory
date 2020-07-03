<template>
    <div class="row">
        <div class="col-sm-3 "></div>
        <div class="col-sm-6">
            <form @submit.prevent="updatesupplier" autocomplete="off" enctype="multipart/form-data">
                <div class="card pd-20 pd-sm-40 form-layout form-layout-5">
                    <h4 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10 float-left">Update Supplier information
                        <router-link to="/all/supplier" class="float-right btn btn-sm btn-outline-primary">All Supplier</router-link></h4>
                    <div class="row row-xs mt-3">
                        <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span> Full Name:</label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <input type="text" class="form-control" placeholder="Enter Full Name" v-model="form.name">
                        </div>
                    </div><!-- row -->
                    <div class="row row-xs mg-t-20">
                        <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span> Email:</label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <input type="text" class="form-control" placeholder="Enter Email" v-model="form.email">
                        </div>
                    </div>
                    <div class="row row-xs mg-t-20">
                        <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span> Phone:</label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <input type="text" class="form-control" placeholder="Enter Phone number" v-model="form.phone">
                        </div>
                    </div>
                    <div class="row row-xs mg-t-20">
                        <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span> Address:</label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <textarea rows="2" class="form-control" placeholder="Enter address" v-model="form.address"></textarea>
                        </div>
                    </div><!-- row -->
                    <div class="row row-xs mg-t-20">
                        <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span> Shop Name:</label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <input type="text" class="form-control" placeholder="Enter Position" v-model="form.shopname">
                        </div>
                    </div>
                    <div class="row row-xs mg-t-20">
                        <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span> Profile Picture:</label>
                        <div class="custom-file col-sm-8 mg-t-10 mg-sm-t-0">
                            <input type="file" class="custom-file-input" id="customFile" @change="onfileselect">
                            <label class="custom-file-label" for="customFile">Choose Image</label>
                        </div>
                    </div><!-- col -->
                    <div class="row row-xs mg-t-20 text-center m-3" v-if="form.avatar">
                        <div class=" col-sm-8 mg-t-10 mg-sm-t-0">
                            <img :src="form.avatar" style="height:100px; width:100px;">
                        </div>
                    </div><!-- col -->
                    <div class="row row-xs mg-t-40 ">
                        <div class="col-sm-12 ">
                            <div class="form-layout-footer float-right">
                                <button class="btn btn-info">Update</button>
                            </div><!-- form-layout-footer -->
                        </div><!-- col-8 -->
                    </div>
                </div><!-- card -->
            </form>
        </div>
        <div class="col-sm-3 "></div>
    </div>
</template>

<script>
    import User from "../../helper/User";

    export default {
        name: "edit",
        created() {
            if (! User.loggedIn()){
                this.$router.push({name:'index'});
            }
            this.getSupplier()
        },
        data(){
            return {
                form:{
                    name:'',
                    email:'',
                    phone:'',
                    shopname:'',
                    address:'',
                    avatar:'',
                },
            }
        },
        methods:{
            onfileselect(event){
                let file=event.target.files[0];
                if(file.type === "image/png" || file.type === "image/jpg" || file.type === "image/JPG" ||file.type === "image/jpeg" ){
                    if(file.size >104800){
                        Toast.fire({
                            icon: 'error',
                            title: 'File Size must be less then 1mb'
                        })
                    }else{
                        let reader = new FileReader();
                        reader.onload= event =>{
                            this.form.avatar = event.target.result;
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
            getSupplier(){
                let id=this.$route.params.id;
                axios.get('/api/supplier/'+id)
                .then(({data}) => {
                    this.form = data;
                    this.form.avatar='';
                })
                .catch(error => {
                    Toast.fire(
                        'Sorry!',
                        'Supplier recode not found',
                        'error'
                    )
                    this.$router.push({name:'addSupplier'});
                })
            },
            updatesupplier(){
                let id=this.$route.params.id;
                axios.patch('/api/supplier/'+ id , this.form)
                    .then(()=>{
                        Toast.fire(
                            'Success!',
                            'Supplier recode update successfully',
                            'success'
                        )
                        this.$router.push({name:'allSupplier'})
                    })
                    .catch(error =>{
                        Toast.fire(
                            'Sorry!',
                            'Something wrong try again',
                            'error'
                        )
                    })
            }
        },

    }
</script>

<style scoped>

</style>
