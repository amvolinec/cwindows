<template>
    <div class="container">
        <div class="alert alert-danger mt-3" v-if="this.$root.$data.error">
            <button type="button" class="close" data-dismiss="alert" @click="closeAlert"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
            <div v-text="this.$root.$data.errorMessage"></div>
        </div>
    </div>
</template>

<script>
export default {
    methods: {
        closeAlert() {
            this.$root.$data.error = false;
            this.$root.$data.errorMessage = '';
        }
    }
}
</script>
