<template>
    <div class="wrapper" v-if="this.$root.$data.newContact">
        <div class="popup-window popup-sm brown">
            <div class="popup-head">New Contact<i @click="closePopup"
                                                  class="far fa-times-circle float-right"></i>
            </div>
            <div class="popup-inner">

                <div class="alert alert-danger" role="alert" v-if="this.message.length > 0">
                    {{ this.message }}
                </div>

                <div v-if="errors" class="alert alert-danger" role="alert">
                    <ul v-for="(v, k) in errors" :key="k">
                        <li v-for="error in v" :key="error" class="text-sm">
                            {{ error }}
                        </li>
                    </ul>
                </div>

                <div class="form-group">
                    <input type="hidden" v-model="contact.id">

                    <label for="cName">Name, Surename</label>
                    <input id="cName" type="text" class="form-control" v-model="contact.name">

                    <label class="mt-2" for="cPhone">Phone</label>
                    <input id="cPhone" type="text" class="form-control" v-model="contact.phone">

                    <label class="mt-2" for="cEmail">Email</label>
                    <input id="cEmail" type="text" class="form-control" v-model="contact.email">

                    <label class="mt-2" for="cAddress">Address</label>
                    <input id="cAddress" type="text" class="form-control" v-model="contact.address">

                    <label class="mt-2" for="cComment">Comment</label>
                    <textarea id="cComment" type="text" class="form-control" v-model="contact.comment"></textarea>
                </div>
                <div class="form-group text-right">
                    <button class="btn btn-outline-info" type="button" @click="closePopup"><i class="fas fa-times"></i>
                        Cancel
                    </button>
                    <button class="btn btn-outline-success" type="button" @click="addContact"><i class="fas fa-save">
                        Save</i>
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
            item: {id: 0, route: '', message: ''},
            contact: {id: 0, name: '', phone: '', email: '', comment: ''},
            message: '',
            errors: null,
            saved: null,
        }
    },
    mounted() {
        this.$root.$on('newContactName', (name) => {
            this.clearData();
            this.contact.name = name;
        });
    },
    methods: {
        closePopup() {
            this.$root.$data.newContact = false;
            this.$root.$emit('contactAdded', this.contact);
        }, addContact() {
            axios.post('/contact-add', this.contact)
                .then((r) => {
                    if (!(parseInt(r.data) <= 0)) {
                        console.log(r.data);
                        this.contact.id = r.data;
                        this.closePopup();
                    }
                }).catch((e) => {
                if (e.response.status === 422) {
                    this.errors = e.response.data.errors;
                } else {
                    this.$root.fetchError(e);
                }
            });
        },
        clearData() {
            this.contact = {id: 0, name: '', phone: '', email: '', comment: ''};
        }
    }
}
</script>
