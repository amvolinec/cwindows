<template ref="offer">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <offer-state v-bind:states="states" v-bind:state="item.state_id">
            </offer-state>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header" v-bind:class="{ editing: !isDisabled }">
                    <div class="d-inline-block" style="vertical-align: top; padding: 6px;">
                        <h4>{{ typeof item.title !== 'undefined' ? item.title : '' }}</h4>
                    </div>
                </div>

                <div class="card-body">
                    <div class="panel-info">
                        <div class="d-inline-flex">
                            <h5><i class="fa fa-info-circle"></i> Information</h5>
                        </div>
                        <div class="d-inline-flex">
                            <button class="btn btn-sm btn-outline-secondary" @click="itemLoad(item)"><i
                                class="far fa-edit"></i></button>
                            <button class="btn btn-sm btn-outline-secondary" @click="isDisabled=false">
                                <i class="fas fa-pencil-alt"></i></button>
                        </div>
                    </div>
                    <table class="table table-sm">
                        <tbody>
                        <tr>
                            <th width="40%" scope="row">Inquiry date</th>
                            <td width="60%">{{ item.inquiry_date }}</td>
                        </tr>
                        <tr>
                            <th>ID#</th>
                            <td>{{ item.id }}</td>
                        </tr>
                        <tr>
                            <th>Version#</th>
                            <td>{{ item.version }}</td>
                        </tr>
                        <tr>
                            <th>Request received</th>
                            <td>
                                <select :disabled="isDisabled" class="form-control-plaintext"
                                        v-model="item.received_id">
                                    <option value="1">www</option>
                                    <option value="2">email</option>
                                    <option value="3">other</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Private/Company</th>
                            <td>
                                <select :disabled="isDisabled" class="form-control-plaintext" v-model="item.private">
                                    <option value="1">Private</option>
                                    <option value="0">Company</option>
                                </select>
                            </td>
                        </tr>
                        <tr v-if="(typeof item.company !== 'undefined') && (item.company !== null)">
                            <th scope="row">Company</th>
                            <td>
                                {{
                                    (typeof item.company === 'undefined') || (item.company === null) ? '' : item.company.name
                                }}
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Contact</th>
                            <td>
                                {{
                                    (typeof item.client === 'undefined') || (item.client === null) ? '' : item.client.name
                                }}
                            </td>
                        </tr>
                        <tr v-if="item.title">
                            <th>Inquiry Name</th>
                            <td>{{ item.title }}</td>
                        </tr>
                        <tr v-if="item.delivery_date">
                            <th scope="row">Delivery Date</th>
                            <td>{{ item.delivery_date }}</td>
                        </tr>
                        <tr v-if="item.delivery_address">
                            <th>Delivery Address</th>
                            <td>{{ item.delivery_address }}</td>
                        </tr>
                        <tr v-if="item.description">
                            <th>Description</th>
                            <td>
                                <textarea :disabled="isDisabled" class="form-control-plaintext"
                                          v-model="item.description"
                                          rows="5">
                                </textarea>
                            </td>
                        </tr>
                        <tr>
                            <th>Uploaded files</th>
                            <td>
                                <div v-for="file in item.files">
                                    <a v-bind:href="'/' + file.file_uri" target="_blank">
                                        {{ file.file_name }}</a>
                                    <i class="fas fa-trash" style="cursor: pointer;"
                                       @click="nopeFile(file)"></i>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>Inquiry type</th>
                            <td>
                                <select :disabled="isDisabled" class="form-control-plaintext" v-model="item.type_id">
                                    <option value="1">Private</option>
                                    <option value="2">Apartments</option>
                                    <option value="3">Commercial</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Inquiry profile</th>
                            <td>
                                <select :disabled="isDisabled" class="form-control-plaintext" v-model="item.profile_id">
                                    <option value="1">Wood</option>
                                    <option value="2">Wood + Al</option>
                                    <option value="3">Aluminium</option>
                                </select>
                            </td>
                        </tr>
                        <tr v-if="item.project_amount > 0">
                            <th scope="row">Planned amount</th>
                            <td>{{ item.project_amount }}</td>
                        </tr>
                        <tr v-if="item.chance > 0">
                            <th>Probability %</th>
                            <td>{{ item.chance }}</td>
                        </tr>
                        <tr v-if="item.comment">
                            <th>Comment</th>
                            <td>
                                <textarea :disabled="isDisabled" class="form-control-plaintext" v-model="item.comment"
                                          rows="3">
                                </textarea>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">Responsible person</th>
                            <td>
                                <div>{{ typeof item.user_id === 'undefined' ? '' : item.user.name }}</div>
                                <small class="">{{ item.created_at }}</small>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Project Manager</th>
                            <td>
                                <div>{{
                                        typeof item.manager_id === 'undefined' || item.manager_id === null ? '' : item.manager.name
                                    }}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Architect</th>
                            <td>
                                <div>{{
                                        typeof item.architect_id === 'undefined' || item.architect_id === null ? '' : item.architect.title
                                    }}
                                </div>
                            </td>
                        </tr>
                        <tr v-if="item.partner">
                            <th>Partner ID</th>
                            <td>{{ item.partner }}</td>
                        </tr>
                        <tr v-if="item.number">
                            <th scope="row">Offer No.</th>
                            <td>{{ item.number }}</td>
                        </tr>
                        <tr v-if="item.order_number">
                            <th scope="row">Order No.</th>
                            <td>{{ item.order_number }}</td>
                        </tr>
                        <tr v-if="item.state_id >= 5">
                            <th scope="row">Balance</th>
                            <td>{{ item.balance }}</td>
                        </tr>
                        </tbody>
                    </table>
                    <button class="btn btn-sm btn-success" @click="itemSave(item)" v-if="!isDisabled">
                        <i class="fas fa-save"></i></button>
                </div>
            </div>

            <div class="card mt-2">
                <div class="card-body">
                    <div class="panel-info">
                        <div class="d-inline-flex">
                            <h5><i class="fa fa-building"></i> Product list</h5>
                        </div>
                        <div class="d-inline-flex">
                            <button class="btn btn-sm btn-outline-secondary" @click="positionsLoad(item)"><i
                                class="far fa-edit"></i></button>
                        </div>
                    </div>

                    <ul class="i-list mb-2" v-for="position in positions">
                        <li>
                            <div class="i-title">{{ position.title }}</div>
                            <div class="i-line">
                                <div class="float-left">
                                    {{ position.quantity }} x {{ position.price }} €
                                </div>
                                <div class="float-right">
                                    {{ $root.format(position.subtotal) }}
                                </div>
                            </div>
                        </li>
                    </ul>

                    <div class="text-right small">Total amount: {{ this.$root.format(item.total) }}</div>
                    <div class="text-right small">VAT: {{ this.$root.format((item.total_with_vat - item.total)) }}</div>
                    <div class="text-right"><strong>TOTAL: {{ this.$root.format(item.total_with_vat) }}</strong></div>
                    <div class="text-right small">Margin with expenses: {{ this.$root.format(item.sales_profit) }}
                        ({{ this.$root.percents(item.total > 0 ? item.sales_profit / item.total * 100 : 0) }})
                    </div>
                </div>
            </div>

            <div class="card mt-2" v-if="item.state_id >= 5">
                <div class="card-body">
                    <div class="panel-info">
                        <div class="d-inline-flex">
                            <h5><i class="fas fa-money-bill-wave-alt"></i> Payments</h5>
                            <div class="d-inline-flex">
                                <button class="btn btn-sm btn-outline-secondary" @click="newTransaction(item.id)">
                                    <i class="fas fa-plus"></i></button>
                            </div>
                        </div>

                    </div>

                    <ul class="i-list mb-2" v-for="transaction in item.transactions">
                        <li>
                            <div class="i-line">
                                <div class="float-left">
                                    {{ transaction.date }} {{ transaction.number }}
                                </div>
                                <div class="float-right">
                                    {{ $root.format(transaction.amount) }}
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="text-right"><strong>Balance: {{ this.$root.format(item.balance) }}</strong></div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="panel-info">
                        <div class="d-inline-flex">
                            <h5><i class="far fa-file"></i> Offers (Tenders)</h5>
                            <div class="d-inline-flex">
                                <button v-if="item.state_id < 5" class="btn btn-sm btn-outline-secondary" @click="newTender(item.id)">
                                    <i class="fas fa-plus"></i></button>
                            </div>
                        </div>

                    </div>

                    <ul class="i-list mb-2" v-for="tender in tenders">
                        <li>
                            <div class="t-i-line">
                                <div class="row">
                                    <div class="col-md-6">
                                        <span class="float-left">{{ tender.created_at }} v{{ tender.version }}</span>
                                    </div>
                                    <div class="col-md-6">
                                        <span class="float-right">
                                            {{ $root.format(tender.total_with_vat) }}
                                            <button  v-if="item.state_id < 5" class="btn btn-sm btn-outline-secondary"
                                                     @click="setTender(tender.id)"><i class="fas fa-check"></i></button>
                                            <a v-for="file in tender.files" class="btn btn-sm btn-outline-secondary"
                                               v-bind:href="'/' + file.file_uri" target="_blank">PDF</a>
                                        </span>
                                    </div>
                                </div>
                                <div class="tender-item-line" v-for="pos in tender.positions">
                                    <div class="row small">
                                        <div class="col-md-4">{{ pos.title }}</div>
                                        <div class="col-md-4">{{ pos.quantity }} x {{ pos.final_price }}</div>
                                        <div class="col-md-4"><span class="float-right">{{ pos.total }}</span></div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>

                    <div class="row" v-if="item.state_id < 5">
                        <div class="col-md-12">
                            <button class="btn btn-outline-success" @click="createContract">Create Contract</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <deals-popup ref="popup"></deals-popup>
        <positions-popup string="item"></positions-popup>
        <nope-popup ref="nope"></nope-popup>
        <new-transaction></new-transaction>
    </div>
