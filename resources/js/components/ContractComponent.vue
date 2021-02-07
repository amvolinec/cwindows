<template ref="contract">
    <div class="card mt-3" v-if="contract !== null">
        <div class="card-body">
            <div class="panel-info flex-row">
                <div class="d-inline-flex">
                    <h5><i class="fa fa-info-circle"></i> Contract</h5>
                    <div class="d-inline-flex">
                        <button class="btn btn-sm btn-outline-secondary" @click="print(contract.offer_id, 'Eng')"> ENG
                        </button>
                        <button class="btn btn-sm btn-outline-secondary" @click="print(contract.offer_id, 'Lt')"> LT
                        </button>
                    </div>
                </div>
                <div class="d-inline-flex">
                    <button class="btn btn-sm btn-outline-secondary" @click="isDisabled=false">
                        <i class="fas fa-pencil-alt"></i></button>
                </div>
            </div>
            <table class="table table-sm">
                <tbody>
                <tr v-if="contract.signed_at || !isDisabled">
                    <th width="40%" scope="row">Signed date</th>
                    <td width="60%">
                        <datetime id="signed_at" v-model="contract.signed_at" type="date"
                                  :disabled="isDisabled"
                                  v-bind:input-class="[ isDisabled ? passiveClass : activeClass ]"
                                  format="yyyy-MM-dd" value-zone="UTC+3"></datetime>
                    </td>
                </tr>
                <tr v-if="contract.planed_at || !isDisabled">
                    <th>Planed date</th>
                    <td>
                        <datetime id="planed_at" v-model="contract.planed_at" type="date"
                                  :disabled="isDisabled"
                                  v-bind:input-class="[ isDisabled ? passiveClass : activeClass ]"
                                  format="yyyy-MM-dd" value-zone="UTC+3"></datetime>
                    </td>
                </tr>

                <tr v-if="contract.finished_at || !isDisabled">
                    <th>Finished date</th>
                    <td>
                        <datetime id="finished_at" v-model="contract.finished_at" type="date"
                                  :disabled="isDisabled"
                                  v-bind:input-class="[ isDisabled ? passiveClass : activeClass ]"
                                  format="yyyy-MM-dd" value-zone="UTC+3"></datetime>
                    </td>
                </tr>

                <tr v-if="contract.warranted_at || !isDisabled">
                    <th>Warranted date</th>
                    <td>
                        <datetime id="warranted_at" v-model="contract.warranted_at" type="date"
                                  :disabled="isDisabled"
                                  v-bind:input-class="[ isDisabled ? passiveClass : activeClass ]"
                                  format="yyyy-MM-dd" value-zone="UTC+3"></datetime>
                    </td>
                </tr>

                <tr v-if="contract.offer">
                    <th>Total Amount</th>
                    <td>
                        <input :disabled="true" v-model="contract.offer.total_with_vat" v-bind:class="passiveClass">
                    </td>
                </tr>

                <tr>
                    <th>Payments</th>
                    <td>
                        <input :disabled="true" v-model="payments" v-bind:class="passiveClass">
                    </td>
                </tr>

                <tr>
                    <th>Expenses</th>
                    <td>
                        <input :disabled="true" v-model="costs" v-bind:class="passiveClass">
                    </td>
                </tr>

                <tr v-if="contract.offer">
                    <th>Margin (Sales Profit)</th>
                    <td>
                        <input :disabled="true" v-model="contract.offer.sales_profit" v-bind:class="passiveClass">
                    </td>
                </tr>

                <tr v-if="contract.production_start || !isDisabled">
                    <th>Start production</th>
                    <td>
                        <datetime id="production_start" v-model="contract.production_start" type="date"
                                  :disabled="isDisabled"
                                  v-bind:input-class="[ isDisabled ? passiveClass : activeClass ]"
                                  format="yyyy-MM-dd" value-zone="UTC+3"></datetime>
                    </td>
                </tr>

                <tr v-if="contract.production_end || !isDisabled">
                    <th>End production</th>
                    <td>
                        <datetime id="production_end" v-model="contract.production_end" type="date"
                                  :disabled="isDisabled"
                                  v-bind:input-class="[ isDisabled ? passiveClass : activeClass ]"
                                  format="yyyy-MM-dd" value-zone="UTC+3"></datetime>
                    </td>
                </tr>

                <tr v-if="contract.installation_start || !isDisabled">
                    <th>Start installation</th>
                    <td>
                        <datetime id="installation_start" v-model="contract.installation_start" type="date"
                                  :disabled="isDisabled"
                                  v-bind:input-class="[ isDisabled ? passiveClass : activeClass ]"
                                  format="yyyy-MM-dd" value-zone="UTC+3"></datetime>
                    </td>
                </tr>

                <tr v-if="contract.installation_end || !isDisabled">
                    <th>End installation</th>
                    <td>{{ contract.installation_end }}
                        <datetime id="installation_end" v-model="contract.installation_end" type="date"
                                  :disabled="isDisabled"
                                  v-bind:input-class="[ isDisabled ? passiveClass : activeClass ]"
                                  format="yyyy-MM-dd" value-zone="UTC+3"></datetime>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Period</th>
                    <td>
                        <v-select :disabled="isDisabled" label="name" :options="periods" v-model="period"
                                  @input="periodSelected"></v-select>
                    </td>
                </tr>
                <tr v-if="(typeof contract.company !== 'undefined') && (contract.company !== null)">
                    <th scope="row">Company</th>
                    <td>
                        {{
                            (typeof contract.company === 'undefined') || (contract.company === null) ? '' : contract.company.name
                        }}
                    </td>
                </tr>
                <tr>
                    <th scope="row">Contact</th>
                    <td>
                        {{
                            (typeof contract.client === 'undefined') || (contract.client === null) ? '' : contract.client.name
                        }}
                    </td>
                </tr>
                <tr v-if="contract.address || !isDisabled">
                    <th>Delivery Address</th>
                    <td>
                        <input :disabled="isDisabled" type="text"
                               v-bind:class="[ isDisabled ? passiveClass : activeClass ]"
                               v-model="contract.address">
                    </td>
                </tr>
                <tr v-if="contract.installation_note || !isDisabled">
                    <th>Note installation</th>
                    <td>
                    <textarea :disabled="isDisabled" v-bind:class="[ isDisabled ? passiveClass : activeClass ]"
                              v-model="contract.installation_note"
                              v-bind:rows="isDisabled ? 1 : 3" v-bind:cols="isDisabled ? 10 : 20">
                    </textarea>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Project Manager</th>
                    <td>
                        <div>{{
                                typeof contract.manager_id === 'undefined' || contract.manager_id === null ? '' : contract.manager.name
                            }}
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
            <button class="btn btn-sm btn-success" @click="contractSave(contract)" v-if="!isDisabled">
                <i class="fas fa-save"></i></button>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        offerId: Number
    },
    data: function () {
        return {
            contract: [],
            periods: [],
            period: {},
            types: [],
            isDisabled: true,
            // offerId: this.offerId,
            passiveClass: 'form-control-plaintext',
            activeClass: 'form-control-sm',
            payments: 0,
            costs: 0,
        }
    },
    mounted() {
        this.$root.$on('getContract', (offerId) => {
            // this.positions = offer.positions;
            this.fetchContracts(offerId);
        });
    },
    created() {
        // this.fetchContracts();
    },
    methods: {
        fetchContracts(offerId) {
            let url = '/contract/get/' + offerId;
            axios.get(url).then(r => {
                this.contract = r.data.contract;
                this.periods = r.data.periods;
                this.period = this.contract.period;
                this.payments = r.data.payments;
                this.costs = r.data.costs;
            }).catch((error) => {
                this.$root.fetchError(error);
            });
        },
        editContract() {
            this.$root.$data.popup = true;
        },
        contractDelete(contract) {
            // let data = {id: contract.id, route: 'offers', message: 'Delete ' + contract.title + ' ?'};
            // this.$root.$emit('nopecontract', data);
            // this.$root.$data.nope = true;
            // this.fetchcontracts();
        },
        contractShow(id) {
            document.location.href = '/contract/' + id;
        }, contractSave() {
            this.message = '';
            axios.put('/contract/' + this.contract.id, this.contract).then(r => {
                if (r.data.status === 'error') {
                    this.message = r.data.message;
                }
            }).catch((error) => {
                this.$root.fetchError(error);
            });
            this.isDisabled = true;
        }, periodSelected() {
            this.contract.period_id = this.period.id;
        }, print(id, lang) {
            window.open('/offer/contract/' + id + '/' + lang, "blank", "width=900,height=640");
        }

    }
}
</script>
