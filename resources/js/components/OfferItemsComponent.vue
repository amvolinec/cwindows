<template>
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-sm table-condensed">
                <thead class="thead">
                <tr>
                    <th width="30">No.</th>
                    <th width="100">2d Configurator</th>
                    <th width="250">Title</th>
                    <th width="70">Quantity</th>
                    <th width="70">Prime cost</th>
                    <th width="70">Price</th>
                    <th width="80">Discount (%)</th>
                    <th width="80">Discount (€)</th>
                    <th width="70">Price after discount</th>
                    <th width="70">VAT</th>
                    <th width="70">VAT amount</th>
                    <th width="80">Margin</th>
                    <th width="80">Prime total cost</th>
                    <th width="80">Sum</th>
                    <th width="80">Total</th>
                    <th width="40"></th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="item in items">
                    <th scope="row" class="item-sm text-right">
                        <div>{{ item.index }}</div>
                    </th>
                    <td>
                        <input class="form-control item-sm" type="hidden" v-model="item.good_id">
                        <select class="form-control form-control-sm" @change="generateGood">
                            <option disabled selected>Select</option>
                            <option value="wx1">Window x1</option>
                            <option value="wx2">Window x2</option>
                            <option value="wx3">Window x3</option>
                        </select>
                        <!--                        <button class="btn btn-sm btn-outline-dark" @click="generateGood(goods)"><i-->
                        <!--                            class="fas fa-building"></i></button>-->
                    </td>
                    <td><textarea class="form-control item-sm" type="text" v-model="item.title"></textarea></td>
                    <td><input class="form-control item-sm text-right" type="text" v-model="item.quantity"
                               @change="calcSum(item)"></td>
                    <td><input class="form-control item-sm text-right" type="text" v-model="item.cost"
                               @change="calcSum(item)"></td>
                    <td><input class="form-control item-sm text-right" type="text" v-model="item.price"
                               @change="calcSum(item)"></td>
                    <td><input class="form-control item-sm text-right" type="text" v-model="item.discount_next"
                               @change="calcDiscount(item, true)"></td>
                    <td><input class="form-control item-sm text-right" type="text" v-model="item.discount"
                               @change="calcDiscount(item, false)"></td>
                    <td class="item-sm text-right">
                        <div v-if="item.final_price > 0">{{ (item.final_price).toFixed(2) }}</div>
                    </td>
                    <td>
                        <select class="form-control item-sm" type="text" v-model="item.vat" @change="calcSum(item)">
                            <option value=21>21%</option>
                            <option value=20>20%</option>
                            <option value=16>16%</option>
                            <option value=9>9%</option>
                            <option value=5>5%</option>
                            <option value=0>0%</option>
                        </select>
                    </td>
                    <td class="item-sm text-right">
                        <div v-if="item.vat_amount > 0">{{ (item.vat_amount).toFixed(2) }}</div>
                    </td>
                    <td class="item-sm text-right">
                        <div v-if="item.margin > 0">{{ (item.margin).toFixed(2) }}</div>
                    </td>
                    <td class="item-sm text-right">
                        <div v-if="item.total_cost > 0">{{ (item.total_cost).toFixed(2) }}</div>
                    </td>
                    <td class="item-sm text-right">
                        <div v-if="item.subtotal > 0">{{ (item.subtotal).toFixed(2) }}</div>
                    </td>
                    <td class="item-sm text-right">
                        <div v-if="item.total > 0">{{ (item.total).toFixed(2) }}</div>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-outline-info" @click="removeItem(item)"><i
                            class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="form-group mb-1 row">
            <div class="col-md-6">
                <div class="form-group mb-1 text-left">
                    <button class="btn btn-sm btn-outline-success" @click="addRow"><i class="fas fa-cart-plus"></i> Add
                        row
                    </button>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group mb-1 row">
                    <div class="col-md-10 text-right">Amount without VAT:</div>
                    <div class="col-md-2 text-right">{{ $root.format(total.total) }}</div>
                </div>

                <div class="form-group mb-0 row">
                    <div class="col-md-10 text-right">VAT amount:</div>
                    <div class="col-md-2 text-right">{{ $root.format(total.total_with_vat - total.total) }}</div>
                </div>

                <div class="form-group mb-0 row">
                    <div class="col-md-10 text-right">Amount with VAT:</div>
                    <div class="col-md-2 text-right">{{ $root.format(total.total_with_vat) }}</div>
                </div>

                <div class="form-group mb-0 row">
                    <div class="col-md-10 text-right">Margin with expenses:</div>
                    <div class="col-md-2 text-right">{{ $root.format(total.sales_profit) }}</div>
                </div>

                <div class="form-group mb-0 text-right">
