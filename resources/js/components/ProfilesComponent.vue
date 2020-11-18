<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="d-inline-block" style="vertical-align: top; padding: 6px;">
                            <h4>Profiles</h4>
                        </div>
                        <div>
                            <input type="text" v-model="search">
                            <button class="btn btn-default" @click="setFiler">Paieška</button>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-sm table-striped">
                            <thead class="thead">
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Index</th>
                                <th scope="col">File name</th>
                                <th scope="col">Created</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="profile in profiles">
                                <td>{{ profile.id }}</td>
                                <td>{{ profile.name }}</td>
                                <td>{{ profile.price }}</td>
                                <td>{{ profile.index }}</td>
                                <td>{{ profile.file_name }}</td>
                                <td>{{ profile.created_at }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            error: '',
            items: [],
            profiles: [],
            search: '',
        }
    },
    created() {
        this.getData();
    },
    methods: {
        getData() {
            axios.get('/profiles-get').then((r) => {
                // this.items = r.data;
                this.profiles = r.data.data;
            });
        }, setFiler() {
            axios.post('/profiles-search', {'search': this.search}).then((r) => {
                // console.log(r.data);
                this.profiles = r.data;
            });
            // console.log(this.search);
        }
    }
}
</script>
