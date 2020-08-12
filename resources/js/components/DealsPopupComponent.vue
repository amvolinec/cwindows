<template>
    <div class="wrapper" v-if="this.$root.$data.popup">
        <div class="popup-window">
            <div class="popup-head">Create new deal<i @click="closePopup"
                                                      class="far fa-times-circle float-right"></i>
            </div>
            <div class="popup-inner">
                <div class="form-group row">
                    <label class="col-md-4 text-right col-form-label" for="company">Company</label>
                    <input id="company" type="text" class="form-control col-md-8" name="company">
                </div>
                <div class="form-group row">
                    <label class="col-md-4 text-right col-form-label" for="contact">Contact</label>
                    <input id="contact" type="text" class="form-control col-md-8" name="contact">
                </div>
                <div class="form-group row">
                    <label class="col-md-4 text-right col-form-label" for="title">Title</label>
                    <input id="title" type="text" class="form-control col-md-8" name="title">
                </div>

                <div class="form-group row">
                    <label class="col-md-4 text-right col-form-label" for="pipeline">Sales Pipeline</label>
                    <input id="pipeline" type="text" class="form-control col-md-8" name="pipeline">
                </div>

                <div class="form-group row">
                    <label class="col-md-4 text-right col-form-label" for="stage">Stage</label>
                    <input id="stage" type="text" class="form-control col-md-8" name="stage">
                </div>

                <div class="form-group row">
                    <label class="col-md-4 text-right col-form-label" for="planed">Planned date of sale</label>
                    <input id="planed" type="text" class="form-control col-md-8" name="planed">
                </div>

                <div class="form-group row">
                    <label class="col-md-4 text-right col-form-label" for="amount">Planned amount</label>
                    <input id="amount" type="text" class="form-control col-md-8" name="amount">
                </div>

                <div class="form-group row">
                    <label class="col-md-4 text-right col-form-label" for="probability">Probability %</label>
                    <input id="probability" type="text" class="form-control col-md-8" name="probability">
                </div>

                <div class="form-group row">
                    <label class="col-md-4 text-right col-form-label" for="comment">Comment</label>
                    <input id="comment" type="text" class="form-control col-md-8" name="comment">
                </div>

                <div class="form-group row">
                    <label class="col-md-4 text-right col-form-label" for="person">Person</label>
                    <input id="person" type="text" class="form-control col-md-8" name="person">
                </div>

                <div class="form-group text-right">
                    <button class="btn btn-outline-info" type="button" @click="closePopup"><i
                        class="far fa-times-circle"></i> Cancel
                    </button>
                    <button class="btn btn-outline-success" type="button" @click="closePopup"><i class="fas fa-save">
                        Save</i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    methods: {
        closePopup() {
            this.$root.$data.popup = false;
        }
    }
}
</script>