<!--                    <button class="btn btn-outline-secondary" type="button" @click="printOffer"-->
<!--                            v-if="typeof items[0].offer_id !== 'undefined'">-->
<!--                        <i class="fas fa-file"></i>-->
<!--                        Create New Tender-->
<!--                    </button>-->
<!--                    <button class="btn btn-outline-secondary" type="button" @click="previewOffer"-->
<!--                            v-if="typeof items[0].offer_id !== 'undefined'">-->
<!--                        <i class="far fa-file-pdf"></i>-->
<!--                        Preview-->
<!--                    </button>-->
                    <button class="btn btn-outline-dark" type="button" @click="closePopup"><i class="fas fa-times"></i>
                        Cancel
                    </button>
                    <button class="btn btn-outline-success" type="button" @click="saveOffer"><i class="fas fa-save"></i>
                        Save
                    </button>
                </div>
            </div>
        </div>
        <configurator></configurator>
        <configurator-w1></configurator-w1>
    </div>
</template>

<script>
export default {
    data() {
        return {
            items: [],
            deleted: [],
            trash: [],
            total: {total: 0, total_with_vat: 0, sales_profit: 0},
            index: 0,
            goods: 0
        }
    },
    mounted() {
        this.$root.$on('offerItemsSaved', () => {
            this.items = this.$root.$data.offer.positions;
            if(typeof this.items === 'undefined') {
                console.log('OfferItemsComponents: Items Not Defined!');
            } else {
                this.onLoad();
            }
        });
    },
    created() {
        this.items = this.$root.$data.offer.positions;
        if (this.isEmpty(this.items)) {
            this.addRow();
        }
        this.onLoad();
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
                id: null,
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
            if (item.id !== null) {
                this.deleted.push(item.id);
            }
            const index = this.items.indexOf(item);
            if (index > -1) {
                this.items.splice(index, 1);
            }
            this.onLoad();
        }, addRow() {
            this.items.push(this.itemAdd());
        }, calcDiscount(item, percents) {
            if (percents) {
                item.discount = item.price * item.quantity / 100 * item.discount_next;
            } else {
                item.discount_next = item.price * item.quantity > 0 ? item.discount / item.price * item.quantity : 0;
            }
            this.calcSum(item);
        }, calcSum(item) {

            item.subtotal = item.price * item.quantity - item.discount;
            item.final_price = item.quantity > 0 ? item.subtotal / item.quantity : 0;

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

            this.nopeDeleted();
            this.$root.$emit('saveOfferNow', this.items);

        }, closePopup() {

            this.$root.$emit('closePopupNow');

        }, onLoad() {
            this.items.forEach((item, index) => {
                item.index = index + 1;
                this.index++;
                this.calcSum(item);
            });
        }, nopeDeleted() {
            this.deleted.forEach((item, index) => {
                axios.delete('/position/', {params: {'ids': this.deleted}}).then((r) => {
                    console.log(r);
                }).catch((error) => {
                    this.$root.fetchError(error);
                });
            });
        }, generateGood(e) {
            let val = e.target.value;
            console.log(val);
            if (val === 'wx1')
                this.$root.$data.configurator1 = true;
            if (val === 'wx2')
                this.$root.$data.configurator2 = true;
        }
        // , previewOffer() {
        //     window.open('/offer/preview/' + this.items[0].offer_id, "blank", "width=900,height=640");
        // }
        // , printOffer() {
        //     axios.get('/offer/print/' + this.items[0].offer_id).then(response => {
        //         if (response.data.status === 'error') {
        //             this.message = response.data.message;
        //             return;
        //         }
        //         window.open('/documents/' + response.data.file_name);
        //         this.closePopup();
        //     }).catch((error) => {
        //         this.$root.fetchError(error);
        //     });
        // }
    }
}
</script>
