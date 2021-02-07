<template>
    <div>
        <input class="form-check"
               type="checkbox"
               v-bind:checked="checked"
               v-bind:disabled="disabled"
               v-on:change="$emit('change', $event.target.checked)"
        >
    </div>
</template>

<script>
export default {
    model: {
        prop: 'checked',
        event: 'change'
    },
    props: {
        checked: Boolean,
        disabled: Boolean,
    }
}
</script>
