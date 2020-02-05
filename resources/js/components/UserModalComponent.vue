<template>
    <div class="c-modal" v-bind:class="{ hidden: isClose }">
        <div class="c-modal-wrapper">
            <div class="c-modal-content">
                <div class="c-modal-header">
                    <h5>User</h5>
                </div>
                <div class="c-modal-body">
                    <span class="tips"></span>
                    <form action="" method>
                        <table>
                            <tr>
                                <input v-model="record.id" type="hidden" name="id">
                                <td>Name</td>
                                <td><input id="name" v-model="record.name" type="text" name="name"></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td><input id="email" v-model="record.email" type="text" name="email"></td>
                            </tr>
                            <tr>
                                <td>Role</td>
                                <td>
                                    <select id="role_id" v-model="record.role_id" name="role_id">
                                        <option v-for="(item, index) in $attrs.roles" v-bind:value="index">{{ item }}</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Password</td>
                                <td><input id="password" v-model="record.password" type="password" name="password"></td>
                            </tr>
                            <tr>
                                <td>Confirm Password</td>
                                <td><input id="password_confirm" v-model="record.password_confirm" type="password" name="password_confirm"></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align:center">
                                    <button v-on:click="toggle" type="button">Cancel</button>
                                    <button v-on:click="save" type="button">Save</button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { Request, Validate, Validate2, checkEmail } from '../utils/common';
    import TableComponent from './common/TableComponent';
    
    export default {
        data() {
            return {
                roles: {}
            }
        },
        props: {
            isClose: true,
            label: String,
            action: String,
            record: {
                id: '',
                email: '',
                role_id: ''
            }
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
                console.log('RECORD', this.record);
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
                let $email = ('#email');
                let $tips = $('.tips');
                Validate2($tips, $('#name'), 'Name is required');
                Validate2($tips, $('#email'), 'Email is required');
                checkEmail($email, $tips);
                Validate2($tips, $('#role_id'), 'Role is required');

                if(this.record.id == '' || this.record.id == 0) {
                    Validate2($tips, $('#password'), 'Password is required');
                    Validate2($tips, $('#password_confirm'), 'Password confirm is required');

                    
                    if($password.val() != $password_confirm.val()) {
                        $tips.html('Password fo not match!');
                        $password.addClass('input-error');
                        $password_confirm.addClass('input-error');
                    } else {
                        $tips.html('');
                        $password.removeClass('input-error');
                        $password_confirm.removeClass('input-error');
                    }
                }
            },
            clear() {
                for(var i in this.record) {
                    this.record[i] = '';
                }
            },
        },
        mounted() {

        },
    }
</script>
