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
                    <table class="table table-sm table-striped">
                        <thead class="thead">
                        <tr>
                            <th scope="col">Date planed</th>
                            <th scope="col">Company</th>
                            <th scope="col">Contact</th>
                            <th scope="col">Title</th>
                            <th scope="col">Planed amount</th>
                            <th scope="col">Probability %</th>
                            <th scope="col">Stage</th>
                            <th scope="col">Comments</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="group-line" v-for="item in items">
                            <th scope="row">{{ item.planed_date }}</th>
                            <td>{{ item.company !== null && (typeof item.company.name !== undefined) ? item.company.name : ''}}</td>
                            <td>{{ item.client !== null && (typeof item.client.name !== undefined) ? item.client.name : ''}}</td>
                            <td>{{ item.title }}</td>
                            <td>{{ item.project_amount }}</td>
                            <td>{{ item.planned_amount_percents }}</td>
                            <td><div class="stage " v-bind:class="item.state.class">{{ item.state !== null && (typeof item.state.name !== undefined) ? item.state.name : ''}}</div></td>
                            <td>{{ item.info }}</td>
                            <td>
                                <button class="btn btn-sm btn-outline-secondary" @click="itemLoad(item)"><i class="far fa-edit"></i></button>
                                <button class="btn btn-sm btn-outline-danger" @click="itemDelete(item)"><i class="fas fa-trash"></i></button>
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
                this.items = response.data;
            }).catch((error) => {
                this.$root.fetchError(error);
            });
        },
        addDeal() {
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
        }
    }
}
</script>
