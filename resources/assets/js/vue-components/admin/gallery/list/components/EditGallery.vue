<template>
    <transition enterActiveClass="fade-in-down"
                leaveActiveClass="fade-out-up"
                mode="out-in">
        <div class="panel-default panel mt-3 pt-4 bg-grey" id="edit_gallery">
            <div class="panel-body">
                <h3 class="text-center font-weight-bold">Edit Gambar</h3>

                <div class="row pl-0 pr-0 m-0 pt-4 pb-4">


                    <!--=========================================================================================
                        N A M A
                        =========================================================================================-->
                    <div class="col-sm-12 row form-group">
                        <div class="col-sm-3 col-xs-12 d-flex align-items-center justify-content-end">
                            <label for="title"
                                   class="form-control-label panel-font-small m-0 font-weight-bold">
                                Nama
                            </label>
                        </div>
                        <div class="col-sm-9 col-xs-12">
                            <input id="title"
                                   type="text"
                                   class="form-control form-control-sm"
                                   @keyup.enter="editGallery"
                                   placeholder="Nama Gambar" 
                                   v-model="title">
                        </div>
                    </div>


                    <!--=========================================================================================
                        D A T E
                        =========================================================================================-->
                    <div class="col-sm-12 row form-group">
                        <div class="col-sm-3 col-xs-12 d-flex align-items-center justify-content-end">
                            <label for="date"
                                   class="form-control-label panel-font-small m-0 font-weight-bold">
                                Tanggal
                            </label>
                        </div>
                        <div class="col-sm-9 col-xs-12">
                            <datetime v-model="date" value-zone="local"></datetime>
                        </div>
                    </div>


                    <!--=========================================================================================
                        L O C A T I O N
                        =========================================================================================-->
                    <div class="col-sm-12 row form-group">
                        <div class="col-sm-3 col-xs-12 d-flex align-items-center justify-content-end">
                            <label for="location"
                                   class="form-control-label panel-font-small m-0 font-weight-bold">
                                Lokasi
                            </label>
                        </div>
                        <div class="col-sm-9 col-xs-12">
                            <input id="location"
                                   type="text"
                                   class="form-control form-control-sm"
                                   @keyup.enter="editGallery"
                                   placeholder="Lokasi Gambar" 
                                   v-model="location">
                        </div>
                    </div>


                    <!--=========================================================================================
                        C R E A T O R
                        =========================================================================================-->
                    <div class="col-sm-12 row form-group">
                        <div class="col-sm-3 col-xs-12 d-flex align-items-center justify-content-end">
                            <label for="creator"
                                   class="form-control-label panel-font-small m-0 font-weight-bold">
                                Dibuat Oleh
                            </label>
                        </div>
                        <div class="col-sm-9 col-xs-12">
                            <input id="creator"
                                   type="text"
                                   class="form-control form-control-sm"
                                   @keyup.enter="editGallery"
                                   placeholder="Dibuat Oleh" 
                                   v-model="creator">
                        </div>
                    </div>


                    <!--=========================================================================================
                        C R E A T O R
                        =========================================================================================-->
                    <div class="col-sm-12 row">
                        <div class="col-sm-3 col-xs-12 d-flex align-items-center justify-content-end">
                            <label for="subcategory"
                                   class="form-control-label panel-font-small m-0 font-weight-bold">
                                Subkategori
                            </label>
                        </div>
                        <div class="col-sm-9 col-xs-12">
                            <select class="form-control" id="subcategory" v-model="sub_category_id"> 
                                <option v-for="subcategory in subcategories" 
                                        :value=subcategory.id> {{ subcategory.title }}
                                </option>
                            </select>
                        </div>
                    </div>


                    <!--=========================================================================================
                        A C T I O N   B U T T O N
                        =========================================================================================-->
                    <div class="col-sm-4 offset-3 d-flex justify-content-start mt-3 pl-2">
                        <button type="button" 
                        class="btn btn-secondary btn-sm"
                        @click="closeEditForm">
                            Batal
                        </button>

                        <button @click="editGallery"
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
            galleryImage: {
                type: [Object],
                default() {
                    return {}
                }
            }
        },

        data(){
            return {
                isRequesting: false,
                title: this.galleryImage.title,
                date: this.galleryImage.date,
                location: this.galleryImage.location,
                creator: this.galleryImage.creator,
                sub_category_id: this.galleryImage.sub_category_id
            }
        },

        computed: {
            ...mapGetters({
                categories: 'getCategories'
            }),

            galleryIsEdited(){
                return this.galleryImage.title !== this.title 
                    || this.galleryImage.date !== this.date.substring(0,10)
                    || this.galleryImage.location !== this.location
                    || this.galleryImage.creator !== this.creator
                    || this.galleryImage.sub_category_id !== this.sub_category_id;
            },

            subcategories(){
                for(let a = 0; a < this.categories.length; a++){
                    for(let b = 0; b < this.categories[a].subcategories.length; b++){
                        if(this.categories[a].subcategories[b].id === this.galleryImage.sub_category_id ){
                            return this.categories[a].subcategories;
                        }
                    }
                }
            }
        },

        methods: {

            editGallery(){

                const self = this;

                if (this.galleryIsEdited) {

                    this.isRequesting = true;

                    const updatedGallery = {
                        id: this.galleryImage.id,
                        title: this.title,
                        date: this.date.substring(0,10),
                        location: this.location,
                        creator: this.creator,
                        sub_category_id: this.sub_category_id,
                    };

                    this.$store.dispatch('update_galllery', updatedGallery)

                        .then((updatedGallery) => {

                            flash('Gallery Berhasil diperbaharui', 'success');

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

<style type="text/css">
    .croppie-container {
        height: unset;
    }

    .croppie-container .cr-slider-wrap {
        margin: 15px auto 5px auto;
    }

    .vdatetime-input {
        width: 100%;
        padding: .375rem .75rem;
        line-height: 1.5;
        font-size: 1rem;
        color: #495057;
        border-radius: .25rem;
        border: 1px solid #ced4da;
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