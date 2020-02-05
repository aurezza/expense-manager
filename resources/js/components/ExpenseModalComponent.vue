<template>
    <div class="c-modal" v-bind:class="{ hidden: isClose }">
        <div class="c-modal-wrapper">
            <div class="c-modal-content">
                <div class="c-modal-header">
                    <h5>Expense</h5>
                </div>
                <div class="c-modal-body">
                    <span class="tips"></span>
                    <form action="" method>
                        <table>
                            <tr>
                                <td>Category</td>
                                <td>
                                    <select id="category_id" v-model="record.category_id" name="category_id">
                                        <option v-for="(item, index) in $attrs.categories" v-bind:value="index">{{ item }}</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <input v-model="record.id" type="hidden" name="id">
                                <input v-model="record.user_id" type="hidden" name="user_id">
                                <td>Amount</td>
                                <td><input id="amount" v-model="record.amount" type="text" name="amount"></td>
                            </tr>
                            <tr>
                                <td>Entry Date</td>
                                <td><input id="entry_date" v-model="record.entry_date" type="date" name="entry_date"></td>
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
    import { Request, Validate, Validate2 } from '../utils/common';
    import TableComponent from './common/TableComponent';
    
    export default {
        data() {
            return {
                categories: Array
            }
        },
        props: {
            isClose: true,
            label: String,
            action: String,
            user_id: Number,
            record: {
                id: '',
                user_id: 0, 
                amount: 0,
                entry_date: ''
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
                Validate2($('.tips'), $('#category_id'), 'Category is required');
                Validate2($('.tips'), $('#amount'), 'Amount is required');
                Validate2($('.tips'), $('#entry_date'), 'Entry date is required');
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
            this.record.user_id = this.user_id;
        },
    }
</script>
