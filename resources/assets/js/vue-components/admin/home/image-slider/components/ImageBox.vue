<template>
    <div class="card">


        <!--=========================================================================================
            S H O W   C R O P P I E
            =========================================================================================-->
        <div id="croppie"></div>


        <!--=========================================================================================
            I N P U T   I M A G E
            =========================================================================================-->
        <div class="panel panel-transparent p-1 pb-4" style="text-align: center;">
            <input type="file"
                   accept="image/*"
                   id="file-2"
                   class="inputfile"
                   @change="setUpFileUploader">

            <label for="file-2" class="btn btn-outline-primary m-0">
                <span>Browse image</span>
            </label>

            <!--=========================================================================================
                B U T T O N                =========================================================================================-->
            <button type="button" role="button"
                    class="btn btn-success ml-3" :disabled="isRequesting"
                    @click="uploadImage">
                    <template v-if="!isRequesting">
                        Save
                    </template>
                    <template v-else="">
                          Please wait...                         
                    </template>
            </button>
            <button class="btn btn-danger"
                    :disabled="isRequesting"
                    type="button" role="button"
                    @click="closeAdd"> 
                    Cancel
            </button>
        </div>
    </div>
</template>

<script>
    import {Croppie} from 'croppie';

    export default{
        props:{
            dataUser : {}
        },

        data: function () {
            return{
                isRequesting : false,
                showPreview: false,
                croppie: null,
                image_show: '',
                image_points: '',
                image_ori: '',
                thumbnail: '',
            }
        },

        mounted(){
            this.setUpCroppie();
        },

        methods:{
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
                    self.image_ori = event.target.result;
                    this.croppie.destroy();
                    this.setUpCroppie();
                };

                reader.readAsDataURL(file);
            },

            setUpCroppie(){
                const self = this;
                let file = document.getElementById('croppie');

                this.croppie = new Croppie(file,{
                    viewport: {width: 768, height: 352, type: 'square'},
                    boundary: {width: 818, height: 402 },
                    enableOrientation: false
                });

                if(this.image_ori === null || this.image_ori === ''){
                    this.croppie.bind({
                        url: '/img/slider-1.jpg',
                    });
                }else {
                    this.croppie.bind({
                        url: this.image_ori,
                    });
                }

                this.croppie.options.update = function() {
                    self.setImage();
                };
            },

            setImage(){
                const self  = this;

                this.croppie.result({
                    type: 'canvas',
                    size: {width: 1920, height: 880, type: 'square'},
                }).then(response => {
                    self.image_show = response;
                });

                this.croppie.result({
                    type: 'canvas',
                    size: {width: 100, height: 100, type: 'square'},
                }).then(response => {
                    self.thumbnail = response;
                });


                this.image_points = this.croppie.get().points;
            },

            uploadImage(){

                const self = this;
                
                if(this.image_ori !== '' && !this.isRequesting){

                    this.isRequesting = true;
                    
                    const imageFile = {
                        image_show : this.image_show,
                        image_ori : this.image_ori,
                        thumbnail : this.thumbnail,
                        image_points : JSON.stringify(self.image_points)
                    };

                    this.$store.dispatch('store_image_slider', imageFile)
                        .then((response) => {

                            flash('Photo added','success');

                            self.isRequesting = false;

                            self.closeAdd();
                        })
                        .catch((errors) => {

                            self.isRequesting = false;

                            Object.keys(errors).forEach(field=> {
                                errors[field].forEach(message=> {
                                    flash(message, 'danger', 5000);
                                })
                            });
                        });
                }
            },

            closeAdd(){
               this.$emit('closeAddImage',false);
            }
        }
    };
</script>

<style scoped>
    #croppie.croppie-container {
        padding-top: 26px !important;
    }

    input[type='file']::-webkit-file-upload-button
    {
        color: #fff;
        background-color: #34495e;
        border: none;
        padding: 5px;
        border-radius: 5px;
    }
    .frame{
        border: 1px gainsboro solid;
        padding: 10px;
        margin-left: auto;
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