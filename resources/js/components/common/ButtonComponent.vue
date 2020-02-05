<template>
    <button type="button" class="custom-btn">{{ label }}</button>
</template>

<script>
    export default {
        data() {
            return {

            }
        },
        props: {
            label: String,
            action: String
        },
        components: {
            
        },
        methods: {
            // getListView(callback) {
            //     axios.get(this.moduleId+'/getlist', { 
            //                 params: {
                                
            //                 }
            //             })
            //             .then(function (response) {
            //                 let result = response.data;
            //                if(typeof callback === "function") {
            //                     callback(result.data);
            //                 }
            //             })
            //             .catch(function (error) {
            //                 console.log(error);
            //             });
            //     // Request(this.moduleId+'/getlist', {}, 'GET', function(response) {
            //     //     let result = response.data;
            //     //     // console.log(result.data);
 
            //     //     if(result.error) {
            //     //         result.message;
            //     //         return [];
            //     //     } else {
            //     //         if(typeof callback === "function") {
            //     //             callback(result.data);
            //     //         }
            //     //     }
            //     // })
            //     console.log('getListView');
            // }
        },
        mounted() {

        },
    }
</script>
