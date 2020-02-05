<template>
    <div class="c-modal" v-bind:class="{ hidden: dialogClosed }">
        <div class="c-modal-wrapper">
            <div class="c-dialog-content">
                <div class="c-modal-header">
                    <!-- <h5>Role</h5> -->
                </div>
                <div class="c-modal-body">
                    <p>{{ dialogMessage }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {

            }
        },
        props: {
            dialogMessage: String,
            dialogClosed: Boolean
        },
        watch: {
            dialogClosed: function (newValue, oldValue) {
                this.dialogClosed = newValue;
            },
            message: function (newValue, oldValue) {
                this.dialogMessage = newValue;
            }
        },
        components: {
            
        },
        methods: {

        },
        mounted() {

        },
    }
</script>