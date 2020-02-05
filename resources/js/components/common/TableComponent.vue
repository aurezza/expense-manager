<template>
    <table class="custom-table">
        <thead>
            <tr>
                <th v-bind:key="colHeader" v-for="colHeader in colHeaders">{{ colHeader }}</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <RowComponent 
                @edit="edit"
                @remove="remove"
                :categories="categories"
                :roles="roles"
                :data="row"
                v-bind:rowId="row.id" 
                v-bind:key="row.id" 
                v-for="row in records"
            ></RowComponent>
            <!-- <tr v-on:click="edit(this)" v-bind:data="row" v-bind:key="row.id" v-for="row in records">
                <td v-for="item in row">{{ item }}</td>
            </tr> -->
        </tbody>
    </table>
</template>

<script>
    import RowComponent from './RowComponent';

    export default {
        data() {
            return {
                records: []
            }
        },
        props: {
          colHeaders: Array,
          moduleId: String,
          categories: Array,
          roles: Object
        },
        watch: {
            records: function (newValue, oldValue) {
                console.log(newValue);
                this.records = newValue;
            }
        },
        components: {
            RowComponent
        },
        methods: {
            edit(rowData) {
                this.$emit('edit', rowData);
            },
            remove(rowData) {
                this.$emit('remove', rowData);
            },
            refreshList(route = '') {
                let $this = this;
                this.getListView(function(resultData) {
                    $this.records = resultData;
                }, route);
            },
            getListView(callback, route = '') {
                axios.get((route == '' ? this.moduleId : route) +'/getlist', { 
                    params: {
                        
                    }
                })
                .then(function (response) {
                    let result = response.data;
                    if(typeof callback === "function") {
                        callback(result.data);
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
            }
        },
        mounted() {
            let $this = this;
            console.log('Component mounted.')
            this.refreshList();
        },
    }
</script>
