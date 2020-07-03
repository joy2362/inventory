<template>
<div>
    <div class="card pd-20 pd-sm-40">
        <h6 class="card-body-title">Category
            <router-link to="/all/category" class="float-right btn btn-sm btn-warning">All Category</router-link>
        </h6>
        <div class="modal-header pd-x-20">
            <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Update Category</h6>
        </div>
        <form @submit.prevent="updateCategory" >
            <div class="modal-body pd-20">
                <div class="form-group">
                    <label for="name">Category Name</label>
                    <input type="text" class="form-control " id="name" v-model="form.name">
                    <small class="text-danger" v-if="errorName">{{errorName}}</small>
                </div>
            </div><!-- modal-body -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-info pd-x-20">Update</button>
            </div>
        </form>
    </div><!-- card -->
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
            this.getCategory()
        },
        data(){
            return{
                form:{
                    name:''
                },
                errorName:'',
            }
        },
        methods: {
            getCategory() {
                let id = this.$route.params.id;
                axios.get('/api/category/' + id)
                    .then(({data}) => {
                        this.form = data;
                    })
                    .catch(error => {
                        Swal.fire(
                            'Sorry!',
                            'Category not found',
                            'error'
                        )
                        this.$router.push({name: 'allCategory'});
                    })
            },
            updateCategory() {
                let id = this.$route.params.id;
                axios.patch('/api/category/' + id, this.form)
                    .then(() => {
                        Toast.fire(
                            'Success!',
                            'Category  update successfully',
                            'success'
                        )
                        this.$router.push({name: 'allCategory'})
                    })
                    .catch(error => {
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
