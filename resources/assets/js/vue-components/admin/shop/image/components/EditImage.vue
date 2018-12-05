<template>
    <transition enterActiveClass="fade-in-down"
                leaveActiveClass="fade-out-up"
                mode="out-in">
        <div class="panel-default panel mt-3 pt-4 bg-grey" id="edit_image">
            <div class="panel-body">
                <h3 class="text-center">Edit <strong>{{ imageItem.title }}</strong> Image</h3>

                <div class="row pl-0 pr-0 m-0 pt-4 pb-4">
                    <div :class="colForPicture">
                        <div :id="'croppie-' + imageItem.id"></div>

                        <div class="panel panel-transparent text-center">
                            <input type="file"
                            accept="image/*"
                            :id="'file-edit-' + imageItem.id"
                            class="inputfile"
                            @change="setUpFileUploader">

                            <div class="col-md-12">
                                <div class="form-group text-center mb-3">
                                    <label>
                                        <input type="radio" :name="'orientation-' + imageItem.id" :value='1' v-model="imageType"> Tall
                                    </label>
                                    <label>
                                        <input type="radio" :name="'orientation-' + imageItem.id" :value='2' v-model="imageType" class="ml-2"> Square
                                    </label>
                                    <label>
                                        <input type="radio" name="'orientation-' + imageItem.id" :value='3' v-model="imageType" class="ml-2"> Wide
                                    </label>
                                </div>
                            </div>

                            <label :for="'file-edit-' + imageItem.id" class="btn btn-primary pt-1 pb-1 pr-2 pl-2">
                                <span>Browse Image</span>
                            </label>
                            <transition appear enterActiveClass="fade-in-down" leaveActiveClass="fade-out-up">
                                <p class="text-danger" v-if="!$v.input.image.required && $v.input.image.$dirty">
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
                                @keyup.enter="editImage"
                                @input="$v.input.title.$touch()"
                                :class="{'form-control-danger': $v.input.title.$error}"
                                placeholder="Image Name" 
                                v-model="input.title">

                            <!--======================================================================================
                                V A L I D A T I O N     E R R O R   M E S S A G E S
                                ======================================================================================-->
                                <transition appear enterActiveClass="fade-in-down" leaveActiveClass="fade-out-up">
                                    <span class="text-danger" v-if="!$v.input.title.required && $v.input.title.$dirty">
                                        Name is required
                                    </span>
                                    <span class="text-danger" v-if="!$v.input.title.minLength">
                                        Name has minimum of {{ $v.input.title.$params.minLength.min }} character
                                    </span>
                                    <span class="text-danger" v-if="!$v.input.title.maxLength">
                                        Name has maximum of {{ $v.input.title.$params.maxLength.max }} character
                                    </span>
                                </transition>

                            </div>
                        </div>

                        <div class="col-sm-4 offset-3 d-flex justify-content-start mt-3 pl-2">
                            <button type="button" class="btn btn-secondary btn-sm"@click="closeEditForm">
                                Cancel
                            </button>

                            <button @click="editImage"class="btn btn-success btn-sm ml-2">
                                Save
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
            imageItem: {
                type: [Object],
                default() {
                    return {}
                }
            }
        },

        data(){
            return {
                imageType: this.imageItem.imageType,
                isRequesting: false,
                save_image: '',
                input:{
                    title : this.imageItem.title,
                    image : this.imageItem.image_path,
                    description : this.imageItem.description,
                }
            }   
        },

        mounted(){
            this.setUpCroppie();
        },

        validations: {
            input: {
                title: {
                    required,
                    minLength: minLength(3),
                    maxLength: maxLength(30)
                },
                image:{
                    required,
                }
            },
        },


        computed: {
            imageIsEdited(){
                return this.imageItem.title !== this.input.title
                    || this.imageItem.imageType !== this.imageType
                    || this.imageItem.image_path !== this.input.image;
            },

            formIsFilled(){
                return this.input.title != '' 
                    && this.input.title.length >= 3
                    && this.input.title.length <= 30
                    && this.input.image != ''
            },

            colForPicture(){
                if(this.imageType == 1){
                    return 'col-md-4';
                }
                else if(this.imageType == 2){
                    return 'col-md-4';
                } 
                else if(this.imageType == 3){
                    return 'col-md-12 mb-4';
                }
            },

            colForData(){
                if(this.imageType == 1){
                    return 'col-md-8';
                }
                else if(this.imageType == 2){
                    return 'col-md-8';
                } 
                else if(this.imageType == 3){
                    return 'col-md-12';
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
                const self = this;

                reader.onload = (event) => {
                    self.input.image = event.target.result;
                    self.croppie.destroy();
                    self.setUpCroppie();
                };

                reader.readAsDataURL(file);
            },

            setUpCroppie(){
                const self = this;
                let file = document.getElementById('croppie-' + this.imageItem.id);

                if(this.imageType == 1){
                    this.croppie = new Croppie(file,{
                        viewport: {width: 160, height: 250, type: 'square'},
                        boundary: {width: 210, height: 300 },
                        enableOrientation: false
                    });
                }
                else if(this.imageType == 2){
                    this.croppie = new Croppie(file,{
                        viewport: {width: 240, height: 250, type: 'square'},
                        boundary: {width: 290, height: 300 },
                        enableOrientation: false
                    });
                }
                else if(this.imageType == 3) {
                    this.croppie = new Croppie(file,{
                        viewport: {width: 480, height: 250, type: 'square'},
                        boundary: {width: 530, height: 300 },
                        enableOrientation: false
                    });
                }

                if(this.input.image === null || this.input.image === ''){
                    if(this.imageType == 1){
                        this.croppie.bind({
                            url: '/img/portfolio-2.jpg'
                        });
                    }
                    else if(this.imageType == 2){
                        this.croppie.bind({
                            url: '/img/portfolio-2.jpg'
                        });
                    }
                    else if(this.imageType == 3){
                        this.croppie.bind({
                            url: '/img/portfolio-1.jpg'
                        });
                    }
                }else {
                    this.croppie.bind({
                        url: this.input.image
                    });
                }

                this.croppie.options.update = function(){
                    self.setImage();
                }
            },

            setImage(){
                const self = this;

                if(this.imageType == 1){
                    this.croppie.result({
                        type: 'canvas',
                        size: {witdh: 320, height: 500, type: 'square'},
                    }).then(response => {
                        self.save_image = response;
                    });
                }
                else if(this.imageType == 2){
                    this.croppie.result({
                        type: 'canvas',
                        size: {witdh: 480, height: 500, type: 'square'},
                    }).then(response => {
                        self.save_image = response;
                    });
                }
                else if(this.imageType == 3){
                    this.croppie.result({
                        type: 'canvas',
                        size: {witdh: 960, height: 500, type: 'square'},
                    }).then(response => {
                        self.save_image = response;
                    });
                }
            },


            editImage(){

                const self = this;

                if (this.imageIsEdited && !self.isRequesting && this.formIsFilled) {

                    this.isRequesting = true;

                    const updatedImage = {
                        id: this.imageItem.id,
                        title: this.input.title,
                        image: this.input.image === this.imageItem.image_path ? this.input.image : this.save_image,
                        is_poster: this.imageItem.is_poster,
                        imageType: this.imageType
                    };

                    this.$store.dispatch('update_image', updatedImage)

                        .then((updatedImage) => {

                            flash('Image item updated', 'success');

                            self.isRequesting = false;

                            self.closeEditForm();
                        })
                        .catch(errors => {
                            self.isRequesting = false;
                        });
                }else{
                    this.dirtyAllInputs();
                }
            },

            closeEditForm() {
                this.$emit('editionFormIsClosed', false);
            },

            dirtyAllInputs(){
                this.$v.input.title.$touch();
                this.$v.input.image.$touch();
            },
        },

        watch:{
            imageType(){
                this.input.image = '';
                this.croppie.destroy();
                this.setUpCroppie();
            }
        }
    };
</script>

<style>
    .croppie-container {
        height: unset !important;
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