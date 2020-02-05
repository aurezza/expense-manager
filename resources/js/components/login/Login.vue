<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"></div>
                <div class="card-body">
                    <login-form-component></login-form-component>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import LoginFormComponent from './LoginFormComponent'
    export default {
        mounted() {
            console.log('Login component mounted.')
        },
        components: {
            LoginFormComponent
        },
    }
</script>
