<template>
    <div class="row">
        <div class="col-sm-3 "></div>
        <div class="col-sm-6">
            <form @submit.prevent="addsupplier" autocomplete="off" enctype="multipart/form-data">
                <div class="card pd-20 pd-sm-40 form-layout form-layout-5">
                    <h4 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10 float-left">Add New Supplier
                        <router-link to="/all/supplier" class="float-right btn btn-sm btn-outline-primary">All Supplier</router-link></h4>
                    <div class="row row-xs mt-3">
                        <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span> Full Name:</label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <input type="text" class="form-control" placeholder="Enter Full Name" v-model="form.name">
                            <small class="text-danger" v-if="error.name !==''">{{error.name}}</small>
                        </div>
                    </div><!-- row -->
                    <div class="row row-xs mg-t-20">
                        <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span> Email:</label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <input type="text" class="form-control" placeholder="Enter Email" v-model="form.email">
                            <small class="text-danger" v-if="error.email !==''">{{error.email}}</small>
                        </div>
                    </div>
                    <div class="row row-xs mg-t-20">
                        <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span> Phone:</label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <input type="text" class="form-control" placeholder="Enter Phone number" v-model="form.phone">
                            <small class="text-danger" v-if="error.phone !==''">{{error.phone}}</small>
                        </div>
                    </div>
                    <div class="row row-xs mg-t-20">
                        <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span> Address:</label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <textarea rows="2" class="form-control" placeholder="Enter address" v-model="form.address"></textarea>
                            <small class="text-danger" v-if="error.address !==''">{{error.address}}</small>
                        </div>
                    </div><!-- row -->
                    <div class="row row-xs mg-t-20">
                        <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span> Shop Name:</label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <input type="text" class="form-control" placeholder="Enter Position" v-model="form.shopname">
                            <small class="text-danger" v-if="error.shopname !==''">{{error.shopname}}</small>
                        </div>
                    </div>
                    <div class="row row-xs mg-t-20">
                        <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span> Profile Picture:</label>
                        <div class="custom-file col-sm-8 mg-t-10 mg-sm-t-0">
                            <input type="file" class="custom-file-input" id="customFile" @change="onfileselect">
                            <label class="custom-file-label" for="customFile">Choose Image</label>
                            <small class="text-danger" v-if="error.avatar !==''">{{error.avatar}}</small>
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
                                <button class="btn btn-info">Add</button>
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
        name: "add",
        created() {
            if (! User.loggedIn()){
                this.$router.push({name:'index'});
            }
        },
        data(){
            return {
                form:{
                    name:'',
                    email:'',
                    phone:'',
                    address:'',
                    avatar:'',
                    shopname:''
                },
                error:{
                    name:'',
                    email:'',
                    phone:'',
                    address:'',
                    avatar:'',
                    shopname:''
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
            addsupplier(){
                axios.post('/api/supplier',this.form)
                    .then(()=>{
                        Toast.fire({
                            icon: 'success',
                            title: 'New Supplier Recode Added Successfully'
                        })
                        this.$router.push({name:'allSupplier'});
                    })
                    .catch(error => {
                        if (error.response){
                            Toast.fire({
                                icon: 'error',
                                title: 'Supplier not added try again'
                            })
                        }
                        if (error.response.data.errors.email){
                            this.error.email=error.response.data.errors.email[0];
                        }else{
                            this.error.email="";
                        }
                        if (error.response.data.errors.name){
                            this.error.name=error.response.data.errors.name[0];
                        }else{
                            this.error.name="";
                        }
                        if (error.response.data.errors.phone){
                            this.error.phone=error.response.data.errors.phone[0];
                        }else{
                            this.error.phone="";
                        }
                        if (error.response.data.errors.shopname){
                            this.error.shopname=error.response.data.errors.shopname[0];
                        }else{
                            this.error.shopname="";
                        }
                        if (error.response.data.errors.address){
                            this.error.address=error.response.data.errors.address[0];
                        }else{
                            this.error.address="";
                        }
                        if (error.response.data.errors.avatar){
                            this.error.avatar=error.response.data.errors.avatar[0];
                        }else{
                            this.error.avatar="";
                        }

                    })
            },
        },
    }
</script>

<style scoped>

</style>
