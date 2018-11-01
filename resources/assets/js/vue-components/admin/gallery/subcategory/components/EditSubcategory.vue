<template>

    <transition enterActiveClass="fade-in-down"
                leaveActiveClass="fade-out-up"
                mode="out-in">

        <div class="panel-default panel mt-5" id="edit_subcategory">
            <div class="panel-body">
                <div class="row pl-0 pr-0 m-0 pt-4 pb-4 bg-grey">


                    <!--=========================================================================================
                        C A T E G O R Y
                        =========================================================================================-->
                    <div class="col-sm-12 row form-group">
                        <div class="col-sm-3 col-xs-12 d-flex align-items-center justify-content-end">
                            <label for="title"
                                   class="form-control-label panel-font-small m-0">
                                Category
                            </label>
                        </div>
                        <div class="col-sm-9 col-xs-12">
                            <select class="form-control" 
                                    id="category" 
                                    v-model="input.category_id">
                                <option v-for="category in categories" :value=category.id>{{ category.title }}</option>
                            </select>
                        </div>
                    </div>

                    <!--=========================================================================================
                        N A M A
                        =========================================================================================-->
                    <div class="col-sm-12 row form-group">
                        <div class="col-sm-3 col-xs-12 d-flex align-items-center justify-content-end">
                            <label for="title"
                                   class="form-control-label panel-font-small m-0">
                                Nama
                            </label>
                        </div>
                        <div class="col-sm-9 col-xs-12">
                            <input id="title"
                                   type="text"
                                   class="form-control form-control-sm"
                                   @keyup.enter="editSubcategory"
                                   v-model="input.title">
                        </div>
                    </div>

                    <!--=========================================================================================
                        A C T I O N   B U T T O N
                        =========================================================================================-->
                    <div class="col-sm-4 offset-3 d-flex justify-content-around mt-3">


                        <!--=========================================================================================
                            C A N C E L   B U T T O N
                            =========================================================================================-->
                        <div class="col-sm-6">
                            <button type="button" 
                                class="full-width btn btn-secondary btn-block btn-sm"
                                @click="closeEditForm">Batal</button>
                        </div>


                        <!--=========================================================================================
                            S A V E   B U T T O N
                            =========================================================================================-->
                        <div class="col-sm-6">
                            <button @click="editSubcategory"
                                    class="full-width btn btn-success btn-block btn-sm">
                                    Simpan
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </transition>

</template>

<script>
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

        computed: {

            ...mapGetters({
                categories: 'getCategories',
            }),

            subcategoryIsEdited(){
                return this.subcategory.title !== this.input.title 
                    || this.subcategory.category_id !== this.input.category_id ;
            }
        },

        methods: {

            editSubcategory(){

                const self = this;

                if (this.subcategoryIsEdited && this.input.title.length > 3) {

                    this.isRequesting = true;

                    const updatedSubcategory = {
                        id: this.subcategory.id,
                        title: this.input.title,
                        category_id: this.input.category_id
                    };

                    this.$store.dispatch('update_subcategory', updatedSubcategory)

                        .then((updatedSubcategory) => {

                            flash('Sub Category Berhasil diperbaharui', 'success');

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
    .pl-15-px {
        padding-left: 15px !important;
    }
</style>