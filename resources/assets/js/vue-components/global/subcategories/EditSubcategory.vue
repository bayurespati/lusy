<template>
    <transition enterActiveClass="fade-in-down"
                leaveActiveClass="fade-out-up"
                mode="out-in">
        <div class="panel-default panel mt-3 pt-4 bg-grey" id="edit_subcategory">
            <div class="panel-body">
                <h3 class="text-center">Edit <strong>{{ subcategory.title }}</strong></h3>

                <div class="row pl-0 pr-0 m-0 pt-4 pb-4">


                    <!--=========================================================================================
                        C A T E G O R Y
                        =========================================================================================-->
                    <div class="col-sm-12 row mb-2">
                        <div class="col-sm-3 col-xs-12 d-flex align-items-center justify-content-end">
                            <label for="title"
                                   class="form-control-label panel-font-small m-0 font-weight-bold">
                                Category Name
                            </label>
                        </div>
                        <div class="col-sm-9 col-xs-12">
                            <select class="form-control" 
                            id="category" 
                            v-model="input.category_id"
                            @input="$v.input.category_id.$touch()"
                            :class="{'form-control-danger': $v.input.category_id.$error}">
                                <option v-for="category in categories" :value=category.id>{{ category.title }}</option>
                            </select>

                            <!--======================================================================================
                                V A L I D A T I O N     E R R O R   M E S S A G E S
                                ======================================================================================-->
                            <transition enterActiveClass="fade-in" leaveActiveClass="fade-out" mode="out-in">
                                <span class="text-danger" style="display: inline-block" 
                                v-if="!$v.input.category_id.required && $v.input.category_id.$dirty">
                                    Category is required
                                </span>
                            </transition>
                        </div>
                    </div>

                    <!--=========================================================================================
                        N A M A   S U B K A T E G O R I
                        =========================================================================================-->
                    <div class="col-sm-12 row">
                        <div class="col-sm-3 col-xs-12 d-flex align-items-center justify-content-end">
                            <label for="title"
                                   class="form-control-label panel-font-small m-0 font-weight-bold">
                                Subcategory Name
                            </label>
                        </div>
                        <div class="col-sm-9 col-xs-12">
                            <input id="title" type="text" class="form-control form-control-sm"
                            @keyup.enter="editSubcategory"
                            @input="$v.input.title.$touch()"
                            :class="{'form-control-danger': $v.input.title.$error}"
                            placeholder="Nama Subkategori" 
                            v-model="input.title">
                        </div>

                        <!--======================================================================================
                            V A L I D A T I O N     E R R O R   M E S S A G E S
                            ======================================================================================-->
                        <transition enterActiveClass="fade-in" leaveActiveClass="fade-out" mode="out-in">
                            <span key="title-required" class="offset-3 col-9 text-danger" 
                            v-if="!$v.input.title.required && $v.input.title.$dirty">
                                Subcategory Name is required
                            </span>
                            <span key="title-minimum" class="offset-3 col-9 text-danger" 
                            v-else-if="!$v.input.title.minLength">
                                Subcategory Name has a minimum of {{ $v.input.title.$params.minLength.min }} characters
                            </span>
                            <span  key="title-maximum" class="offset-3 col-9 text-danger" 
                            v-else-if="!$v.input.title.maxLength">
                                Subcategory Name has a maximum of {{ $v.input.title.$params.maxLength.max }} characters
                            </span>
                        </transition>
                    </div>

                    <!--=========================================================================================
                        A C T I O N   B U T T O N
                        =========================================================================================-->
                    <div class="col-sm-4 offset-3 d-flex justify-content-start mt-3 pl-2">

                        <!--=========================================================================================
                            C A N C E L   B U T T O N
                            =========================================================================================-->
                        <button type="button" 
                        class="btn btn-secondary btn-sm"
                        @click="closeEditForm">
                            Cancel
                        </button>

                        <!--=========================================================================================
                            S A V E   B U T T O N
                            =========================================================================================-->
                        <button @click="editSubcategory"
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
            subcategory: {
                type: [Object],
                default() {
                    return {}
                }
            }
        },

        data(){
            return {
                isRequesting: false,
                input: {
                    title: this.subcategory.title === '' ? '' : this.subcategory.title,
                    category_id: this.subcategory.category_id
                }
            }
        },

        validations: {
            input: {
                category_id: {
                    required
                },
                title: {
                    required,
                    minLength: minLength(3),
                    maxLength: maxLength(20),
                }
            }
        },

        computed: {

            ...mapGetters({
                categories: 'getCategories',
            }),

            subcategoryIsEdited(){
                return this.subcategory.title !== this.input.title 
                    || this.subcategory.category_id !== this.input.category_id ;
            },

            isFormFilled(){
                return this.input.title.length > 3 
                && this.input.title.length < 20
                && this.input.category_id !== '' 
                && this.input.category_id !== '';
            }
        },

        methods: {

            editSubcategory(){

                const self = this;

                if (this.subcategoryIsEdited && !this.isRequesting && this.isFormFilled) {

                    this.isRequesting = true;

                    const updatedSubcategory = {
                        id: this.subcategory.id,
                        title: this.input.title,
                        category_id: this.input.category_id,
                    };

                    this.$store.dispatch('update_subcategory', updatedSubcategory)

                        .then((updatedSubcategory) => {

                            flash('Sub Category updated', 'success');

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
        }
    };
</script>

<style scoped>
    .bg-grey {
        background: #fafafa;
    }

    .panel-font-small {
        font-size: 0.9rem;
    }
</style>