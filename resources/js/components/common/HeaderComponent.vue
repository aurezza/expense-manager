<template>
<div class="header">
    <a class="disabled-link" v-if="isLoggedIn == '1'" href="#">Welcome to Exprense Manager</a>
    <a v-if="isLoggedIn == '1'" v-bind:href="dasboardUrl ">Dashboard</a>
    <a v-else v-bind:href="loginUrl">Login</a>
    <a v-if="isLoggedIn == '1'" v-on:click="submitForm($event)">Logout</a>
    <a v-if="hasRegisterRoute == '1'" v-bind:href="registerUrl">Register</a>
    <form id="logout-form" v-bind:action="logoutUrl" method="POST" style="display: none;">
        <input type="hidden" name="_token" :value="csrf">
    </form>
</div>
</template>

<script>
    import { Request, Validate } from '../../utils/common';
    
    export default {
        data() {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        },
        methods: {
            submitForm(event) {
                event.preventDefault(); 
                document.getElementById('logout-form').submit();
            }
        },
        props: {
            dasboardUrl: String,
            loginUrl: String,
            logoutUrl: String,
            registerUrl: String,
            hasRegisterRoute: String,
            isLoggedIn: String
        },
    }
</script>
