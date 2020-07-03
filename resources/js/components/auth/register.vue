<template>
    <div class="register">
        <div class="d-flex align-items-center justify-content-center  ht-md-100v">
            <div class="login-wrapper wd-300 wd-xs-400 pd-25 pd-xs-40 bg-white">
                <div class="signin-logo tx-center tx-24 tx-bold tx-inverse">Sign Up</div>
                <form @submit.prevent="reg">
                <div class="form-group mg-t-30">
                    <input type="text" class="form-control" placeholder="Enter your Name" v-model="form.name">
                    <small class="text-danger" v-if="errorName">{{errorName}}</small>
                </div><!-- form-group -->
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Enter your Email" v-model="form.email">
                        <small class="text-danger" v-if="errorEmail">{{errorEmail}}</small>
                    </div><!-- form-group -->
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Enter your password" v-model="form.password">
                        <small class="text-danger" v-if="errorPass">{{errorPass}}</small>
                    </div><!-- form-group -->
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Enter password Again" v-model="form.password_confirmation">
                </div><!-- form-group -->
                <button type="submit" class="btn btn-info btn-block">Sign Up</button>
                </form>
                <div class="mg-t-40 tx-center">Already have an account? <router-link to="/" class="tx-info">Sign In</router-link></div>
            </div><!-- login-wrapper -->
        </div><!-- d-flex -->
    </div>
</template>

<script>
    import User from "../../helper/User";

    export default {
        name: "register",
        data(){
            return{
                form:{
                    email: null,
                    name: null,
                    password:null,
                    password_confirmation:null
                },
                errorEmail:'',
                errorName:'',
                errorPass:'',
            }
        },
        created() {
            if (User.loggedIn()){
                this.$router.push({name:'home'});
            }
        },
        methods:{
            reg(){
                axios.post('/api/auth/registation',this.form)
                    .then(res =>{
                        Toast.fire({
                            icon: 'success',
                            title: 'Signed up successfully'
                        })
                        User.responseafterlogin(res);
                        this.$router.push({name:'home'});
                    })
                    .catch(error => {
                        if (error.response.data.errors.email){
                            this.errorEmail=error.response.data.errors.email[0];
                        }else{
                            this.errorEmail="";
                        }
                        if(error.response.data.errors.password){
                            this.errorPass=error.response.data.errors.password[0];
                        }else{
                            this.errorPass="";
                        }
                        if(error.response.data.errors.name){
                            this.errorName=error.response.data.errors.name[0];
                        }else{
                            this.errorName="";
                        }
                    } )
            }
        }

    }
</script>

<style scoped>

</style>
