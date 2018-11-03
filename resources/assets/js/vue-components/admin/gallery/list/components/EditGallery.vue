<template>
    <transition enterActiveClass="fade-in-down"
                leaveActiveClass="fade-out-up"
                mode="out-in">
        <div class="panel-default panel mt-3 pt-4 bg-grey" id="edit_gallery">
            <div class="panel-body">
                <h3 class="text-center font-weight-bold">Edit {{ galleryImage.title }}</h3>

                <div class="row pl-0 pr-0 m-0 pt-4 pb-4">
                    <div class="col-md-4">
                        <div :id="'croppie-' + galleryImage.id"></div>

                        <div class="panel panel-transparent text-center">
                            <input type="file"
                            accept="image/*"
                            id="file-2"
                            class="inputfile"
                            @change="setUpFileUploader">

                            <label for="file-2" class="btn btn-primary pt-1 pb-1 pr-2 pl-2">
                                <span>Browse Image</span>
                            </label>
                        </div>
                    </div>

                    <div class="col-md-8">
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
        </div>
    </transition>
</template>

<script>
    import {mapGetters} from 'vuex';
    import {Croppie} from 'croppie';

    export default{
        props: {
            galleryImage: {
                type: [Object],
                default() {
                    return {}
                }
            },
        },

        data(){
            return {
                isRequesting: false,
                title: this.galleryImage.title,
                date: this.galleryImage.date,
                location: this.galleryImage.location,
                creator: this.galleryImage.creator,
                sub_category_id: this.galleryImage.sub_category_id,
                croppie: null,
                image: this.galleryImage.image_path,
                save_image: ''
            }
        },

        mounted(){
            this.setUpCroppie();
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
                    || this.galleryImage.sub_category_id !== this.sub_category_id
                    || this.galleryImage.image_path !== this.image;
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

            setUpFileUploader(event){
                let files = event.target.files || event.dataTransfer.files;

                if(!files.length){
                    return
                }

                this.createImage(files[0]);
            },

            createImage(file){
                const reader = new FileReader();
                const vm  = this;

                reader.onload = (event) => {
                    vm.image = event.target.result;
                    this.croppie.destroy();
                    this.setUpCroppie();
                };

                reader.readAsDataURL(file);
            },

            setUpCroppie(){
                const vm = this;
                let file = document.getElementById('croppie-' + this.galleryImage.id);

                this.croppie = new Croppie(file,{
                    viewport: {width: 240, height: 250, type: 'square'},
                    boundary: {width: 290, height: 300 },
                    enableOrientation: false
                });

                if(this.image === null || this.image === ''){
                    this.croppie.bind({
                        url: 'https://static.wixstatic.com/media/b77fe464cfc445da9003a5383a3e1acf.jpg'
                    });
                }else {
                    this.croppie.bind({
                        url: this.image
                    });
                }

                this.croppie.options.update = function(){
                    vm.setImage();
                }
            },

            setImage(){
                const vm = this;

                this.croppie.result({
                    type: 'canvas',
                    size: {witdh: 480, height: 500, type: 'square'},
                }).then(response => {
                    vm.save_image = response;
                });
            },

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
                        image: this.image === this.galleryImage.image_path ? this.image : this.save_image
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

    input[type='file']::-webkit-file-upload-button
    {
        color: #fff;
        background-color: #34495e;
        border: none;
        padding: 5px;
        border-radius: 5px;
    }

    .inputfile {
        width: 0.1px;
        height: 0.1px;
        opacity: 0;
        overflow: hidden;
        position: absolute;
        z-index: -1; 
    }
    .inputfile + label {
        padding: 0.81rem 0.7692rem;
        display: inline-block;
        cursor: pointer; 
    }
    .inputfile + label i {
        margin-right: 10px; 
    }
</style>