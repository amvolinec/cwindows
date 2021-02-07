<template>
    <div style="width: 100%">
        <table class="table table-sm table-striped" style="width:100%">
            <thead>
            <tr>
                <th scope="col" v-for="field in settings.fields">
                    {{ field.title }}
                </th>
                <th scope="col">Deleted</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="item in items">
                <td v-for="field in settings.fields">
                    <div v-if="!field.type || field.type==='text' || field.type==='email' || field.type=== 'password'">
                        <w-input v-model="item[field.data]" v-bind:disabled="isDisabled"
                                 v-bind:type="typeof field.type === 'string' ? field.type : 'text'"
                                 v-bind:wClass="isDisabled ? passiveClass : activeClass"
                        ></w-input>
                    </div>
                    <div v-else-if="field.type && field.type === 'date'">
                        <datetime v-model="item[field.data]" type="date"
                                  :disabled="isDisabled"
                                  v-bind:input-class="[ isDisabled ? passiveClass : activeClass ]"
                                  format="yyyy-MM-dd" value-zone="UTC+3"></datetime>
                    </div>
                    <div v-else class="pt-2">
                        {{ item[field.data] }}
                    </div>
                </td>
                <td>
                    <div class="pt-2">
                        <w-checkbox v-model="item.deleted" v-bind:disabled="isDisabled"></w-checkbox>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        <button v-show="isDisabled" v-bind:disabled="!isDisabled" class="btn btn-sm btn-secondary" @click="add">Add New</button>
        <button class="btn btn-sm " v-bind:class="isDisabled ? 'btn-primary' : 'btn-success'"
                @click="onSave">{{ isDisabled ? 'Edit' : 'Save' }}
        </button>
        <button v-show="!isDisabled" class="btn btn-sm btn-light" @click="isDisabled = true">Cancel</button>
    </div>
</template>

<script>


export default {
    props: {
        items: Array,
        settings: Object
    },
    data() {
        return {
            isDisabled: true,
            passiveClass: 'form-control-sm form-control-plaintext',
            activeClass: 'form-control form-control-sm',
            isDeleted: false
        }
    },
    mounted() {

    },
    methods: {
        onSave() {
            this.checkDeleted();
            if (this.isDeleted && confirm('Realy delete?') === false) {
                return false
            }
            if (!this.isDisabled)
                this.$emit('wSave')
            this.isDisabled = !this.isDisabled
        },
        add() {
            this.$emit('wAdd')
            this.isDisabled = false;
        },
        checkDeleted() {
            this.isDeleted = false;
            this.items.forEach(e => {
                if (e.deleted === true) this.isDeleted = true;
            });
        }, revert() {
            this.isDisabled = true;
        }
    }
}
</script>
