<template>

    <transition enterActiveClass="fade-in-down"
                leaveActiveClass="fade-out-up"
                mode="out-in">

        <div class="panel-default panel mt-3 pt-4 bg-grey" id="edit_subcategory">
            <div class="panel-body">
                <h3 class="text-center font-weight-bold">Edit Subkategori</h3>

                <div class="row pl-0 pr-0 m-0 pt-4 pb-4">


                    <!--=========================================================================================
                        C A T E G O R Y
                        =========================================================================================-->
                    <div class="col-sm-12 row mb-2">
                        <div class="col-sm-3 col-xs-12 d-flex align-items-center justify-content-end">
                            <label for="title"
                                   class="form-control-label panel-font-small m-0 font-weight-bold">
                                Nama Kategori
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
                        N A M A   S U B K A T E G O R I
                        =========================================================================================-->
                    <div class="col-sm-12 row">
                        <div class="col-sm-3 col-xs-12 d-flex align-items-center justify-content-end">
                            <label for="title"
                                   class="form-control-label panel-font-small m-0 font-weight-bold">
                                Nama Subkategori
                            </label>
                        </div>
                        <div class="col-sm-9 col-xs-12">
                            <input id="title"
                                   type="text"
                                   class="form-control form-control-sm"
                                   @keyup.enter="editSubcategory"
                                   placeholder="Nama Subkategori" 
                                   v-model="input.title">
                        </div>
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
                            Batal
                        </button>


                        <!--=========================================================================================
                            S A V E   B U T T O N
                            =========================================================================================-->
                        <button @click="editSubcategory"
                                class="btn btn-success btn-sm ml-2">
                            Simpan
                        </button>
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
                        category_id: this.input.category_id,
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
    .bg-grey {
        background: #fafafa;
    }

    .panel-font-small {
        font-size: 0.9rem;
    }
</style>