<template>
    <div id="login">
        <div class="d-flex align-items-center justify-content-center  ht-100v">
            <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white">
                <div class="signin-logo tx-center tx-24 tx-bold tx-inverse">Login</div>
                <form @submit.prevent="login">
                    <div class="form-group  mg-t-30">
                        <input type="email" class="form-control" placeholder="Enter your email" v-model="form.email">
                        <small class="text-danger" v-if="errorEmail !==''">{{errorEmail}}</small>
                    </div><!-- form-group -->
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Enter your password" v-model="form.password">
                        <small class="text-danger" v-if="errorPass !==''">{{errorPass}}</small>
                        <router-link to="/forget" class="tx-info tx-12 d-block mg-t-10">Forgot password?</router-link>
                        <div class="mg-t-20 tx-center">New User? <router-link to="/register" class="tx-info">Sign Up</router-link></div>
                    </div><!-- form-group -->
                    <button type="submit" class="btn btn-info btn-block">Sign In</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import User from "../../helper/User";

    export default {
        name: "login",
        data(){
            return{
                form:{
                    email:'',
                    password:''
                },
                errorEmail:'',
                errorPass:'',

            }
        },
        created() {
            if (User.loggedIn()){
                this.$router.push({name:'home'});
            }
        },
        methods:{
            login(){
                axios.post('/api/auth/login',this.form)
                .then(res =>{
                    Toast.fire({
                        icon: 'success',
                        title: 'Signed in successfully'
                    })
                    User.responseafterlogin(res);
                    this.$router.push({name:'home'});
                })
                .catch(error => {
                    if (error.response){
                        Toast.fire({
                            icon: 'error',
                            title: 'Invailed Email or Password'
                        })
                    }
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
                } )

            }
        }
    }
</script>

<style scoped>

</style>
