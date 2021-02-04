<template ref="offers">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" v-if="setting !== null">
                    <div class="d-inline-block" style="vertical-align: top;">
                        <button class="btn btn-success" @click="addDeal"><i class="fas fa-plus"></i></button>
                    </div>
                    <div class="d-inline-block" style="vertical-align: top; padding: 6px;">
                        <h4>Project list</h4>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-outer" style="width: 100%; position: relative; overflow: auto;">
                        <table class="table table-sm table-striped deals" style="table-layout: fixed; width: 2400px;">
                            <thead class="thead">
                            <tr>
                                <th scope="col" style="width: 150px;">Actions</th>
                                <th scope="col" style="width: 80px;">Project ID</th>
                                <th scope="col" style="width: 140px;">Project ID_Name</th>
                                <th scope="col" style="width: 200px;">Project enquiry message</th>
                                <th scope="col" style="width: 200px;">Project attachments</th>
                                <th scope="col" style="width: 200px;">Project address</th>
                                <th scope="col" style="width: 130px;">Project status ID</th>
                                <th scope="col" style="width: 100px;">Project profile</th>
                                <th scope="col" style="width: 200px;">Project comments</th>
                                <th scope="col" style="width: 100px;">Client ID</th>
                                <th scope="col" style="width: 100px;">Architect ID</th>
                                <th scope="col" style="width: 100px;">Builder ID</th>
                                <th scope="col" style="width: 100px;">Project manager</th>
                                <th scope="col" style="width: 100px;">Estimator ID</th>
                                <th scope="col" style="width: 100px;">Quote ID</th>
                                <th scope="col" style="width: 100px;">Agreement ID</th>
                                <th scope="col" style="width: 100px;">Manufacturing ID</th>
                                <th scope="col" style="width: 100px;">Installers ID</th>
                                <th scope="col" style="width: 100px;">Service ID</th>
                                <th scope="col" style="width: 100px;">Company ID</th>
                                <th scope="col" style="width: 100px;">User ID</th>
                                <th scope="col" style="width: 90px;">Project create date</th>
                                <th scope="col" style="width: 90px;">Change history</th>
                                <th scope="col" style="width: 92px;">Item total sales with VAT</th>
                                <th scope="col" style="width: 90px;">Quote, m2</th>
                                <th scope="col" style="width: 90px;">Agreement date</th>
                                <th scope="col" style="width: 90px;">Manufacture date</th>



<!--                                <th scope="col" style="width: 92px;">Balance</th>-->
<!--                                <th scope="col" style="width: 92px;">Expences (services)</th>-->
<!--                                <th scope="col" style="width: 92px;">Profit</th>-->
<!--                                <th scope="col" style="width: 90px;">Delivery date</th>-->
<!--                                <th scope="col" style="width: 90px;">Request received</th>-->
<!--                                <th scope="col" style="width: 125px;">Private / Company</th>-->
<!--                                <th scope="col" style="width: 100px;">Inquiry type</th>-->
<!--                                <th scope="col" style="width: 200px;">Maintenance (staff service)</th>-->
<!--                                <th scope="col" style="width: 200px;">Partner</th>-->
<!--                                <th scope="col" style="width: 90px;">Quote date</th>-->
<!--                                <th scope="col" style="width: 90px;">Agreement date</th>-->
<!--                                <th scope="col" style="width: 200px;">Updated By</th>-->
<!--                                <th scope="col" style="width: 200px;">Probability %</th>-->
<!--                                <th scope="col" style="width: 90px;">Contract Date</th>-->


                            </tr>
                            </thead>
                            <tbody>
                            <tr class="group-line" v-for="item in items">
                                <!--                        1 Actions-->
                                <td width="200">
                                    <button class="btn btn-sm btn-outline-secondary inline"
                                            @click="newTransaction(item.id)"><i
                                        class="fas fa-dollar-sign"></i></button>
                                    <button class="btn btn-sm btn-outline-secondary inline" @click="itemShow(item.id)">
                                        <i
                                            class="fas fa-search-dollar"></i></button>
                                    <button class="btn btn-sm btn-outline-secondary inline" @click="itemLoad(item)"><i
                                        class="far fa-edit"></i></button>
                                    <button class="btn btn-sm btn-outline-info inline" @click="itemDelete(item)"><i
                                        class="fas fa-trash"></i></button>
                                </td>

                                <!--                        2   Project_ID(autoincremental)-->
                                <th scope="row">{{ item.number }}</th>

