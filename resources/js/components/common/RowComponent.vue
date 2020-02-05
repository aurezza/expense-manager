<template>
    <tr>
        <td v-on:click="edit(data)" v-for="(item, index) in data">
            {{ index == 'category_id' ? categories[item] : (index == 'role_id' ? roles[item] : item ) }}
        </td>
        <td><button v-if="data.role_id != 1"  v-on:click="remove(data)" type="button">Delete</button></td>
    </tr>
</template>

<script>
    export default {
        data() {
            return {
                row: Object
            }
        },
        props: {
            data: Object,
            categories: Object,
            roles: Object
        },
        components: {
            
        },
        methods: {
            edit(rowData) {
                this.$emit('edit', rowData);
            },
            remove(rowData) {
                this.$emit('remove', rowData);
            },
        },
        mounted() {

        },
    }
</script>
