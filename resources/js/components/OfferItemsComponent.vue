<template>
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-sm table-condensed">
                <thead class="thead">
                <tr>
                    <th width="30">No.</th>
                    <th width="200">Product</th>
                    <th width="auto">Title</th>
                    <th width="70">Quantity</th>
                    <th width="40">Unit</th>
                    <th width="70">Prime cost</th>
                    <th width="70">Price</th>
                    <th width="70">Discount</th>
                    <th width="70">Discount</th>
                    <th width="70">Price after discount</th>
                    <th width="70">VAT</th>
                    <th width="70">VAT amount</th>
                    <th width="80">Margin</th>
                    <th width="80">Prime total cost</th>
                    <th width="80">Total</th>
                    <th width="40"></th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="item in items">
                    <th scope="row" class="item-sm text-right">
                        <div>{{ item.index }}</div>
                    </th>
                    <td><input class="form-control item-sm" type="text" v-model="item.product"></td>
                    <td><textarea class="form-control item-sm" type="text" v-model="item.title"></textarea></td>
                    <td><input class="form-control item-sm text-right" type="text" v-model="item.quantity"
                               @change="calcSum(item)"></td>
                    <td class="item-sm text-right">{{ item.unit }}</td>
                    <td><input class="form-control item-sm text-right" type="text" v-model="item.cost"
                               @change="calcSum(item)"></td>
                    <td><input class="form-control item-sm text-right" type="text" v-model="item.price"
                               @change="calcSum(item)"></td>
                    <td><input class="form-control item-sm text-right" type="text" v-model="item.discount"
                               @change="calcSum(item)"></td>
                    <td><input class="form-control item-sm text-right" type="text" v-model="item.discount_next"
                               @change="calcSum(item)"></td>
                    <td class="item-sm text-right">
                        <div v-if="item.final_price > 0">{{ item.final_price }}</div>
                    </td>
                    <td>
                        <select class="form-control item-sm" type="text" v-model="item.vat" @change="calcSum(item)">
                            <option value=21>21%</option>
                            <option value=9>9%</option>
                            <option value=5>5%</option>
                            <option value=0>0%</option>
                        </select>
                    </td>
                    <td class="item-sm text-right">
                        <div v-if="item.vat_amount > 0">{{ item.vat_amount }}</div>
                    </td>
                    <td class="item-sm text-right">
                        <div v-if="item.margin > 0">{{ item.margin }}</div>
                    </td>
                    <td class="item-sm text-right">
                        <div v-if="item.total_cost > 0">{{ item.total_cost }}</div>
                    </td>
                    <td class="item-sm text-right">
                        <div v-if="item.total > 0">{{ item.total }}</div>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-outline-danger" @click="removeItem(item)"><i
                            class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="form-group mb-1 text-left">
            <button class="btn btn-sm btn-info" @click="addRow"> Add row</button>
            <button class="btn btn-sm"> Add group</button>
        </div>

        <div class="form-group mb-1 row">
            <div class="col-md-10 text-right">Amount without VAT:</div>
            <div class="col-md-2 text-right">{{ total.total }}</div>
        </div>

        <div class="form-group mb-0 row">
            <div class="col-md-10 text-right">VAT amount:</div>
            <div class="col-md-2 text-right">{{ total.total_with_vat - total.total }}</div>
        </div>

        <div class="form-group mb-0 row">
            <div class="col-md-10 text-right">Amount with VAT:</div>
            <div class="col-md-2 text-right">{{ total.total_with_vat }}</div>
        </div>

        <div class="form-group mb-0 row">
            <div class="col-md-10 text-right">Margin with expenses:</div>
            <div class="col-md-2 text-right">{{ total.sales_profit }}</div>
        </div>

        <div class="form-group mb-0 text-right">
            <button class="btn btn-outline-info" type="button" @click="closePopup"><i class="fas fa-times"></i>
                Cancel
            </button>
            <button class="btn btn-outline-success" type="button" @click="saveOffer"><i class="fas fa-save">
                Save</i>
            </button>
        </div>

    </div>
</template>

<script>
export default {
    data() {
        return {
            items: [],
            total: {total: 0, total_with_vat: 0, sales_profit: 0},
            index: 0
        }
    },
    created() {
        if (this.isEmpty(this.items)) {
            this.addRow();
        }
        this.items = this.$root.$data.offer.positions;
        this.onLoad();
    },
    mounted() {
        // this.$root.$on('editOfferItems', (items) => {
        //     this.items = items;
        //     console.log(items);
        // });
    },
    methods: {
        saveOfferItems() {
            this.message = '';
            axios.post('/set-offer-items', this.items).then(response => {
                if (response.data.status === 'error') {
                    this.message = response.data.message;
                    return;
                }
                this.clearPopup();
                this.$root.$emit('offerEdited');
            }).catch((error) => {
                this.$root.fetchError(error);
            });
        }, itemAdd() {
            this.index++;
            return {
                index: this.index,
                product: '',
                title: '',
                quantity: '',
                unit: 'psc.',
                warehouse_id: 0,
                cost: '',
                price: '',
                discount: '',
                discount_next: '',
                final_price: '',
                vat: 21,
                subtotal: 0,
                total: 0,
                vat_amount: 0,
                total_cost: 0,
                margin: 0

            }
        }, isEmpty(fineArray) {
            return !(typeof fineArray != "undefined"
                && fineArray != null
                && fineArray.length != null
                && fineArray.length > 0);
        }, removeItem(item) {
            this.items.remove(item);
        }, addRow() {
            this.items.push(this.itemAdd());
        }, calcSum(item) {
            item.final_price = item.price - item.discount - item.discount_next;
            item.subtotal = item.final_price * item.quantity;
            item.total_cost = item.cost * item.quantity;
            item.vat_amount = item.subtotal * item.vat / 100;
            item.total = item.vat_amount + item.subtotal;
            item.margin = item.subtotal - item.total_cost;

            this.calcTotal();
            this.$root.$emit('updateOfferSum', this.total);

        }, calcTotal() {
            this.total = {total: 0, total_with_vat: 0, sales_profit: 0};
            this.items.forEach((item, index) => {
                this.total.total += item.subtotal;
                this.total.total_with_vat += item.total;
                this.total.sales_profit += item.margin;
            });
        }, saveOffer() {
            this.$root.$emit('saveOfferNow', this.items);
        }, closePopup() {
            this.$root.$emit('closePopupNow');
        }, onLoad() {
            this.items.forEach((item, index) => {
                item.index = index + 1;
                index++;
                this.calcSum(item);
            });
        }
    }
}
</script>
