<template>
    <div class="form-wrapper">
        <span class="tips"></span>
        <form action="" method>
            <table>
                <tr>
                    <td>Name</td>
                    <td><input id="name" v-model="record.name" type="text" name="name"></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input id="email" v-model="record.email" type="text" name="email"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input id="password" v-model="record.password" type="password" name="password"></td>
                </tr>
                <tr>
                    <td>Confirm Password</td>
                    <td><input id="password_confirm" v-model="record.password" type="password" name="password_confirm"></td>
                </tr>
                <tr>
                    <td style="text-align:center">
                        <button v-on:click="toggle" type="button">Cancel</button>
                        <button v-on:click="save" type="button">Save</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</template>

<script>
    import { Request, Validate, Validate2 } from '../utils/common';
    
    export default {
        data() {
            return {
                categories: {}
            }
        },
        props: {
            isClose: true,
            label: String,
            action: String,
            user_id: Number,
            record: Object
        },
        components: {

        },
        watch: {
            record: function (newValue, oldValue) {
                this.record = newValue;
            }
        },
        methods: {
            toggle() {
                this.clear();
                this.$emit('toggle');
            },
            save() {
                this.validate();
                this.$emit('save', this.record);
            },
            validate() {
                let $password = $('#password');
                let $password_confirm = $('#password_confirm');
                let $tips = $('.tips');

                Validate2($tips, $('#name'), 'Name is required');
                Validate2($tips, $('#email'), 'email is required');
                Validate2($tips, $password, 'Password is required');
                Validate2($tips, $password_confirm, 'Password confirm is required');

                if($password.val() != $password_confirm.val()) {
                    $tips.html('Password fo not match!');
                    $password.addClass('input-error');
                    $password_confirm.addClass('input-error');
                } else {
                    $tips.html('');
                    $password.removeClass('input-error');
                    $password_confirm.removeClass('input-error');
                }
            },
            clear() {
                for(var i in this.record) {
                    if(i != 'user_id' || i != 'role_id') {
                        this.record[i] = '';   
                    }
                }
            },
        },
        mounted() {

        },
    }
</script>
