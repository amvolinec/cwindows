<template>
    <div class="wrapper" v-if="this.$root.$data.configurator">
        <div class="popup-window" v-bind:style="style">
            <div class="popup-head">Window 2d Configurator 2<i @click="closePopup"
                                                               class="far fa-times-circle float-right"></i>
            </div>
            <div class="popup-inner">
                <canvas v-bind:id="id" v-bind:width="width" v-bind:height="height">
                    Your browser does not support the canvas element.
                </canvas>
                <div class="form-group text-left">
                    <div>
                        <label>aWidth</label>
                        <input class="w-input" type="number" v-model="window.aWidth" @change="createCanvas">
                        <label>aHeight</label>
                        <input class="w-input" type="number" v-model="window.aHeight" @change="createCanvas">
                    </div>
                    <div>
                        <label>bWidth</label>
                        <input class="w-input" type="number" v-model="window.bWidth" @change="createCanvas">
                        <label>bHeight</label>
                        <input class="w-input" type="number" v-model="window.bHeight" @change="createCanvas">
                    </div>
                    <div>
                        <label>cWidth</label>
                        <input class="w-input" type="number" v-model="window.cWidth" @change="createCanvas">
                        <label>cHeight</label>
                        <input class="w-input" type="number" v-model="window.cHeight" @change="createCanvas">
                        <button class="btn btn-outline-success" type="button" @click="createCanvas"><i
                            class="fas fa-calculator"></i>
                            Show
                        </button>
                    </div>

                </div>

                <div class="form-group text-right">
                    <button class="btn btn-outline-info" type="button" @click="closePopup"><i class="fas fa-times"></i>
                        Cancel
                    </button>
                    <button class="btn btn-outline-success" type="button" @click="saveCanvas"><i class="fas fa-trash">
                        Create</i>
                    </button>
                </div>

            </div>


        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            id: 'canvas2d',
            width: '600px',
            height: '240px',
            style: 'width: 660px; z-index: 10;',
            window: {aWidth: 100, aHeight: 180, bWidth: 100, bHeight: 180, cWidth: 10, cHeight: 10}
        }
    },
    mounted() {
        // this.$root.$on('nopeItem', (item) => {
        //     this.item = item;
        // });
    },
    created() {
        // ctx.fillRect(0,0,150,75);
    },
    methods: {
        closePopup() {
            this.$root.$data.configurator = false;
        }, deleteItem() {
            axios.delete(this.item.route, {params: {'id': this.item.id}})
                .then((r) => {
                    this.closePopup();
                });
            // console.log(this.item.id + ' ' + this.item.model);
        }, saveCanvas() {
            // axios.post('/good/set/', {params: {'id': this.item.id}})
            //     .then((r) => {
            //         this.closePopup();
            //     });

        }, createCanvas() {
            let canvas = document.getElementById("canvas2d");

            const ctx = canvas.getContext('2d');

            ctx.clearRect(0, 0, canvas.width, canvas.height);

            let aWidthOuter = parseInt(this.window.aWidth) + parseInt(this.window.cWidth) * 2;
            let aWidthInner = parseInt(this.window.aWidth);

            let aHeightOuter = parseInt(this.window.aHeight) + parseInt(this.window.cHeight) * 2;
            let aHeightInner = parseInt(this.window.aHeight);

            let bWidthOuter = parseInt(this.window.bWidth) + parseInt(this.window.cWidth) * 2;
            let bWidthInner = parseInt(this.window.bWidth);

            let bHeightOuter = parseInt(this.window.bHeight) + parseInt(this.window.cHeight) * 2;
            let bHeightInner = parseInt(this.window.bHeight);

            let cWidth = parseInt(this.window.cWidth);
            let cHeight = parseInt(this.window.cHeight);

            ctx.strokeRect(0, 0, aWidthOuter, aHeightOuter);
            ctx.strokeRect(cWidth, cHeight, aWidthInner, aHeightInner);

            ctx.strokeRect(aWidthOuter, 0, bWidthOuter, bHeightOuter);
            ctx.strokeRect(aWidthOuter + cWidth, cHeight, bWidthInner, bHeightInner);
        }
    }
}
</script>
