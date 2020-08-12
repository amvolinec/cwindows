<template>
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
                            <th scope="col" width="10%">Created</th>
                            <th scope="col">Company</th>
                            <th scope="col">Contact</th>
                            <th scope="col">Title</th>
                            <th scope="col">Total</th>
                            <th scope="col" width="15%">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="group-line" v-for="item in items">
                            <th scope="row">{{ item.created_at }}</th>
                            <td>{{ item.client.title }}</td>
                            <td>{{ item.client.contact }}</td>
                            <td>{{ item.title }}</td>
                            <td>{{ item.total }}</td>
                            <td>
                                <button class="btn btn-sm btn-outline-secondary" @click="itemLoad(item)"><i
                                    class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                <button class="btn btn-sm btn-outline-danger" @click="itemDelete(item)"><i
                                    class="fa fa-trash-o" aria-hidden="true"></i></button>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <deals-popup></deals-popup>
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
            this.$root.$data.popup = true;
        },
        itemDelete(item) {
            this.$root.$data.popup = false;
        }
    }
}
</script>
