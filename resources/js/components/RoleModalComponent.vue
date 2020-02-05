<template>
    <div class="c-modal" v-bind:class="{ hidden: isClose }">
        <div class="c-modal-wrapper">
            <div class="c-modal-content">
                <div class="c-modal-header">
                    <h5>{{ moduleTitle }}</h5>
                </div>
                <div class="c-modal-body">
                    <span class="tips"></span>
                    <form action="" method>
                        <table>
                            <tr>
                                <input v-model="record.id" type="hidden" name="id">
                                <td>Display Name</td>
                                <td><input id="name" v-model="record.name" type="text" name="name"></td>
                            </tr>
                            <tr>
                                <td>Description</td>
                                <td><input id="description" v-model="record.description" type="text" name="description"></td>
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
                
            }
        },
        props: {
            isClose: true,
            label: String,
            action: String,
            moduleTitle: String,
            // save: { type: Function },
            record: {
                id: '',
                name: '',
                description: ''
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
                this.clear();
                this.$emit('toggle');
            },
            save() {
                this.validate();
                this.$emit('save', this.record);
            },
            validate() {
                Validate2($('.tips'), $('#name'), 'Name is required');
                Validate2($('.tips'), $('#description'), 'Description is required');
            },
            clear() {
                this.record.id = '';
                this.record.name = '';
                this.record.description = '';
            },
        },
        mounted() {

        },
    }
</script>
