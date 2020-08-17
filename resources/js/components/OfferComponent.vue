<template ref="offer">
    <div class="row justify-content-center">

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="d-inline-block" style="vertical-align: top; padding: 6px;">
                        <h4>{{ item.title }}</h4>
                    </div>
                </div>

                <div class="card-body">
                    <div class="panel-info">
                        <div class="d-inline-flex">
                            <h5>Information</h5>
                        </div>
                        <div class="d-inline-flex">
                            <button class="btn btn-sm btn-outline-secondary" @click="itemLoad(item)"><i
                                class="far fa-edit"></i></button>
                        </div>
                    </div>
                    <table class="table table-sm">
                        <tbody>
                        <tr>
                            <th scope="row">Planned date of sale</th>
                            <td>{{ item.planed_date }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Company</th>
                            <td>
                                {{ typeof item.company === 'undefined' ? '' : item.company.name }}
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Client</th>
                            <td>
                                {{ typeof item.client === 'undefined' ? '' : item.client.name }}
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Planned amount</th>
                            <td>{{ item.project_amount }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Responsible person</th>
                            <td>{{ typeof item.client === 'undefined' ? '' : item.user.name }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Delivery address</th>
                            <td>{{ item.delivery_address }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Delivery Date</th>
                            <td>{{ item.delivery_date }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Offer No.</th>
                            <td>{{ item.number }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Order No.</th>
                            <td>{{ item.order_number }}</td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>

            <div class="card mt-2">
                <div class="card-body">
                    <div class="panel-info">
                        <div class="d-inline-flex">
                            <h5>Product list</h5>
                        </div>
                        <div class="d-inline-flex">
                            <button class="btn btn-sm btn-outline-secondary" @click="positionsLoad(item)"><i
                                class="far fa-edit"></i></button>
                        </div>
                    </div>

                    <div class="text-right small">Total amount: {{ item.total }} €</div>
                    <div class="text-right small">VAT: {{ ( item.total_with_vat - item.total) }} €</div>
                    <div class="text-right"><strong>TOTAL: {{ item.total_with_vat }} €</strong></div>
                    <div class="text-right small">Margin with expenses: {{ item.sales_profit }} € ({{ item.total > 0 ? item.sales_profit / item.total * 100 : 0 }}%) </div>
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
        }
    },
    created() {
        this.fetchItems();
    },
    methods: {
        fetchItems() {
            let url = '/offer/get/' + this.id;
            axios.get(url).then(response => {
                this.item = response.data;
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
        }
    }
}
</script>
