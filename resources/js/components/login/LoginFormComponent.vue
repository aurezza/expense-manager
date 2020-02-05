<template>
    <form id="login-form" method="POST" action="login">
        <div class="form-group row">
            <span class="col-md-12" style="text-align:center;" :class="{'invalid-feedback' : error == false }" role="alert">
                <strong ref="loginTips">{{ message }}</strong>
            </span>
        </div> 
        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

            <div class="col-md-6">
                <input id="email" ref="email" type="email" v-on:keyup.enter="doLogin" class="form-control" :class="{ 'is-invalid @enderror' : error == true }" v-model="email" name="email" value="" required autocomplete="email" autofocus>
            </div>
        </div>

        <div class="form-group row">
            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

            <div class="col-md-6">
                <input id="password" ref="password" type="password" v-on:keyup.enter="doLogin" class="form-control" :class="{ 'is-invalid @enderror' : error == true }" v-model="password" name="password" required autocomplete="current-password">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-6 offset-md-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">

                    <label class="form-check-label" for="remember">
                        Remember Me
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-8 offset-md-4">
                <button @click="doLogin" type="button" class="btn btn-primary">
                    Login
                </button>
            </div>
        </div>
    </form>
</template>

<script>
    import { Request, Validate } from '../../utils/common';
    
    export default {
        data() {
            return {
                email: '',
                password: '',
                error: false,
                message: ''
            }
        },
        methods: {
            doLogin() {
                let $this = this;
                let data = {
                    email: this.email,
                    password: this.password,
                    _token: $('meta[name="csrf-token"]').attr('content')
                };

                Request('login', data, 'POST', function(response) {
                    let result = response.data;
                    if(result.error) {
                        $this.message = result.message;
                    } else {
                        window.location.href = 'dashboard';
                    }
                    $this.error = result.error;
                })
            },
        }
    }
</script>
