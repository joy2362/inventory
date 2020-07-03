<template>
<div>
    <div class="card pd-20 pd-sm-40">
        <h6 class="card-body-title">New Category
            <router-link to="/all/category" class="float-right btn btn-sm btn-warning">All Category</router-link>
        </h6>
        <div class="modal-header pd-x-20">
            <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Add Category</h6>
        </div>
        <form @submit.prevent="addCategory" >
            <div class="modal-body pd-20">
                <div class="form-group">
                    <label for="name">Category Name</label>
                    <input type="text" class="form-control " id="name" v-model="form.name">
                    <small class="text-danger" v-if="errorName">{{errorName}}</small>
                </div>
            </div><!-- modal-body -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-info pd-x-20">Save</button>
            </div>
        </form>
    </div><!-- card -->
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
                  name:''
              },
              errorName:'',
          }
        },
        methods:{
            addCategory(){
                axios.post('/api/category',this.form)
                    .then(()=>{
                        Toast.fire({
                            icon: 'success',
                            title: 'New Category Recode Added Successfully'
                        })
                        this.$router.push({name:'allCategory'});
                    })
                    .catch(error => {
                        if (error.response){
                            Toast.fire({
                                icon: 'error',
                                title: 'Category not added try again'
                            })
                        }
                        if (error.response.data.errors.name){
                            this.errorName=error.response.data.errors.name[0];
                        }else{
                            this.errorName="";
                        }
                    })
            }
        },
    }
</script>

<style scoped>

</style>
