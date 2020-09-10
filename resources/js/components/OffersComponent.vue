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
                            <th>Planned date of sale</th>
                            <td>{{ item.planed_date }}</td>
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
                                {{ typeof item.client === 'undefined' ? '' : item.client.name }}
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
                                <a v-for="file in item.files" v-bind:href="'/' + file.file_uri" target="_blank">
                                    {{ file.file_name }}</a>
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
<!--                        <tr>-->
<!--                            <th>Status</th>-->
<!--                            <td>-->
<!--                                <select :disabled="isDisabled" class="form-control-plaintext" v-model="item.state_id">-->
<!--                                    <option v-for="state in states" v-bind:value="state.id">{{ state.name }}</option>-->
<!--                                </select>-->
<!--                            </td>-->
<!--                        </tr>-->
                        <tr v-if="item.planed_date">
                            <th>Planned date of sale</th>
                            <td>{{ item.planed_date }}</td>
                        </tr>
                        <tr v-if="item.project_amount > 0">
                            <th scope="row">Planned amount</th>
                            <td>{{ item.project_amount }}</td>
                        </tr>
                        <tr v-if="item.planned_amount_percents > 0">
                            <th>Probability %</th>
                            <td>{{ item.planned_amount_percents }}</td>
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
        </div>
        <div class="col-md-6"></div>
        <deals-popup ref="popup"></deals-popup>
        <positions-popup string="item"></positions-popup>
        <nope-popup ref="nope"></nope-popup>
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
            isDisabled: true,
        }
    },
    mounted() {
        this.$root.$on('updateOffer', (offer) => {
            // this.positions = offer.positions;
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
            axios.get(url).then(response => {
                this.item = response.data.offer;
                this.states = response.data.states;
                this.positions = typeof response.data.positions !== 'undefined' ? response.data.positions : [];
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
        }
    }
}
</script>