<!--                                                         3 project ID name-->
                                <td>{{ item.title }}</td>

                                <!--                        4 project inquiry message-->
                                <td>
                                    <div class="offer-comment">
                                        {{ item.description }}
                                    </div>
                                </td>
                                <!--                        5 project attachement-->

                                <td>
                                    <ul>
                                        <li v-for="file in item.files">
                                            <a v-bind:href="file.file_uri" target="_blank">{{ file.file_name }}</a>
                                        </li>
                                    </ul>
                                </td>

                                <!--                  6 project address-->
                                <td>
                                    <div class="offer-comment">
                                        {{ item.delivery_address }}
                                    </div>
                                </td>

                                <!--                7 project status id-->
                                <td>
                                    <div class="stage " v-bind:class="item.state.class">
                                        {{
                                            item.state !== null && (typeof item.state.name !== undefined) ? item.state.name : ''
                                        }}
                                    </div>
                                </td>
                                <td>
                <!--                                8 Project profile-->
                                    {{ profiles[item.profile_id] }}
                                </td>
                                <!--               9 Project Comments-->
                                <td>
                                    <div class="offer-comment">{{ item.comment }}</div>
                                </td>
                                <td>
                                    <!--           10 Client ID-->
                                    {{
                                        item.client !== null && (typeof item.client.name !== undefined) ? item.client.name : ''
                                    }}
                                </td>
                                <!--              11 Architect ID-->
                                <td>
                                    {{
                                        item.architect !== null && (typeof item.architect.title !== undefined) ? item.architect.title : ''
                                    }}
                                </td>

                                <td>
                                    <!--          12  Builder ID-->
                                </td>

                                <!--              13 Project Manager-->
                                <td>
                                    {{
                                        item.manager !== null && (typeof item.manager.name !== undefined) ? item.manager.name : ''
                                    }}
                                </td>

                                <!--          14 Estimator ID-->
                                <td>

                                </td>


<!--                                               15 QUOTE ID-->

                                <td>
                                    {{ item.version }}
                                </td>

<!--                                                16 agreement ID-->
                                <td>

                                </td>


                                <!--             17 manufacturing ID-->
                                <td>

                                </td>

                                <!--             18 Installers ID-->
                                <td>

                                </td>
                                <!--             19 Service ID-->
                                <td>

                                </td>

                                <!--  20 company ID-->
                                <td>
                                    {{
                                        item.company !== null && (typeof item.company.name !== undefined) ? item.company.name : ''
                                    }}
                                </td>


                                <!--   21 user ID -->
                                <td>
                                    {{
                                        item.client !== null && (typeof item.client.name !== undefined) ? item.client.name : ''
                                    }}
                                </td>


<!--                                  22 project create data-->
                                <td>{{ item.inquiry_date }}</td>

<!--                                  23  change history-->

                                <td>{{ normalizeDate(item.updated_at) }}</td>

<!--                                24 item total price -->

                                <td>{{ item.total_with_vat }}</td>

<!--                                25 quote, m2-->
                                <td>

                                </td>

<!--                                26 agreement date -->
                                <td>{{ normalizeDate(item.contract_date) }}</td>

<!--                                27 manufacture data -->
                                <td>{{ normalizeDate(item.created_at) }}</td>



<!--                                -->
<!--                                <td>{{ item.order_number }}</td>-->
<!--                                <td>{{ item.info }}</td>-->
<!--                                <td>{{ item.total }}</td>-->
<!--                                <td>{{ item.balance }}</td>-->
<!--                                <td>{{ item.expenses }}</td>-->
<!--                                <td>{{ item.sales_profit }}</td>-->
<!--                                <td>{{ normalizeDate(item.delivery_date) }}</td>-->
<!--                                <td>{{ sources[item.received_id] }}</td>-->
<!--                                <td>{{ private[item.private] }}</td>-->
<!--                                <td>{{ types[item.type_id] }}</td>-->
<!--                                <td>-->
<!--                                    {{-->
<!--                                        item.maintenance !== null && (typeof item.maintenance.name !== undefined) ? item.maintenance.name : ''-->
<!--                                    }}-->
<!--                                </td>-->
<!--                                <td>{{ item.partner }}</td>-->

<!--                                <td>{{ item.editor.name }}</td>-->
<!--                                <td>{{ item.chance }}</td>-->



                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <deals-popup ref="popup"></deals-popup>
        <nope-popup ref="nope"></nope-popup>
        <new-transaction></new-transaction>
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
            setting: []
        }
    },
    created() {
        this.fetchItems();
    },
    mounted() {
        this.$root.$on('offerAdded', () => {
            this.fetchItems();
        });
        this.$root.$on('transactionAdded', (t) => {
            this.fetchItems();
        });
    },
    methods: {
        fetchItems() {
            axios.get('/deals').then(response => {
                if (response.data.length > 0)
                    this.items = response.data;
                // this.setting = response.data.setting;
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
        }, newTransaction(id) {
            this.$root.$emit('createNewTransaction', id);
            this.$root.$data.newTransaction = true;
        }, normalizeDate(date){
            return typeof date === "string" ? date.substr(0,10) : date;
        }
    }
}
</script>
