<template ref="contract">
    <div class="card mt-3" v-if="contract !== null">
        <div class="card-body">
            <div class="panel-info flex-row">
                <div class="d-inline-flex">
                    <h5><i class="fa fa-info-circle"></i> Contract</h5>
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
                        <datetime id="inquiry_date" v-model="contract.signed_at" type="date"
                                  :disabled="isDisabled"
                                  v-bind:input-class="[ isDisabled ? passiveClass : activeClass ]"
                                  format="yyyy-MM-dd" value-zone="UTC+3"></datetime>
                    </td>
                </tr>
                <tr v-if="contract.planed_at || !isDisabled">
                    <th>Planed date</th>
                    <td>{{ contract.planed_at }}</td>
                </tr>

                <tr v-if="contract.finished_at || !isDisabled">
                    <th>Finished  date</th>
                    <td>{{ contract.finished_at }}</td>
                </tr>

                <tr v-if="contract.warranted_at || !isDisabled">
                    <th>Warranted  date</th>
                    <td>{{ contract.warranted_at }}</td>
                </tr>

                <tr v-if="contract.amount || !isDisabled">
                    <th>Amount</th>
                    <td>
                        <input :disabled="isDisabled" type="number" step="0.01" v-bind:class="[ isDisabled ? passiveClass : activeClass ]"
                               v-model="contract.amount">
                    </td>
                </tr>

                <tr v-if="contract.payments || !isDisabled">
                    <th>Payments</th>
                    <td>{{ contract.payments }}</td>
                </tr>

                <tr v-if="contract.expenses || !isDisabled">
                    <th>Expenses</th>
                    <td>{{ contract.expenses }}</td>
                </tr>

                <tr v-if="contract.margin || !isDisabled">
                    <th>Margin</th>
                    <td>
                    <input :disabled="isDisabled" type="number" step="0.01" v-bind:class="[ isDisabled ? passiveClass : activeClass ]"
                              v-model="contract.margin">
                    </td>
                </tr>

                <tr v-if="contract.production_start || !isDisabled">
                    <th>Start production</th>
                    <td>{{ contract.production_start }}</td>
                </tr>

                <tr v-if="contract.production_end || !isDisabled">
                    <th>End production</th>
                    <td>{{ contract.production_end }}</td>
                </tr>

                <tr v-if="contract.installation_start || !isDisabled">
                    <th>Start installation</th>
                    <td>{{ contract.installation_start }}</td>
                </tr>

                <tr v-if="contract.installation_end || !isDisabled">
                    <th>End installation</th>
                    <td>{{ contract.installation_end }}</td>
                </tr>
                <tr>
                    <th scope="row">Period</th>
                    <td>
                        <v-select :disabled="isDisabled"  label="name" :options="periods" v-model="period"
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
                        <input :disabled="isDisabled" type="text" v-bind:class="[ isDisabled ? passiveClass : activeClass ]"
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
            activeClass: 'form-control-sm'
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
        }
    }
}
</script>
