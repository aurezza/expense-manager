<template>
    <div class="cutstom-box">
        <div class="b-header">
            <h4>{{ moduleTitle }}</h4>
        </div>
        <div class="v-content">
            <table-component
                v-if="moduleId != 'dashboard' && moduleId != 'account'"
                @edit="edit"
                @remove="remove"
                ref="listView"
                :colHeaders="colHeaders"
                :roles="roles"
                :categories="categories"
                :moduleId="moduleId"
            ></table-component>
            <div class="button-wrapper">
                <button v-if="moduleId != 'dashboard' && moduleId != 'account'" @click="toggle">Add</button>
            </div>
        </div>
       <role-modal-component v-if="moduleId == 'role' || moduleId == 'expensecategory'"
            ref="addModal"
            :moduleTitle="moduleTitle"
            @toggle="toggle"
            :record="record"
            :isClose="isClose"
            @save="save"
        ></role-modal-component>

        <user-modal-component v-if="moduleId == 'user'"
            ref="addModal"
            @toggle="toggle"
            :record="record"
            :roles="roles"
            :categories="categories"
            :isClose="isClose"
            @save="save"
        ></user-modal-component>
        
        <expense-modal-component v-if="moduleId == 'expense'"
            ref="addModal"
            @toggle="toggle"
            :record="record"
            :roles="roles"
            :categories="categories"
            :user_id="user_id"
            :isClose="isClose"
            @save="save"
        ></expense-modal-component>

        <dialog-component
            ref="dialog"
            :dialogClosed="dialogClosed"
            :dialogMessage="dialogMessage"
        ></dialog-component>
        
        <account-form-component v-if="moduleId == 'account'"
            @toggle="toggle"
            :record="$attrs.record"
            :isClose="isClose"
            @save="save"
        ></account-form-component>

        <div v-if="moduleId == 'dashboard'" class="chart-wrapper">
            <table>
                <thead>
                    <tr>
                        <th width="70%">Expense Categories</th>
                        <th width="30%">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-bind:style="{color: item.color}" v-for="item in chartData.all">
                        <td v-show="index != 'color'" v-for="(value, index) in item">
                            {{ index != 'color' ? 
                                (index == 'expenses_count' ? '$'+(value == null ? 0 : value) : value ) :
                            '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
        <v-chart
            :chartData="chartData"
        /></v-chart>
        </div>
    </div>
</template>

<script>
    import { Request, Validate } from '../utils/common';
    import TableComponent from './common/TableComponent';
    import ButtonComponent from './common/ButtonComponent';
    import RoleModalComponent from './RoleModalComponent';
    import UserModalComponent from './UserModalComponent';
    import ExpenseModalComponent from './ExpenseModalComponent';
    import ChartComponent from './common/ChartComponent';
    import AccountFormComponent from './AccountFormComponent';
    import DialogComponent from "./common/DialogComponent";

    export default {
        mounted() {

        },
        data() {
            return {
                message: '',
                isClose: true,
                records: [],
                record: {},
                dialogMessage: '',
                dialogClosed: true
            };
        },
        methods: {
            validate() {

            },
            save(record) {
                let $this = this;
                let url = this.moduleId;
                
                if(record.id == '' || typeof record.id == 'undefined') {
                    url += '/add';
                } else {
                    if(this.moduleId == 'account') {
                        url = 'user/update/'+record.id;
                    } else {
                        url += '/update/'+record.id;
                    }
                }

                axios.post(url, record)
                .then(function (response) {
                    let result = response.data;
                    console.log(result);
 
                    if(result.error) {
                        result.message;
                        $this.dialogMessage = result.message;;
                        $this.dialogClosed = false;
                        setTimeout(() => {
                            $this.dialogClosed = true;
                        }, 1500);
                    } else {
                        $this.dialogMessage = "Save!";
                        $this.dialogClosed = false;
                        setTimeout(() => {
                            $this.dialogClosed = true;
                        }, 1500);
                    }

                    $this.toggle();
                    $this.$refs.addModal.clear();
                    $this.$refs.listView.refreshList();
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            edit(record) {
                record = JSON.parse(JSON.stringify(record));
                this.record = record;
                if((this.moduleId == 'role' && record.id != 1) || this.moduleId != 'role') {
                    this.toggle();
                }
            },
            update(record) {
                let $this = this;
                axios.post(this.moduleId+'/update/'+record.id, record)
                .then(function (response) {
                    let result = response.data;
                    console.log(result);
 
                    if(result.error) {
                        result.message;
                        $this.dialogMessage = result.message;;
                        $this.dialogClosed = false;
                        setTimeout(() => {
                            $this.dialogClosed = true;
                        }, 1500);
                    } else {
                        $this.dialogMessage = "Save!";
                        $this.dialogClosed = false;
                        setTimeout(() => {
                            $this.dialogClosed = true;
                        }, 1500);
                    }

                    $this.toggle();
                    $this.$refs.addModal.clear();
                    $this.$refs.listView.refreshList();
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            remove(record) {
                let $this = this;
                axios.post(this.moduleId+'/delete/'+record.id, record)
                .then(function (response) {
                    let result = response.data;
                    console.log(result);
 
                    $this.dialogMessage = result.message;
                    $this.dialogClosed = false;
                    setTimeout(() => {
                        $this.dialogClosed = true;
                    }, 1500);
                    $this.$refs.listView.refreshList();
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            toggle() {
                this.$refs.addModal.clear();
                this.isClose = !this.isClose;
            },
            refreshList() {

            }
        },
        props: {
          moduleTitle: String,
          colHeaders: Array,
          moduleId: String,
          roles: Object,
          categories: Array,
          user_id: Number,
          chartData: Object
        },
        components: {
            TableComponent,
            ButtonComponent,
            RoleModalComponent,
            UserModalComponent,
            ExpenseModalComponent, 
            AccountFormComponent,
            DialogComponent
        },
    }
</script>
