<template>
    <div>
        <div class="row">
            <div class="col-sm-3 "></div>
            <div class="col-sm-6">
                <form @submit.prevent="editEmployee" enctype="multipart/form-data">
                    <div class="card pd-20 pd-sm-40 form-layout form-layout-5">
                        <h4 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10 float-left">Edit {{form.name}} information
                            <router-link to="/all/employee" class="float-right btn btn-sm btn-outline-primary">All Employee</router-link></h4>
                        <div class="row row-xs mt-3">
                            <label class="col-sm-4 form-control-label">Full Name:</label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <input type="text" class="form-control" placeholder="Enter Full Name" v-model="form.name">
                            </div>
                        </div><!-- row -->
                        <div class="row row-xs mg-t-20">
                            <label class="col-sm-4 form-control-label">Email:</label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <input type="text" class="form-control" placeholder="Enter Email" v-model="form.email">
                            </div>
                        </div>
                        <div class="row row-xs mg-t-20">
                            <label class="col-sm-4 form-control-label">Phone:</label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <input type="text" class="form-control" placeholder="Enter Phone number" v-model="form.phone">
                            </div>
                        </div>
                        <div class="row row-xs mg-t-20">
                            <label class="col-sm-4 form-control-label">Address:</label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <textarea rows="2" class="form-control" placeholder="Enter address" v-model="form.address"></textarea>
                            </div>
                        </div><!-- row -->
                        <div class="row row-xs mg-t-20">
                            <label class="col-sm-4 form-control-label">Position:</label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <input type="text" class="form-control" placeholder="Enter Position" v-model="form.position">
                            </div>
                        </div>
                        <div class="row row-xs mg-t-20">
                            <label class="col-sm-4 form-control-label">Salary:</label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <input type="text" class="form-control" placeholder="Enter Salary" v-model="form.salary">
                            </div>
                        </div>
                        <div class="row row-xs mg-t-20">
                            <label class="col-sm-4 form-control-label">Profile Picture:</label>
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
            this.getEmployee()
        },
        data(){
            return {
                form:{
                    name:'',
                    email:'',
                    phone:'',
                    salary:'',
                    position:'',
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
            getEmployee(){
                let id=this.$route.params.id;
                axios.get('/api/employee/'+id)
                .then(({data}) => {
                    this.form = data;
                    this.form.avatar='';
                })
                .catch(error => {
                    Swal.fire(
                        'Sorry!',
                        'Employee recode not found',
                        'error'
                    )
                    this.$router.push({name:'allEmployee'});
                })

            },
            editEmployee(){
                let id=this.$route.params.id;
                axios.patch('/api/employee/'+ id , this.form)
                .then(()=>{
                    Toast.fire(
                        'Success!',
                        'Employee recode update successfully',
                        'success'
                    )
                    this.$router.push({name:'allEmployee'})
                })
                .catch(error =>{
                    Toast.fire(
                        'Sorry!',
                        'Something wrong try again',
                        'error'
                    )
                })
            }
        }
    }
</script>

<style scoped>

</style>
