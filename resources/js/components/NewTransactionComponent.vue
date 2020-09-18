<template>
    <div class="wrapper" v-if="this.$root.$data.newTransaction">
        <div class="popup-window popup-sm brown">
            <div class="popup-head">New Payment<i @click="closePopup"
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
                    <input type="hidden" v-model="transaction.id">

                    <label for="tDate">Date</label>
                    <datetime id="tDate" v-model="transaction.date" type="date"
                              input-class="form-control form-control-sm" value-zone="UTC+3"
                              format="yyyy-MM-dd"></datetime>

                    <label class="mt-2" for="tNumber">Amount</label>
                    <input id="tNumber" type="number" step=".01" min="0.01" class="form-control form-control-sm"
                           v-model="transaction.amount">

                    <label class="mt-2" for="tAmount">Number</label>
                    <input id="tAmount" type="text" class="form-control form-control-sm" v-model="transaction.number">

                    <label class="mt-2">State</label>
                    <v-select label="name" :options="states" v-model="state" @input="changeState"></v-select>

                    <label class="mt-2">Type</label>
                    <v-select label="name" :options="types" v-model="type" @input="changeType"></v-select>

                    <label class="mt-2" for="cComment">Info</label>
                    <textarea id="cComment" type="text" class="form-control form-control-sm"
                              v-model="transaction.info"></textarea>
                </div>
                <div class="form-group text-right">
                    <button class="btn btn-outline-info" type="button" @click="closePopup"><i class="fas fa-times"></i>
                        Cancel
                    </button>
                    <button class="btn btn-outline-success" type="button" @click="addTransaction"><i
                        class="fas fa-save">
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
            transaction: {},
            message: '',
            errors: null,
            saved: null,
            states: [
                {id: 1, name: 'In progress'},
                {id: 2, name: 'Approved'},
                {id: 3, name: 'Rejected'},
            ],
            state: {id: 1, name: 'In progress'},
            types: [],
            type: [],


        }
    },
    mounted() {
        this.$root.$on('createNewTransaction', (offer_id) => {
            this.clearData();
            this.transaction.offer_id = offer_id;
        });
    }, created() {
        this.getTransactionTypes();
        this.clearData();
    },
    methods: {
        closePopup() {
            this.$root.$data.newTransaction = false;
        }, addTransaction() {
            axios.post('/transaction', this.transaction)
                .then((r) => {
                    if (!(parseInt(r.data) <= 0)) {
                        this.transaction.id = r.data;
                        this.$root.$emit('transactionAdded', this.transaction);
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
            this.transaction = {
                id: 0,
                date: this.dateNow(),
                amount: 0,
                number: '',
                state_id: 1,
                transaction_type_id: 1,
                offer_id: 0,
                info: '',
                details: ''
            };
        }, dateNow() {
            return new Date().toISOString();
        }, changeState() {
            this.transaction.state_id = this.state.id;
        }, changeType() {
            this.transaction.transaction_type_id = this.type.id;
        }, getTransactionTypes() {
            axios.get('/transactiontype').then(r => {
                this.types = r.data;
                this.type = r.data[0];
            }).catch((e) => {
                if (e.response.status === 422) {
                    this.errors = e.response.data.errors;
                } else {
                    this.$root.fetchError(e);
                }
            });
        }
    }
}
</script>
