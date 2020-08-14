<template>
    <div class="wrapper" v-if="this.$root.$data.popup">
        <div class="popup-window">
            <div class="popup-head">Create new deal<i @click="closePopup"
                                                      class="far fa-times-circle float-right"></i>
            </div>
            <div class="popup-inner">

                <div class="alert alert-danger" role="alert" v-if="this.message.length > 0">
                    {{ this.message }}
                </div>

                <div class="form-group row">

                    <label class="col-md-4 text-right col-form-label" for="company">Company</label>

                    <div class="col-md-8 p-0">
                        <input type="hidden" v-model="offer.company_id">
                        <input id="company" type="text" class="form-control" name="company" @keyup="getCompany"
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

                <div class="form-group row">

                    <label class="col-md-4 text-right col-form-label" for="contact">Contact</label>

                    <div class="col-md-8 p-0">
                        <input type="hidden" v-model="offer.contact_id">
                        <input id="contact" type="text" class="form-control" name="contact" @keyup="getContact"
                               @focusin="hideCompany" v-model="offer.contact_name">
                        <div class="float-right drop-new"
                             v-if="offer.contact_id === 0 && offer.contact_name.length > 2">New
                        </div>
                        <div class="dropdown-select" v-if="showDropContact">
                            <ul v-for="contact in contacts">
                                <li v-bind:data-id="contact.id" @click="setContact(contact)">
                                    <div class="drop-name">{{ contact.name }}</div>
                                    <div class="drop-name">{{ contact.phone }}</div>
                                    <div class="drop-name">{{ contact.email }}</div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-4 text-right col-form-label" for="title">Title</label>
                    <input id="title" type="text" class="form-control col-md-8" name="title" @focusin="hideClient"  v-model="offer.title">
                </div>

                <div class="form-group row">
                    <label class="col-md-4 text-right col-form-label" for="pipeline">Sales Pipeline</label>
                    <input id="pipeline" type="text" class="form-control col-md-8" name="pipeline"
                           v-model="offer.pipeline">
                </div>

                <div class="form-group row">
                    <label class="col-md-4 text-right col-form-label" for="state_id">Stage</label>
                    <select id="state_id" type="text" class="form-control col-md-8" name="state_id"
                            v-model="offer.state_id">
                        <option v-for="state in states" v-bind:value="state.id">{{ state.name }}</option>
                    </select>
                </div>

                <div class="form-group row">
                    <label class="col-md-4 text-right col-form-label" for="planed">Planned date of sale</label>
                    <input id="planed" type="text" class="form-control col-md-8" name="planed" v-model="offer.planed">
                </div>

                <div class="form-group row">
                    <label class="col-md-4 text-right col-form-label" for="amount">Planned amount</label>
                    <input id="amount" type="text" class="form-control col-md-8" name="amount" v-model="offer.amount">
                </div>

                <div class="form-group row">
                    <label class="col-md-4 text-right col-form-label" for="probability">Probability %</label>
                    <input id="probability" type="text" class="form-control col-md-8" name="probability"
                           v-model="offer.probability">
                </div>

                <div class="form-group row">
                    <label class="col-md-4 text-right col-form-label" for="comment">Comment</label>
                    <input id="comment" type="text" class="form-control col-md-8" name="comment"
                           v-model="offer.comment">
                </div>

                <div class="form-group row">
                    <label class="col-md-4 text-right col-form-label" for="person_id">Person</label>

                    <select id="person_id" type="text" class="form-control col-md-8" name="person_id"
                            v-model="offer.person_id">
                        <option v-for="person in persons" v-bind:value="person.id">{{ person.name }}</option>
                    </select>
                </div>

                <div class="form-group text-right">
                    <button class="btn btn-outline-info" type="button" @click="closePopup"><i class="fas fa-times"></i>
                        Cancel
                    </button>
                    <button class="btn btn-outline-success" type="button" @click="saveOffer"><i class="fas fa-save">
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
            companies: [],
            contacts: [],
            states: [],
            persons: [],
            offer: {company_name: '', company_id: 0, contact_id: 0, contact_name: '', person_id: 0, state_id: 1},
            showDropCompany: false,
            showDropContact: false,
            message: '',
        }
    },
    created() {
        this.fetchStates();
    },
    methods: {
        fetchStates() {
            axios.get('/states').then(response => {
                this.states = response.data.states;
                this.persons = response.data.persons;
                this.offer.person_id = response.data.person_id;
            }).catch((error) => {
                this.$root.fetchError(error);
            });
        },
        closePopup() {
            this.$root.$data.popup = false;
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
            this.offer.contact_id = 0;
            if (e.key === 'Escape') {
                this.showDropContact = false;
                return;
            }
            axios.post('/get-contacts', {
                name: this.offer.contact_name,
                companyId: this.offer.company_id
            }).then(response => {
                this.contacts = response.data;
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
        setContact(contact) {
            this.showDropContact = false;
            this.offer.contact_name = contact.name;
            this.offer.contact_id = contact.id;
        },
        hideCompany() {
            this.showDropCompany = false;
        },
        hideClient() {
            this.showDropContact = false;
        },
        saveOffer() {
            this.message = '';
            axios.post('/set-offer', this.offer).then(response => {
                if (response.data.status === 'error') {
                    this.message = response.data.message;
                    return;
                }
                this.clearPopup();
                this.$root.$emit('offerAdded');
            }).catch((error) => {
                this.$root.fetchError(error);
            });
        },
        clearPopup() {
            this.companies = [];
            this.contacts = [];
            this.states = [];
            this.persons = [];
            this.offer = {company_name: '', company_id: 0, contact_id: 0, contact_name: '', person_id: 0, state_id: 1};
            this.showDropCompany = false;
            this.showDropContact = false;
            this.message = '';
            this.closePopup();
        }
    }
}
</script>
