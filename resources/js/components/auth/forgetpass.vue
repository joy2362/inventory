<template>
    <div id="forgetpass">
        <div class="d-flex align-items-center justify-content-center  ht-100v">
            <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white">
                <div class="signin-logo tx-center tx-24 tx-bold tx-inverse">Forget Password</div>
                <form>
                <div class="form-group  mg-t-30">
                    <input type="text" class="form-control" placeholder="Enter your Email">
                </div><!-- form-group -->
                <button type="submit" class="btn btn-info btn-block">Forget password</button>
                    <div class="mg-t-20 tx-center"><router-link to="/" class="tx-info">Back to login</router-link></div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "forgetpass"
    }
</script>

<style scoped>

</style>