</template>

<script>
export default {
    props: {
        id: String
    },
    data() {
        return {
            item: [],
            positions: [],
            states: [],
            types: [],
            isDisabled: true,
            tenders: [],
        }
    },
    mounted() {
        this.$root.$on('updateOffer', (offer) => {
            // this.positions = offer.positions;
            this.fetchItems();
        });
        this.$root.$on('transactionAdded', (transaction) => {
            this.fetchItems();
        });
        this.$root.$on('stateChanged', (state) => {
            // this.positions = offer.positions;
            this.item.state_id = state;
            this.itemSave();
        });
    },
    created() {
        this.fetchItems();
    },
    methods: {
        fetchItems() {
            let url = '/offer/get/' + this.id;
            axios.get(url).then(r => {
                this.item = r.data.offer;
                this.states = r.data.states;
                this.types = r.data.types;
                this.positions = typeof r.data.offer.positions !== 'undefined' ? r.data.offer.positions : [];
                this.tenders = typeof r.data.tenders !== 'undefined' ? r.data.tenders : [];
            }).catch((error) => {
                this.$root.fetchError(error);
            });
        },
        editDeal() {
            this.$root.$data.popup = true;
        },
        itemLoad(item) {
            this.$root.$emit('editOffer', item);
            this.$root.$data.popup = true;
        },
        positionsLoad(item) {
            this.$root.$emit('editPositions', item);
            this.$root.$data.offer = item;
            this.$root.$data.positions = true;
        },
        itemDelete(item) {
            let data = {id: item.id, route: 'offers', message: 'Delete ' + item.title + ' ?'};
            this.$root.$emit('nopeItem', data);
            this.$root.$data.nope = true;
            this.fetchItems();
        },
        itemShow(id) {
            document.location.href = '/offer/' + id;
        }, itemSave() {
            this.message = '';
            axios.post('/update-offer', this.item).then(response => {
                if (response.data.status === 'error') {
                    this.message = response.data.message;
                    return;
                }
            }).catch((error) => {
                this.$root.fetchError(error);
            });
            this.isDisabled = true;
        }, nopeFile(item) {
            let data = {
                id: item.id,
                route: '/files',
                message: 'Delete ' + item.file_name + ' ?',
                location: window.location.href
            };
            this.$root.$emit('nopeItem', data);
            this.$root.$data.nope = true;
            this.fetchItems();
        }, newTransaction(id) {
            this.$root.$emit('createNewTransaction', id);
            this.$root.$data.newTransaction = true;
        }, newTender(id) {
            axios.get('/tender/' + id + '/make', this.item).then(response => {
                if (response.data.status === 'error') {
                    this.message = response.data.message;
                }
                this.fetchItems();
            }).catch((error) => {
                this.$root.fetchError(error);
            });
        }, setTender(id) {
            axios.get('/tender/' + id + '/set', this.item).then(response => {
                if (response.data.status === 'error') {
                    this.message = response.data.message;
                }
                this.fetchItems();
            }).catch((error) => {
                this.$root.fetchError(error);
            });
        }, createContract() {
            this.item.state_id = 5;
            this.itemSave();
        }, printTender(tenderId){
            window.location.href
        }
    }
}
</script>
