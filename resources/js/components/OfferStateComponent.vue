<template>
    <div class="offer-state-outer">
        <div class="offer-state-inner">
            <div class="offer-state-item" :class="{ selected: isSelected(state), completed: isCompleted(state) }"
                 v-for="state in states">
                <div class="state-inner" @click="changeState(state)">{{ state.name }}</div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['states', 'state'],
    data() {
        return {
            // states: [],
            // state: 1,
        }
    },
    mounted() {
        this.$root.$on('changeState', (state) => {
            this.state = state.id;
        });
    },
    methods: {
        changeState(state) {
            // this.state = state.id;
            this.$root.$emit('stateChanged', state.id)
        }, isSelected(state) {
            return this.state === state.id;
        }, isCompleted(state) {
            return this.state > state.id;
        }
    },
}
</script>
