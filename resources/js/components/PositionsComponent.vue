<template>
    <div class="wrapper" v-if="this.$root.$data.positions">
        <div class="popup-window full">
            <div class="popup-head">Update deal<i @click="closePopup"
                                                  class="far fa-times-circle float-right"></i>
            </div>
            <div class="popup-inner">

                <div class="alert alert-danger" role="alert" v-if="this.message.length > 0">
                    {{ this.message }}
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <input type="hidden" v-model="offer.id">

                        <div class="form-group mb-1 row">

                            <label class="col-md-4 text-right col-form-label" for="company">Company</label>

                            <div class="col-md-8 p-0">
                                <input type="hidden" v-model="offer.company_id">
                                <input id="company" type="text" class="form-control form-control-sm" name="company"
                                       @keyup="getCompany"
                                       v-model="offer.company_name">
                                <div class="float-right drop-new"
                                     v-if="offer.company_id === 0 && offer.company_name.length > 2">New
                                </div>
                                <div class="dropdown-select" v-if="showDropCompany">
                                    <ul v-for="company in companies">
                                        <li v-bind:data-id="company.id" @click="setCompany(company)">
                                            <div class="drop-name">{{ company.name }}</div>
                                            <div class="drop-phone">{{ company.phone }}</div>
                                            <div class="drop-email">{{ company.email }}</div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-1 row">

                            <label class="col-md-4 text-right col-form-label" for="client">Contact</label>

                            <div class="col-md-8 p-0">
                                <input type="hidden" v-model="offer.client_id">
                                <input id="client" type="text" class="form-control form-control-sm" name="client"
                                       @keyup="getContact"
                                       @focusin="hideCompany" v-model="offer.client_name">
                                <div class="float-right drop-new"
                                     v-if="offer.client_id === 0 && offer.client_name.length > 2">New
                                </div>
                                <div class="dropdown-select" v-if="showDropContact">
                                    <ul v-for="client in clients">
                                        <li v-bind:data-id="client.id" @click="setContact(client)">
                                            <div class="drop-name">{{ client.name }}</div>
                                            <div class="drop-name">{{ client.phone }}</div>
                                            <div class="drop-name">{{ client.email }}</div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-1 row">
                            <label class="col-md-4 text-right col-form-label" for="title">Title</label>
                            <input id="title" type="text" class="form-control form-control-sm col-md-8" name="title"
                                   @focusin="hideClient" v-model="offer.title">
                        </div>

                        <div class="form-group mb-1 row">
                            <label class="col-md-4 text-right col-form-label" for="delivery_address">Delivery
                                address</label>
                            <input id="delivery_address" type="text" class="form-control form-control-sm col-md-8"
                                   name="delivery_address" v-model="offer.delivery_address">
                        </div>

                        <div class="form-group mb-1 row">
                            <label class="col-md-4 text-right col-form-label" for="delivery_date">Delivery date</label>
                            <datetime id="delivery_date" v-model="offer.delivery_date" type="date"
                                      input-class="form-control form-control-sm col-md-8" value-zone="UTC+3"
                                      format="yyyy-MM-dd"></datetime>
                        </div>

                        <div class="form-group mb-1 row">
                            <label class="col-md-4 text-right col-form-label" for="number">Offer No.</label>

                            <input id="number" type="text" class="form-control form-control-sm col-md-8"
                                   v-bind:value="offer.number + ' - ' + offer.version" readonly>
                        </div>

                        <div class="form-group mb-1 row">
                            <label class="col-md-4 text-right col-form-label" for="order_number">Order No.</label>
                            <input id="order_number" type="text" class="form-control form-control-sm col-md-8"
                                   name="order_number"
                                   v-model="offer.order_number">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="description">Description</label>
                        <textarea id="description" type="text" class="form-control" name="description" rows="4"
                                  v-model="offer.description"></textarea>
                        <label for="comment" class="mt-1">Comment</label>
                        <textarea id="comment" type="text" class="form-control" name="comment" rows="4"
                                  v-model="offer.comment"></textarea>
                    </div>
                    <div class="col-md-4">
                        <label for="info">Notes / Terms (printable)</label>
                        <textarea id="info" type="text" class="form-control" name="description" rows="4"
                                  v-model="offer.info"></textarea>
                    </div>
                </div>
                <offer-items></offer-items>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        string: String
    },
    data() {
        return {
            companies: [],
            clients: [],
            states: [],
            users: [],
            offer: {
                id: 0,
                company_name: '',
                company_id: 0,
                client_id: 0,
                client_name: '',
                user_id: 0,
                state_id: 1,
                delivery_date: null
            },
            showDropCompany: false,
            showDropContact: false,
            message: '',
            positions: [],
        }
    },
    created() {
        // this.$root.$emit('editOfferItems');
    },
    mounted() {
        this.$root.$on('editPositions', (item) => {
            this.offer = item;
            this.offer.company_id = item.company !== null && (typeof item.company !== 'undefined') ? item.company.id : 0;
            this.offer.company_name = item.company !== null && (typeof item.company !== 'undefined') ? item.company.name : '';
            this.offer.client_id = item.client !== null && (typeof item.client !== 'undefined') ? item.client.id : 0;
            this.offer.client_name = item.client !== null && (typeof item.client !== 'undefined') ? item.client.name : '';

        });
        this.$root.$on('updateOfferSum', (total) => {
            this.offer.total = total.total;
            this.offer.total_with_vat = total.total_with_vat;
            this.offer.sales_profit = total.sales_profit;

        });
        this.$root.$on('saveOfferNow', (items) => {
            this.offer.positions = items;
            this.saveOffer();
        });
        this.$root.$on('updateOffer', (offer) => {
            this.offer = offer;
            this.saveOffer();
        });
        this.$root.$on('closePopupNow', () => {
            document.location.reload();
            this.closePopup();
        });
    },
    methods: {
        closePopup() {
            this.$root.$data.positions = false;
        },
        getCompany(e) {
            this.offer.company_id = 0;
            if (e.key === 'Escape') {
                this.showDropCompany = false;
                return;
            }
            axios.post('/get-companies', {name: this.offer.company_name}).then(response => {
                this.companies = response.data;
                this.showDropCompany = true;
            }).catch((error) => {
                this.$root.fetchError(error);
            });
        },
        getContact(e) {
            this.offer.client_id = 0;
            if (e.key === 'Escape') {
                this.showDropContact = false;
                return;
            }
            axios.post('/get-clients', {
                name: this.offer.client_name,
                companyId: this.offer.company_id
            }).then(response => {
                this.clients = response.data;
                this.showDropContact = true;
            }).catch((error) => {
                this.$root.fetchError(error);
            });
        },
        getPerson() {

        },
        setCompany(company) {
            this.showDropCompany = false;
            this.offer.company_name = company.name;
            this.offer.company_id = company.id;
        },
        setContact(client) {
            this.showDropContact = false;
            this.offer.client_name = client.name;
            this.offer.client_id = client.id;
        },
        hideCompany() {
            this.showDropCompany = false;
        },
        hideClient() {
            this.showDropContact = false;
        },
        saveOffer() {
            this.message = '';
            this.offer.delivery_date = this.offer.delivery_date.substr(0, 10);
            axios.post('/set-offer', this.offer).then(response => {
                if (response.data.status === 'error') {
                    this.message = response.data.message;
                    return;
                }
                this.offer = response.data.offer;
                this.$root.$data.offer.positions = response.data.offer.positions;
                this.clearPopup();
                this.$root.$emit('offerItemsSaved');
                this.$root.$emit('updateOffer', this.offer);
            }).catch((error) => {
                this.$root.fetchError(error);
            });
        },
        clearPopup() {
            this.companies = [];
            this.clients = [];
            this.states = [];
            this.users = [];
            this.offer = {company_name: '', company_id: 0, client_id: 0, client_name: '', user_id: 0, state_id: 1};
            this.showDropCompany = false;
            this.showDropContact = false;
            this.message = '';
            this.closePopup();
        }, itemDelete(item) {

        }, itemAdd() {
            // this.positions = { index: 0 };
        }
    }
}
</script>
