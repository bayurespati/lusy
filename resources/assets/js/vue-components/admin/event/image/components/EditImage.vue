<template>
    <transition enterActiveClass="fade-in-down"
                leaveActiveClass="fade-out-up"
                mode="out-in">
        <div class="panel-default panel mt-3 pt-4 bg-grey" id="edit_image">
            <div class="panel-body">
                <h3 class="text-center">Edit <strong>{{ imageItem.title }}</strong> Image</h3>

                <div class="row pl-0 pr-0 m-0 pt-4 pb-4">
                    <div class="col-md-4">
                        <div :id="'croppie-' + imageItem.id"></div>

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
                                    Name
                                </label>
                            </div>

                            <div class="col-sm-9 col-xs-12">
                                <input id="title" type="text"
                                class="form-control form-control-sm"
                                @input="$v.input.title.$touch()"
                                @keyup.enter="editImage"
                                :class="{'form-control-danger': $v.input.title.$error}"
                                placeholder="Name"
                                v-model="input.title">

                                <!--======================================================================================
                                    V A L I D A T I O N     E R R O R   M E S S A G E S
                                    ======================================================================================-->
                                <transition enterActiveClass="fade-in" leaveActiveClass="fade-out" mode="out-in">
                                    <span key="name-required" class="text-danger" 
                                    v-if="!$v.input.title.required && $v.input.title.$dirty">
                                        Name is required
                                    </span>
                                    <span key="name-minimum" class="text-danger" v-else-if="!$v.input.title.minLength">
                                        Name has a minimum of {{ $v.input.title.$params.minLength.min }} characters
                                    </span>
                                    <span key="name-maximum" class="text-danger" v-else-if="!$v.input.title.maxLength">
                                        Name has a maximum {{ $v.input.title.$params.maxLength.max }} characters
                                    </span>
                                </transition>
                            </div>
                        </div>

                        <div class="col-sm-12 row form-group">
                            <div class="col-sm-3 col-xs-12 d-flex align-items-center justify-content-end">
                                <label for="title"
                                class="form-control-label panel-font-small m-0 font-weight-bold">
                                    Description
                                </label>
                            </div>

                            <div class="col-sm-9 col-xs-12">
                                <textarea  v-model="input.description" 
                                class="form-control form-control-sm" 
                                @keyup.enter="editImage"></textarea>
                            </div>
                        </div>

                        <div class="col-sm-4 offset-3 d-flex justify-content-start mt-3 pl-2">
                            <button type="button" class="btn btn-secondary btn-sm"@click="closeEditForm">
                                Cancel
                            </button>

                            <button @click="editImage"class="btn btn-success btn-sm ml-2" :disabled="isRequesting">
                                <template v-if="isRequesting">
                                    Saving..
                                </template>
                                <template v-else>
                                    Save
                                </template>
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
                isRequesting: false,
                save_image: '',
                input:{
                    title : this.imageItem.title,
                    image : this.imageItem.image_path,
                    description : this.imageItem.description === null ? '' : this.imageItem.description,
                }
            }   
        },

        mounted(){
            this.setUpCroppie();
        },

        validations: {
            input:{
                title: {
                    required,
                    minLength: minLength(3),
                    maxLength: maxLength(30)
                },
                description:{
                    minLength: minLength(3),
                    maxLength: maxLength(100)
                }                
            }
        },

        computed: {

            imageIsEdited(){
                return this.imageItem.title !== this.input.title
                    || this.imageItem.image_path !== this.input.image
                    || this.imageItem.description !== this.input.description;
            },

            formIsFilled(){
                return this.input.image != '' 
                    && this.input.title != '' 
                    && this.input.title.length >= 3
                    && this.input.title.length <= 50
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
                const setUpFileUploaderself = this;

                reader.onload = (event) => {
                    self.input.image = event.target.result;
                    this.croppie.destroy();
                    this.setUpCroppie();
                };

                reader.readAsDataURL(file);
            },

             setUpCroppie(){
                const self = this;
                let file = document.getElementById('croppie-' + this.imageItem.id);

                this.croppie = new Croppie(file,{
                    viewport: {width: 205, height: 200, type: 'square'},
                    boundary: {width: 255, height: 250 },
                    enableOrientation: false
                });

                if(this.input.image === null || this.input.image === ''){
                    this.croppie.bind({
                        url: '/img/events1.jpg'
                    });
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

                this.croppie.result({
                    type: 'canvas',
                    size: {witdh: 410, height:400, type: 'square'},
                }).then(response => {
                    self.save_image = response;
                });
            },


            editImage(){

                const self = this;

                if (this.imageIsEdited && this.formIsFilled && !this.isRequesting) {

                    this.isRequesting = true;

                    const updatedImage = {
                        id: this.imageItem.id,
                        title: this.input.title,
                        description: this.input.description,
                        image: this.input.image === this.imageItem.image_path ? this.input.image : this.save_image,
                        is_poster: this.imageItem.is_poster
                    };

                    this.$store.dispatch('update_image', updatedImage)

                        .then((updatedImage) => {

                            flash('Image is successfully updated', 'success');

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