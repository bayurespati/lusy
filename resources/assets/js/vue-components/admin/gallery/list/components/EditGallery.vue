<template>
    <transition enterActiveClass="fade-in-down"
                leaveActiveClass="fade-out-up"
                mode="out-in">
        <div class="panel-default panel mt-3 pt-4 bg-grey" id="edit_gallery">
            <div class="panel-body">
                <h3 class="text-center">Edit <strong>{{ galleryImage.title }}</strong></h3>

                <div class="row pl-0 pr-0 m-0 pt-4 pb-4">
                    <div :class="colForPicture">
                        <div :id="'croppie-' + galleryImage.id"></div>

                        <div class="panel panel-transparent text-center">
                            <input type="file"
                            accept="image/*"
                            id="file-2"
                            class="inputfile"
                            @change="setUpFileUploader">

                            <div class="col-md-12">
                                <div class="form-group text-center mb-3">
                                    <label>
                                        <input type="radio" :name="'orientation-' + galleryImage.id" value='false' v-model="isWide"> Square
                                    </label>
                                    <label>
                                        <input type="radio" :name="'orientation-' + galleryImage.id" value='true' v-model="isWide" class="ml-2"> Wide
                                    </label>
                                </div>
                            </div>

                            <label for="file-2" class="btn btn-primary pt-1 pb-1 pr-2 pl-2">
                                <span>Browse Image</span>
                            </label>
                            <transition enterActiveClass="fade-in" leaveActiveClass="fade-out" mode="out-in">
                                <p key="image-required" class="text-danger" 
                                v-if="!$v.image.required && $v.image.$dirty">
                                    Image is required
                                </p>
                            </transition>
                        </div>
                    </div>

                    <div :class="colForData">
                        <div class="col-sm-12 row form-group">
                            <div class="col-sm-3 col-xs-12 d-flex align-items-center justify-content-end">
                                <label for="title"class="form-control-label panel-font-small m-0 font-weight-bold">
                                    Name
                                </label>
                            </div>

                            <div class="col-sm-9 col-xs-12">
                                <input id="title" type="text"
                                class="form-control form-control-sm"
                                @input="$v.title.$touch()"
                                :class="{'form-control-danger': $v.title.$error}"
                                @keyup.enter="editGallery"
                                placeholder="Nama Gambar" 
                                v-model="title">
                            <!--======================================================================================
                                V A L I D A T I O N     E R R O R   M E S S A G E S
                                ======================================================================================-->
                                <transition enterActiveClass="fade-in" leaveActiveClass="fade-out" mode="out-in">
                                    <span key="title-required" class="text-danger" 
                                    v-if="!$v.title.required && $v.title.$dirty">
                                        Title is required
                                    </span>
                                    <span key="title-minimum" class="text-danger" 
                                    v-if="!$v.title.minLength">
                                        Title has a minimum of {{ $v.title.$params.minLength.min }} characters
                                    </span>
                                    <span key="title-maximum" class="text-danger" v-if="!$v.title.maxLength">
                                        Title has a maximum of {{ $v.title.$params.maxLength.max }} characters
                                    </span>
                                </transition>
                            </div>
                        </div>

                        <div class="col-sm-12 row form-group">
                            <div class="col-sm-3 col-xs-12 d-flex align-items-center justify-content-end">
                                <label for="date"class="form-control-label panel-font-small m-0 font-weight-bold">
                                    Date
                                </label>
                            </div>
                            <div class="col-sm-9 col-xs-12">
                                <datetime v-model="date" :class="{'form-control-danger': $v.date.$error}" value-zone="local"></datetime>
                            <!--======================================================================================
                                V A L I D A T I O N     E R R O R   M E S S A G E S
                                ======================================================================================-->                                
                                <transition enterActiveClass="fade-in" leaveActiveClass="fade-out" mode="out-in">
                                    <span key="date-required" class="text-danger" v-if="!$v.date.required && $v.date.$dirty">
                                        Date is required
                                    </span>
                                </transition>
                            </div>
                        </div>

                        <div class="col-sm-12 row form-group">
                            <div class="col-sm-3 col-xs-12 d-flex align-items-center justify-content-end">
                                <label for="location"
                                class="form-control-label panel-font-small m-0 font-weight-bold">
                                    Location
                                </label>
                            </div>
                            <div class="col-sm-9 col-xs-12">
                                <input id="location" type="text"
                                class="form-control form-control-sm"
                                @keyup.enter="editGallery"
                                @input="$v.location.$touch()"
                                :class="{'form-control-danger': $v.location.$error}"
                                placeholder="Lokasi Gambar"
                                v-model="location">

                            <!--======================================================================================
                                V A L I D A T I O N     E R R O R   M E S S A G E S
                                ======================================================================================-->
                                <transition enterActiveClass="fade-in" leaveActiveClass="fade-out" mode="out-in">
                                    <span key="location-minimum" class="text-danger" v-if="!$v.location.minLength">
                                        Location has a minimum of {{ $v.location.$params.minLength.min }} characters
                                    </span>
                                    <span key="location-maximum" class="text-danger" v-if="!$v.location.maxLength">
                                        Location has a maximum of {{ $v.location.$params.maxLength.max }} characters
                                    </span>
                                </transition>
                            </div>
                        </div>

                        <div class="col-sm-12 row form-group">
                            <div class="col-sm-3 col-xs-12 d-flex align-items-center justify-content-end">
                                <label for="creator"
                                class="form-control-label panel-font-small m-0 font-weight-bold">
                                    Creator
                                </label>
                            </div>
                            <div class="col-sm-9 col-xs-12">
                                <input id="creator" type="text"
                                class="form-control form-control-sm"
                                @input="$v.creator.$touch()"
                                :class="{'form-control-danger': $v.creator.$error}"
                                @keyup.enter="editGallery"
                                placeholder="Dibuat Oleh" 
                                v-model="creator">

                            <!--======================================================================================
                                V A L I D A T I O N     E R R O R   M E S S A G E S
                                ======================================================================================-->
                                <transition enterActiveClass="fade-in" leaveActiveClass="fade-out" mode="out-in">
                                    <span key="creator-minimum" class="text-danger" v-if="!$v.creator.minLength">
                                        Creator has a minimum of {{ $v.creator.$params.minLength.min }} characters
                                    </span>
                                    <span key="creator-maximum" class="text-danger" v-if="!$v.creator.maxLength">
                                        Creator has a maximum of {{ $v.creator.$params.maxLength.max }} characters
                                    </span>
                                </transition>
                            </div>
                        </div>

                        <div class="col-sm-12 row">
                            <div class="col-sm-3 col-xs-12 d-flex align-items-center justify-content-end">
                                <label for="subcategory"
                                class="form-control-label panel-font-small m-0 font-weight-bold">
                                    Subcategory
                                </label>
                            </div>
                            <div class="col-sm-9 col-xs-12">
                                <select class="form-control" id="subcategory"
                                        :class="{'form-control-danger': $v.sub_category_id.$error}"
                                        v-model="sub_category_id">
                                    <option v-for="subcategory in subcategories" 
                                            :value=subcategory.id> {{ subcategory.title }}
                                    </option>
                                </select>

                            <!--======================================================================================
                                V A L I D A T I O N     E R R O R   M E S S A G E S
                                ======================================================================================-->                                
                                <transition enterActiveClass="fade-in" leaveActiveClass="fade-out" mode="out-in">
                                    <span key="subcategory-required" class="text-danger" v-if="!$v.sub_category_id.required && $v.sub_category_id.$dirty">
                                        Subcategory is required
                                    </span>
                                </transition>
                            </div>
                        </div>

                        <div class="col-sm-4 offset-3 d-flex justify-content-start mt-3 pl-2">
                            <button type="button" class="btn btn-secondary btn-sm"@click="closeEditForm">
                                Cancel
                            </button>

                            <button @click="editGallery" class="btn btn-success btn-sm ml-2" :disabled="isRequesting">
                                <template v-if="isRequesting">Saving..</template>
                                <template v-else>Save</template>
                            </button>
                        </div>
                    </div>    
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
    import {required, minLength, maxLength} from 'vuelidate/lib/validators';
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
                isWide: this.galleryImage.is_wide,
                title: this.galleryImage.title,
                date: this.galleryImage.date,
                location: this.galleryImage.location === null ? '' : this.galleryImage.location,
                creator: this.galleryImage.creator === null ? '' : this.galleryImage.creator,
                sub_category_id: this.galleryImage.sub_category_id,
                croppie: null,
                image: this.galleryImage.image_path,
                save_image: ''
            }
        },

        mounted(){
            this.setUpCroppie();
        },

        validations: {
            title: {
                required,
                minLength: minLength(3),
                maxLength: maxLength(50)
            },
            location:{
                minLength: minLength(3),
                maxLength: maxLength(50)
            },
            sub_category_id:{
                required
            },
            date:{
                required
            },
            creator:{
                minLength: minLength(3),
                maxLength: maxLength(30)
            },
            image:{
                required
            }
        },

        computed: {
            ...mapGetters({
                categories: 'getCategories'
            }),

            galleryIsEdited(){
                return this.galleryImage.title !== this.title 
                    || this.galleryImage.is_wide !== this.isWide
                    || this.galleryImage.date !== this.date.substring(0,10)
                    || this.galleryImage.location !== this.location
                    || this.galleryImage.creator !== this.creator
                    || this.galleryImage.sub_category_id !== this.sub_category_id
                    || this.galleryImage.image_path !== this.image;
            },

            formIsFilled(){
                return this.image != '' 
                    && this.sub_category_id != '' 
                    && this.date != ''
                    && this.title != '' && this.title.length >= 3 && this.title.length <= 50
                    && ( this.location == '' || (this.location.length >= 3 && this.location.length <= 50) )
                    && ( this.creator == '' || (this.creator.length >= 3 && this.creator.length <= 30) )
             },

            subcategories(){
                for(let a = 0; a < this.categories.length; a++){
                    for(let b = 0; b < this.categories[a].subcategories.length; b++){
                        if(this.categories[a].subcategories[b].id === this.galleryImage.sub_category_id ){
                            return this.categories[a].subcategories;
                        }
                    }
                }
            },

            colForPicture(){
                return this.isWide
                ? 'col-md-12 mb-4'
                : 'col-md-4'
             },

             colForData(){
                return this.isWide
                ? 'col-md-12'
                : 'col-md-8'
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
                const self  = this;

                reader.onload = (event) => {
                    self.image = event.target.result;
                    this.croppie.destroy();
                    this.setUpCroppie();
                };

                reader.readAsDataURL(file);
            },

            setUpCroppie(){
                const self = this;
                let file = document.getElementById('croppie-' + this.galleryImage.id);

                if(this.isWide){
                    this.croppie = new Croppie(file,{
                        viewport: {width: 480, height: 250, type: 'square'},
                        boundary: {width: 530, height: 300 },
                        enableOrientation: false
                    });
                }
                else {
                    this.croppie = new Croppie(file,{
                        viewport: {width: 240, height: 250, type: 'square'},
                        boundary: {width: 290, height: 300 },
                        enableOrientation: false
                    });
                }

                if(this.image === null || this.image === ''){
                    if(this.isWide){
                        this.croppie.bind({
                            url: '/img/portfolio-1.jpg'
                        });
                    }
                    else {
                        this.croppie.bind({
                            url: '/img/portfolio-2.jpg'
                        });
                    }
                }else {
                    this.croppie.bind({
                        url: this.image
                    });
                }

                this.croppie.options.update = function(){
                    self.setImage();
                }
            },

            setImage(){
                const self = this;

                if(this.isWide){
                    this.croppie.result({
                        type: 'canvas',
                        size: {witdh: 960, height: 500, type: 'square'},
                    }).then(response => {
                        self.save_image = response;
                    });
                }
                else {
                    this.croppie.result({
                        type: 'canvas',
                        size: {witdh: 480, height: 500, type: 'square'},
                    }).then(response => {
                        self.save_image = response;
                    });
                }
            },

            editGallery(){

                const self = this;

                if (this.galleryIsEdited && this.formIsFilled && !self.isRequesting) {

                    this.isRequesting = true;

                    const updatedGallery = {
                        id: this.galleryImage.id,
                        title: this.title,
                        date: this.date.substring(0,10),
                        location: this.location,
                        creator: this.creator,
                        sub_category_id: this.sub_category_id,
                        image: this.image === this.galleryImage.image_path ? this.image : this.save_image,
                        isWide: this.isWide
                    };

                    this.$store.dispatch('update_galllery', updatedGallery)

                        .then((updatedGallery) => {

                            flash('Image updated', 'success');

                            self.isRequesting = false;

                            self.closeEditForm();
                        })
                        .catch(errors => {
                            self.isRequesting = false;
                        });
                }else{
                    this.diryAllInputs();
                }
            },

            closeEditForm() {
                this.$emit('editionFormIsClosed', false);
            },

            diryAllInputs(){
                this.$v.title.$touch();
                this.$v.date.$touch();
                this.$v.sub_category_id.$touch();
                this.$v.image.$touch();
            },
        },

        watch: {
            isWide(){
                if(this.isWide == 'false') {
                    this.isWide = false;
                    this.image = '';
                    this.croppie.destroy();
                    this.setUpCroppie();
                }
                else if(this.isWide == 'true') {
                    this.isWide = true;
                    this.image = '';
                    this.croppie.destroy();
                    this.setUpCroppie();
                }
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