<template>
    <div class="wrapper" v-if="this.$root.$data.nope">
        <div class="popup-window">
            <div class="popup-head">{{ item.message }}<i @click="closePopup"
                                                         class="far fa-times-circle float-right"></i>
            </div>
            <div class="popup-inner">

                <div class="alert alert-danger" role="alert" v-if="this.message.length > 0">
                    {{ this.message }}
                </div>
                <h4>Your choice?</h4>
                <div class="form-group text-right">
                    <button class="btn btn-outline-info" type="button" @click="closePopup"><i class="fas fa-times"></i>
                        Cancel
                    </button>
                    <button class="btn btn-outline-success" type="button" @click="deleteItem"><i class="fas fa-trash">
                        Delete</i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            item: {id: 0, route: '', message: '', location: ''},
            message: '',
        }
    },
    mounted() {
        this.$root.$on('nopeItem', (item) => {
            this.item = item;
        });
    },
    methods: {
        closePopup() {
            this.$root.$data.nope = false;
        }, deleteItem() {
            axios.delete(this.item.route, {params: {'id': this.item.id}})
                .then((r) => {
                    this.closePopup();
                    if (this.item.location.length > 0)
                        window.location.href = this.item.location;
                });
        },
    }
}
</script>
