<template>
    <div class="navbar navbar-expand-sm navbar-dark bg-info mb-2">
        <div class="container">
            <a href="#" class="navbar-brand">To do Task Application developed by Mr Ben</a>
        </div>
    </div>
</template>
<script>
    export default {
        mounted() {
            axios.get('/http:api.test.com/api/product/check')
                .then(response => (this.data = response))
        }
    }
</script>