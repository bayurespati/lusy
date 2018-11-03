<template>
    <transition enterActiveClass="fade-in-down"
                leaveActiveClass="fade-out-up"
                mode="out-in">
        <div class="panel-default panel mt-3 pt-4 bg-grey" id="edit_category">
            <div class="panel-body">
                <h3 class="text-center font-weight-bold">Edit Kategori</h3>

                <div class="row pl-0 pr-0 m-0 pt-4 pb-4">


                    <!--=========================================================================================
                        N A M A
                        =========================================================================================-->
                    <div class="col-sm-12 row">
                        <div class="col-sm-3 col-xs-12 d-flex align-items-center justify-content-end">
                            <label for="title"
                                   class="form-control-label panel-font-small m-0 font-weight-bold">
                                Nama Kategori
                            </label>
                        </div>
                        <div class="col-sm-9 col-xs-12">
                            <input id="title"
                                   type="text"
                                   class="form-control form-control-sm"
                                   @keyup.enter="editCategory"
                                   placeholder="Nama Kategori" 
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
                        <button @click="editCategory"
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
    export default{
        props: {
            category: {
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
                    title: this.category.title === '' ? '' : this.category.title,
                }
            }
        },

        computed: {
            categoryIsEdited(){
                return this.category.title !== this.input.title;
            }
        },

        methods: {

            editCategory(){

                const self = this;

                if (this.categoryIsEdited && this.input.title.length > 3) {

                    this.isRequesting = true;

                    const updatedCategory = {
                        id: this.category.id,
                        title: this.input.title,
                    };

                    this.$store.dispatch('update_category', updatedCategory)

                        .then((updatedCategory) => {

                            flash('Category Berhasil diperbaharui', 'success');

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