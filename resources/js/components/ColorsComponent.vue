<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="d-inline-block" style="vertical-align: top; padding: 6px;">
                            <h4>Colors</h4>
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
                                <th scope="col">Code</th>
                                <th scope="col">File</th>
                                <th scope="col">Created</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="color in colors">
                                <td>{{ color.id }}</td>
                                <td>{{ color.name }}</td>
                                <td>{{ color.code }}</td>
                                <td>{{ color.file_name }}</td>
                                <td>{{ color.created_at }}</td>

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
            colors: [],
            search: '',
        }
    },
    created() {
        this.getData();
    },
    methods: {
        getData() {
            axios.get('/colors-get').then((r) => {
                // this.items = r.data;
                this.colors = r.data.data;
            });
        }, setFiler() {
            axios.post('/colors-search', {'search': this.search}).then((r) => {
                // console.log(r.data);
                this.colors = r.data;
            });
            // console.log(this.search);
        }
    }
}
</script>
