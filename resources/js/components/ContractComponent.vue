<template ref="contract">
    <div class="card">
        <div class="card-body">
            <div class="panel-info flex-row">
                <div class="d-inline-flex">
                    <h5><i class="fa fa-info-circle"></i> Contract</h5>
                </div>
                <div class="d-inline-flex">
                    <!--                <button class="btn btn-sm btn-outline-secondary" @click="contractLoad(contract)"><i-->
                    <!--                    class="far fa-edit"></i></button>-->
                    <button class="btn btn-sm btn-outline-secondary" @click="isDisabled=false">
                        <i class="fas fa-pencil-alt"></i></button>
                </div>
            </div>
            <table class="table table-sm">
                <tbody>
                <tr>
                    <th width="40%" scope="row">Signed date</th>
                    <td width="60%">{{ contract.signed_at }}</td>
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
                <tr v-if="contract.address">
                    <th>Delivery Address</th>
                    <td>{{ contract.address }}</td>
                </tr>
                <tr v-if="contract.description">
                    <th>Description</th>
                    <td>
                    <textarea :disabled="isDisabled" class="form-control-plaintext"
                              v-model="contract.installation_note"
                              rows="5">
                    </textarea>
                    </td>
                </tr>
                <tr v-if="contract.amount > 0">
                    <th scope="row">Amount</th>
                    <td>{{ contract.amount }}</td>
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
            types: [],
            isDisabled: true,
            offerId: this.offerId,
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
            axios.put('/contract', this.contract).then(r => {
                if (r.data.status === 'error') {
                    this.message = response.data.message;

                }
            }).catch((error) => {
                this.$root.fetchError(error);
            });
            this.isDisabled = true;
        }
    }
}
</script>
