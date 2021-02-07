<template>
    <div>
        <div class="card">
            <div class="card-header">
                <div class="d-inline-block" style="vertical-align: top; padding: 6px;">
                    <h4>{{ settings.title }}</h4>
                </div>
            </div>
            <div class="card-body">
                <w-table v-bind:items="items" v-bind.sync="items" v-bind:settings="settings" v-on:wSave="saveContacts"
                         v-on:wAdd="addContacts"></w-table>
            </div>
            <div class="m-3">
                <nav aria-label="Navigation">
                    <w-pagination v-model="currentPage"
                                  :page-count="totalPages" v-on:input="loadPage"></w-pagination>
                </nav>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    data() {
        return {
            items: [{}],
            settings: {
                title: 'Contacts',
                fields: [
                    {title: '#', data: 'id', type: 'number', editable: false},
                    {title: 'Name', data: 'name'},
                    {title: 'Email', data: 'email', type: 'email'},
                    {title: 'Phone', data: 'phone'},
                    {title: 'Address', data: 'address'},
                ]
            },
            currentPage: 1,
            totalPages: 1,
            uri: '/w-contact',
        }
    },
    mounted() {
        this.getContacts();
    },
    methods: {
        getContacts() {
            axios.get(this.uri + '?page=' + this.currentPage).then(r => {
                // this.currentPage = parseInt(r.data.from)
                this.totalPages = parseInt(r.data.last_page)
                this.items = r.data.data
            }).catch((error) => {
                this.$root.fetchError(error);
            });
        },
        saveContacts() {
            axios.post(this.uri, {data: this.items}).then(r => {
                let isDeleted = false;
                this.items.forEach(e => {
                    if (e.deleted === true) isDeleted = true;
                });
                if (isDeleted) this.getContacts();
            }).catch((error) => {
                this.$root.fetchError(error);
            });
        },
        addContacts() {
            axios.get(this.uri + '/add').then(r => {
                this.items = r.data.data;
            }).catch((error) => {
                this.$root.fetchError(error);
            });
        },
        loadPage() {
            this.getContacts();
        }
    }
}
</script>
