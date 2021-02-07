<template>
    <div>
        <input
               v-bind:type="type"
               v-bind:value="value"
               v-bind:disabled="disabled"
               v-bind:class="wClass"
               v-on:change="$emit('change', $event.target.value)"
        >
    </div>
</template>

<script>
export default {
    model: {
        prop: 'value',
        event: 'change'
    },
    props: {
        value: String,
        type: String,
        disabled: Boolean,
        wClass: String
    }
}
</script>
