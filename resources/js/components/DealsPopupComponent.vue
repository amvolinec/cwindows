<template>
    <div class="wrapper" v-if="this.$root.$data.popup">
        <div class="popup-window popup-sm">
            <div class="popup-head">Create new deal<i @click="closePopup"
                                                      class="far fa-times-circle float-right"></i>
            </div>
            <div class="popup-inner">

                <div class="alert alert-danger" role="alert" v-if="this.message.length > 0">
                    {{ this.message }}
                </div>
<!--                <input type="hidden" v-model="offer.id">-->

                <div class="form-group row">
                    <label class="col-md-4 text-right col-form-label" for="planed_date">Inquiry date</label>
                    <div class="col-md-8 p-0">
                        <datetime id="inquiry_date" v-model="offer.inquiry_date" type="datetime"
                                  input-class="form-control" format="yyyy-MM-dd HH:mm:ss"></datetime>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-4 text-right col-form-label" for="planed_date">Inquiry ID</label>
                    <div class="col-md-8 p-0">
                        <input class="form-control" v-model="offer.id" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-4 text-right col-form-label" for="received_id">Request received</label>
                    <select id="received_id" type="text" class="form-control col-md-8" name="received_id"
                            v-model="offer.received_id">
                        <option value="1">www</option>
                        <option value="2">email</option>
                        <option value="3">other</option>
                    </select>
                </div>

                <div class="form-group row">
                    <label class="col-md-4 text-right col-form-label" for="private">Private/Company</label>
                    <select id="private" type="text" class="form-control col-md-8" name="private"
                            v-model="offer.private">
                        <option value="1">Private</option>
                        <option value="0">Company</option>
                    </select>
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

                    <label class="col-md-4 text-right col-form-label" for="client">Contact</label>

                    <div class="col-md-8 p-0">
                        <input type="hidden" v-model="offer.client_id">
                        <input id="client" type="text" class="form-control" name="client" @keyup="getContact"
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

                <div class="form-group row">
                    <label class="col-md-4 text-right col-form-label" for="title">Inquiry Name</label>
                    <input id="title" type="text" class="form-control col-md-8" name="title" @focusin="hideClient"
                           v-model="offer.title">
                </div>

                <div class="form-group row">
                    <label class="col-md-4 text-right col-form-label" for="delivery_address">Delivery Address</label>
                    <input id="delivery_address" type="text" class="form-control col-md-8" name="delivery_address" @focusin="hideClient"
                           v-model="offer.delivery_address">
                </div>

                <div class="form-group row">
                    <label class="col-md-4 text-right col-form-label" for="description">Description</label>
                    <textarea id="description" type="text" class="form-control col-md-8" name="description" rows="3"
                              v-model="offer.description"></textarea>
                </div>

                <div class="form-group row">
                    <label class="col-md-4 text-right col-form-label" for="type_id">Inquiry type</label>
                    <select id="type_id" type="text" class="form-control col-md-8" name="type_id"
                            v-model="offer.type_id">
                        <option value="1">Private</option>
                        <option value="2">Apartments</option>
                        <option value="3">Commercial</option>
                    </select>
                </div>

                <div class="form-group row">
                    <label class="col-md-4 text-right col-form-label" for="profile_id">Inquiry type</label>
                    <select id="profile_id" type="text" class="form-control col-md-8" name="profile_id"
                            v-model="offer.profile_id">
                        <option value="1">Wood</option>
                        <option value="2">Wood + Al</option>
                        <option value="3">Aluminium</option>
                    </select>
                </div>

                <div class="form-group row">
                    <label class="col-md-4 text-right col-form-label" for="state_id">Status</label>
                    <select id="state_id" type="text" class="form-control col-md-8" name="state_id"
                            v-model="offer.state_id">
                        <option v-for="state in states" v-bind:value="state.id">{{ state.name }}</option>
                    </select>
                </div>

                <div class="form-group row">
                    <label class="col-md-4 text-right col-form-label" for="planed_date">Planned date of sale</label>
                    <datetime id="planed_date" v-model="offer.planed_date" type="date"
                              input-class="form-control col-md-8"></datetime>
                </div>

                <div class="form-group row">
                    <label class="col-md-4 text-right col-form-label" for="project_amount">Planned amount</label>
                    <input id="project_amount" type="text" class="form-control col-md-8" name="project_amount"
                           v-model="offer.project_amount">
                </div>

                <div class="form-group row">
                    <label class="col-md-4 text-right col-form-label" for="planned_amount_percents">Probability
                        %</label>
                    <input id="planned_amount_percents" type="text" class="form-control col-md-8"
                           name="planned_amount_percents"
                           v-model="offer.planned_amount_percents">
                </div>

                <div class="form-group row">
                    <label class="col-md-4 text-right col-form-label" for="comment">Description</label>
                    <textarea id="comment" type="text" class="form-control col-md-8" name="comment" rows="3"
                              v-model="offer.comment"></textarea>
                </div>

                <div class="form-group row">
                    <label class="col-md-4 text-right col-form-label" for="user_id">Created by</label>

                    <select id="user_id" type="text" class="form-control col-md-8" name="user_id"
                            v-model="offer.user_id">
                        <option v-for="user in users" v-bind:value="user.id">{{ user.name }}</option>
                    </select>
                    <div class="col-md-4"></div>
                    <div class="col-md-6"><span>{{ offer.created_at }}</span></div>
                </div>

                <div class="form-group row">
                    <label class="col-md-4 text-right col-form-label" for="manager_id">Project Manager</label>

                    <select id="manager_id" type="text" class="form-control col-md-8" name="manager_id"
                            v-model="offer.manager_id">
                        <option v-for="manager in managers" v-bind:value="manager.id">{{ manager.name }}</option>
                    </select>
                </div>

                <div class="form-group row">
                    <label class="col-md-4 text-right col-form-label" for="partner">Partner ID</label>
                    <input id="partner" type="text" class="form-control col-md-8"
                           name="partner"
                           v-model="offer.partner">
                </div>

                <div class="form-group text-right">
                    <button class="btn btn-outline-secondary" type="button" @click="closePopup"><i
                        class="fas fa-times"></i>
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
            clients: [],
            states: [],
            users: [],
            managers: [],
            offer: {
                inquiry_date: this.dateNow(),
                id: 0,
                company_name: '',
                company_id: 0,
                client_id: 0,
                client_name: '',
                user_id: 0,
                manager_id: 0,
                state_id: 1,
                received_id: 1,
                private: 1,
                delivery_address: '',
                description: '',
                type_id: 1,
                profile_id: 1,
                comment: '',
            },
            showDropCompany: false,
            showDropContact: false,
            message: '',
        }
    },
    created() {
        this.fetchStates();

        $(document).ready(function () {

            $('#clients').select2({
                minimumInputLength: 3,
                ajax: {
                    url: '/clients',
                    dataType: 'json',
                },
            });
        });

    },
    mounted() {
        this.$root.$on('editOffer', (item) => {
            this.fetchStates();
            this.offer = item;
            this.offer.company_id = item.company !== null && (typeof item.company.id !== undefined) ? item.company.id : 0;
            this.offer.company_name = item.company !== null && (typeof item.company.name !== undefined) ? item.company.name : '';
            this.offer.client_id = item.client !== null && (typeof item.client.id !== undefined) ? item.client.id : 0;
            this.offer.client_name = item.client !== null && (typeof item.client.name !== undefined) ? item.client.name : '';
        });
        this.$root.$on('newOffer', () => {
            this.createOffer();
        });
    },
    methods: {
        fetchStates() {
            axios.get('/states').then(response => {
                this.states = response.data.states;
                this.users = response.data.users;
                this.managers = response.data.managers;
                this.offer.user_id = response.data.user_id;
            }).catch((error) => {
                this.$root.fetchError(error);
            });
        },
        createOffer() {
            axios.get('/create-offer').then(response => {
                this.offer.id = response.data.offer.id;
                this.offer.user_id = response.data.offer.user_id;
                this.offer.created_at = response.data.offer.created_at;
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
            this.clients = [];
            this.states = [];
            this.users = [];
            this.offer = {company_name: '', company_id: 0, client_id: 0, client_name: '', user_id: 0, state_id: 1};
            this.showDropCompany = false;
            this.showDropContact = false;
            this.message = '';
            this.closePopup();
        },
        dateNow() {
            return new Date().toISOString();
        }
    }
}
</script>
