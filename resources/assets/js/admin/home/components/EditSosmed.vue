<template>

    <transition enterActiveClass="fade-in-down"
                leaveActiveClass="fade-out-up"
                mode="out-in">

        <div class="panel-default panel mt-5" id="edit_jabapel">
            <div class="panel-body">
                <div class="row pl-0 pr-0 m-0 pt-4 pb-4 bg-grey">


                    <!--=========================================================================================
                        N A M A
                        =========================================================================================-->
                    <div class="col-sm-12 row form-group">
                        <div class="col-sm-3 col-xs-12 d-flex align-items-center justify-content-end">
                            <label for="nama"
                                   class="form-control-label panel-font-small m-0">
                                Link
                            </label>
                        </div>
                        <div class="col-sm-9 col-xs-12">
                            <input id="link"
                                   type="text"
                                   class="form-control form-control-sm"
                                   @keyup.enter="editSosmed"
                                   v-model="input.link">
                        </div>
                    </div>


                    <!--=========================================================================================
                        K O D E
                        =========================================================================================-->
                    <div class="col-sm-12 row form-group">
                        <div class="col-sm-3 d-flex align-items-center justify-content-end">
                            <label for="kode"
                                   class="form-control-label panel-font-small m-0">
                                Status
                            </label>
                        </div>
                        <div class="col-sm-9">
                            <input type="radio" :name=sosmed.id  value=1 v-model="input.is_active"> Aktif
                            <input type="radio" :name=sosmed.id  value=0 v-model="input.is_active" class="ml-2"> Tidak Aktif
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
                            <button @click="editSosmed"
                                    :class="{ disabled: !sosmedIsEdited, 'ld-ext-right': isRequesting }"
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
    export default{
        props: {
            sosmed: {
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
                    link: this.sosmed.link === '' ? '' : this.sosmed.link,
                    is_active: this.sosmed.is_active,
                }
            }
        },

        computed: {
            sosmedIsEdited(){
                return this.sosmed.link !== this.input.link
                    || this.sosmed.is_active != this.input.is_active;
            }
        },

        methods: {

            editSosmed(){

                const self = this;

                if (this.sosmedIsEdited) {

                    this.isRequesting = true;

                    const updatedSosmed = {
                        id: this.sosmed.id,
                        link: this.input.link,
                        is_active: this.input.is_active,
                    };

                    this.$store.dispatch('update_sosmed', updatedSosmed)                        

                        .then((updatedSosmed) => {

                            flash('Sosial media Berhasil diperbaharui', 'success');

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
    .pl-15-px {
        padding-left: 15px !important;
    }
</style>