<template>
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-sm table-condensed">
                <thead class="thead">
                <tr>
                    <th width="30">Name</th>
                    <th width="100">Code</th>
                    <th width="250">Phone</th>
                    <th width="70">Address</th>
                    <th width="70">Email</th>
                    <th width="70">City</th>
                    <th width="80">Comment</th>
                    <th width="40"></th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="contact in contacts">
                    <th scope="row" class="contact-sm text-right">
                        <div>{{ contact.index }}</div>
                    </th>
                    <td><textarea class="form-control contact-sm" type="text" v-model="contact.title"></textarea></td>
                    <td><input class="form-control contact-sm text-right" type="text" v-model="contact.name"></td>
                    <td><input class="form-control contact-sm text-right" type="text" v-model="contact.code"></td>
                    <td><input class="form-control contact-sm text-right" type="text" v-model="contact.phone"></td>
                    <td><input class="form-control contact-sm text-right" type="text" v-model="contact.address"></td>
                    <td><input class="form-control contact-sm text-right" type="text" v-model="contact.email"></td>
                    <td><input class="form-control contact-sm text-right" type="text" v-model="contact.city"></td>
                    <td><input class="form-control contact-sm text-right" type="text" v-model="contact.comment"></td>
                    <td>
                        <button class="btn btn-sm btn-outline-info" @click="removecontact(contact)"><i
                            class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="form-group mb-1 row">
            <div class="col-md-6">
                <div class="form-group mb-1 text-left">
                    <button class="btn btn-sm btn-outline-success" @click="addRow"><i class="fas fa-cart-plus"></i> Add
                        row
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
            contacts: [],
            deleted: [],
            trash: [],
            index: 0,
        }
    },
    mounted() {
        this.$root.$on('offercontactsSaved', () => {
            this.contacts = this.$root.$data.offer.positions;
            if(typeof this.contacts === 'undefined') {
                console.log('OffercontactsComponents: contacts Not Defined!');
            } else {
                this.onLoad();
            }
        });
    },
    created() {
        this.contacts = this.$root.$data.offer.positions;
        if (this.isEmpty(this.contacts)) {
            this.addRow();
        }
        this.onLoad();
    },
    methods: {
        saveContacts() {
            this.message = '';
            axios.post('/set-contact', this.contacts).then(response => {
                if (response.data.status === 'error') {
                    this.message = response.data.message;
                    return;
                }
                this.clearPopup();
                this.$root.$emit('offerEdited');
            }).catch((error) => {
                this.$root.fetchError(error);
            });
        }, contactAdd() {
            this.index++;
            return {
                id: null,
                index: this.index,
                name: '',
                code: '',
                phone: '',
                address: '',
                email: '',
                city: '',
                comment: '',
            }
        }, isEmpty(fineArray) {
            return !(typeof fineArray != "undefined"
                && fineArray != null
                && fineArray.length != null
                && fineArray.length > 0);
        }, removecontact(contact) {
            if (contact.id !== null) {
                this.deleted.push(contact.id);
            }
            const index = this.contacts.indexOf(contact);
            if (index > -1) {
                this.contacts.splice(index, 1);
            }
            this.onLoad();

        }, addRow() {
            this.contacts.push(this.contactAdd());

        }, saveOffer() {

            this.nopeDeleted();
            this.$root.$emit('saveOfferNow', this.contacts);

        }, closePopup() {

            this.$root.$emit('closePopupNow');

        }, onLoad() {

            this.contacts.forEach((contact, index) => {
                contact.index = index + 1;
                this.index++;
                this.calcSum(contact);
            });

        }, nopeDeleted() {

            this.deleted.forEach((contact, index) => {
                axios.delete('/contact/', {params: {'ids': this.deleted}}).then((r) => {
                    console.log(r);
                }).catch((error) => {
                    this.$root.fetchError(error);
                });
            });

        }
    }
}
</script>
