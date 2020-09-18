<template ref="offers">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-inline-block" style="vertical-align: top;">
                        <button class="btn btn-success" @click="addDeal"><i class="fas fa-plus"></i></button>
                    </div>
                    <div class="d-inline-block" style="vertical-align: top; padding: 6px;">
                        <h4>Deals</h4>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-sm table-striped table-responsive">
                        <thead class="thead">
                        <tr>
                            <th scope="col">#ID</th>
                            <th scope="col">Inquiry Date</th>
                            <th scope="col">Date Planed</th>
                            <th scope="col">Company</th>
                            <th scope="col">Contact</th>
                            <th scope="col">Offer Number</th>
                            <th scope="col">Order Number</th>
                            <th scope="col">Title</th>
                            <th scope="col">Info</th>
                            <th scope="col">Total</th>
                            <th scope="col">Total with vat</th>
                            <th scope="col">Balance</th>
                            <th scope="col">Expences (services)</th>
                            <th scope="col">Profit</th>
                            <th scope="col">Planned Amount</th>
                            <th scope="col">Amount (fact)</th>
                            <th scope="col">Amount with VAT</th>
                            <th scope="col">User (created by)</th>
                            <th scope="col">Delivery address</th>
                            <th scope="col">Delivery date</th>
                            <th scope="col">Comment</th>
                            <th scope="col">Manager</th>
                            <th scope="col">Request received</th>
                            <th scope="col">Private|Company</th>
                            <th scope="col">Inquiry type</th>
                            <th scope="col">Inquiry profile</th>
                            <th scope="col">Maintenance (staff service)</th>
                            <th scope="col">Partner</th>
                            <th scope="col">Date created</th>
                            <th scope="col">Date updated</th>
                            <th scope="col">Updated By</th>
                            <th scope="col">Version</th>
                            <th scope="col">Probability %</th>
                            <th scope="col">Stage</th>
                            <th scope="col" width="200">Description</th>
                            <th scope="col">Files</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="group-line" v-for="item in items">
                            <th scope="row">{{ item.id }}</th>
                            <td scope="row">{{ item.inquiry_date }}</td>
                            <td scope="row">{{ item.planed_date }}</td>
                            <td>
                                {{ item.company !== null && (typeof item.company.name !== undefined) ? item.company.name : '' }}
                            </td>
                            <td>
                                {{ item.client !== null && (typeof item.client.name !== undefined) ? item.client.name : '' }}
                            </td>
                            <td>{{ item.number }}</td>
                            <td>{{ item.order_number }}</td>
                            <td>{{ item.title }}</td>
                            <td>{{ item.info }}</td>
                            <td>{{ item.total }}</td>
                            <td>{{ item.total_with_vat }}</td>
                            <td>{{ item.balance }}</td>
                            <td>{{ item.other_services }}</td>
                            <td>{{ item.sales_profit }}</td>
                            <td>{{ item.planned_amount_percents}}</td>
                            <td>{{ item.project_amount}}</td>
                            <td>{{ item.project_amount_with_vat}}</td>
                            <td>{{ item.user.name }}</td>
                            <td>{{ item.delivery_address }}</td>
                            <td>{{ item.delivery_date }}</td>
                            <td>{{ item.comment }}</td>
                            <td>
                                {{ item.manager !== null && (typeof item.manager.name !== undefined) ? item.manager.name : '' }}
                            </td>
                            <td>{{ sources[item.received_id] }}</td>
                            <td>{{ private[item.private] }}</td>
                            <td>{{ types[item.type_id] }}</td>
                            <td>{{ profiles[item.profile_id] }}</td>
                            <td>
                                {{ item.maintenance !== null && (typeof item.maintenance.name !== undefined) ? item.maintenance.name : '' }}
                            </td>
                            <td>{{ item.partner }}</td>
                            <td>{{ item.created_at }}</td>
                            <td>{{ item.updated_at }}</td>
                            <td>{{ item.editor.name }}</td>
                            <td>{{ item.version }}</td>
                            <td>{{ item.chance }}</td>
                            <td>
                                <div class="stage " v-bind:class="item.state.class">
                                    {{ item.state !== null && (typeof item.state.name !== undefined) ? item.state.name : '' }}
                                </div>
                            </td>
                            <td>
                                <div class="offer-comment">
                                    {{ item.description }}
                                </div>

                            </td>
                            <td>
                                <ul>
                                    <li v-for="file in item.files">
                                        <a v-bind:href="file.file_uri" target="_blank">{{ file.file_name}}</a>

                                    </li>
                                </ul>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-outline-secondary" @click="itemShow(item.id)"><i
                                    class="fas fa-search-dollar"></i></button>
                                <button class="btn btn-sm btn-outline-secondary" @click="itemLoad(item)"><i
                                    class="far fa-edit"></i></button>
                                <button class="btn btn-sm btn-outline-info" @click="itemDelete(item)"><i
                                    class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <deals-popup ref="popup"></deals-popup>
        <nope-popup ref="nope"></nope-popup>
    </div>
</template>

<script>
export default {
    data() {
        return {
            items: [],
            sources: ['not defined', 'www', 'email', 'other'],
            private: ['private', 'company'],
            types: ['Private', 'Apartments', 'Commercial'],
            profiles: ['Wood', 'Wood + Al', 'Aluminium'],
        }
    },
    created() {
        this.fetchItems();
    },
    mounted() {
        this.$root.$on('offerAdded', () => {
            this.fetchItems();
        });
    },
    methods: {
        fetchItems() {
            axios.get('/deals').then(response => {
                if (response.data.length > 0)
                    this.items = response.data;
            }).catch((error) => {
                this.$root.fetchError(error);
            });
        },
        addDeal() {
            //newOffer
            this.$root.$emit('newOffer');
            this.$root.$data.popup = true;
        },
        itemLoad(item) {
            this.$root.$emit('editOffer', item);
            this.$root.$data.popup = true;
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
