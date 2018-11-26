<template>
    <transition enterActiveClass="fade-in-down"leaveActiveClass="fade-out-up"mode="out-in">
        <div class="panel-default panel mt-3 pt-4 bg-grey" id="edit_region">
            <div class="panel-body">
                <h3 class="text-center mb-3">Edit <strong>{{ region.name }}</strong> Region</h3>

                <div class="row pl-0 pr-0 m-0 pt-4 pb-4">
                    <div class="col-sm-12 d-flex form-group">
                        <div class="col-sm-6 col-xs-12 text-center">
                            <label for="name-region"class="form-control-label panel-font-small m-0">
                                Name
                            </label>

                            <input id="name-region" type="text"
                            class="form-control form-control-sm"
                            @keyup.enter="editRegion"
                            @input="$v.name.$touch()"
                            :placeholder="region.name"
                            :class="{'form-control-danger': $v.name.$error}" 
                            v-model="name">

                            <!--======================================================================================
                                V A L I D A T I O N     E R R O R   M E S S A G E S
                                ======================================================================================-->
                            <transition enterActiveClass="fade-in" leaveActiveClass="fade-out" mode="out-in">
                                <span key="name-required" class="text-danger text-center" 
                                v-if="!$v.name.required && $v.name.$dirty">
                                    Name is required
                                </span>
                                <span class="text-danger text-center" v-else-if="!$v.name.minLength">
                                    Name has a minimum of {{ $v.name.$params.minLength.min }} characters
                                </span>
                                <span  class="text-danger text-center" v-else-if="!$v.name.maxLength">
                                    Name has a maximum of {{ $v.name.$params.maxLength.max }} characters
                                </span>
                            </transition> 
                        </div>

                        <div class="col-sm-6 col-xs-12 text-center">
                            <label for="region-city"class="form-control-label panel-font-small m-0">
                                City
                            </label>
                            
                            <input id="region-city" type="text"
                            class="form-control form-control-sm"
                            @keyup.enter="editRegion"
                            :placeholder="region.city"
                            v-model="city">
                        </div>
                    </div>

                    <div class="col-sm-12 d-flex form-group">
                        <div class="col-sm-12 text-center">
                            <label for="region-address" class="form-control-label panel-font-small m-0">
                                Address
                            </label>

                            <input type="region-address"
                            class="form-control form-control-sm"
                            @keyup.enter="editRegion"
                            :placeholder="region.address"
                            v-model="address">
                        </div>
                    </div>

                    <div class="col-sm-12 d-flex justify-content-center mt-2">
                        <button type="button" 
                                class="btn btn-secondary btn-sm"
                                @click="closeEditForm">
                            Cancel
                        </button>

                        <button @click="editRegion"
                        class="btn btn-success btn-sm ml-2" :disabled="isRequesting">
                            <template v-if="isRequesting">Saving..</template>
                            <template v-else>Save</template>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
    import {required, minLength, maxLength} from 'vuelidate/lib/validators';
    import {mapGetters} from 'vuex';
    export default{
        props: {
            region: {
                type: [Object],
                default() {
                    return {}
                }
            }
        },

        data(){
            return {
                isRequesting: false,
                name: this.region.name,
                city: this.region.city == undefined ? '' : this.region.city,
                address: this.region.address == undefined ? '' : this.region.address,
            }
        },

        validations: {
            name: {
                required,
                minLength: minLength(3),
                maxLength: maxLength(50)
            },
        },

        computed: {
            regionIsEdited(){
                return this.region.name !== this.name 
                    || this.region.city !== this.city
                    || this.region.address !== this.address;
            },

            formIsFilled(){
                return this.name != ''
                    && this.name.length >= 3
                    && this.name.length <= 50;
            }
        },

        methods: {
            editRegion(){

                const self = this;

                if (this.regionIsEdited && this.formIsFilled && !this.isRequesting) {

                    this.isRequesting = true;

                    const updatedRegion = {
                        id: this.region.id,
                        name: this.name,
                        city: this.city,
                        address: this.address,
                    };

                    this.$store.dispatch('update_region', updatedRegion)

                        .then((updatedRegion) => {

                            flash(updatedRegion.name + ' is succesfully updated', 'success');

                            self.isRequesting = false;

                            self.closeEditForm();
                        })
                        .catch(errors => {
                            self.isRequesting = false;
                        });
                }
            },

            closeEditForm() {
                this.$emit('editionFormIsClosed', false);
            }
        },
    };
</script>

<style type="text/css">
    .vdatetime-input {
        width: 100%;
        padding: .375rem .75rem;
        line-height: 1.5;
        font-size: 1rem;
        color: #495057;
        border-radius: .25rem;
        border: 1px solid #ced4da;
    }

    ::-webkit-input-placeholder,
    :-moz-placeholder, /* Firefox 18- */
    ::-moz-placeholder, /* Firefox 19+ */
    :-ms-input-placeholder {
        text-align: center;
    }

    input {
        text-align: center;
    }

    select {
        text-align: center;
        text-align-last: center;
        /* webkit*/
    }

    option {
        text-align: left;
    }

    .normal-placeholder::-webkit-input-placeholder,
    .normal-placeholder:-moz-placeholder,
    .normal-placeholder::-moz-placeholder,
    .normal-placeholder:-ms-input-placeholder {
        text-align: left !important;
    }

    .form-control-danger input {
        border-color: #dc3545 !important;
    }

    .form-control-danger input:focus {
        border-color: #dc3545 !important;
        box-shadow: 0 0 0 0.2rem rgba(220,53,69,.25) !important;
    }
</style>

<style scoped>
    .bg-grey {
        background: #fafafa;
    }

    .panel-font-small {
        font-size: 0.9rem;
    }
</style>