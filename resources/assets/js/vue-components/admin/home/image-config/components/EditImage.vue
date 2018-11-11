<template>
    <transition enterActiveClass="fade-in"leaveActiveClass="fade-out"mode="out-in">
    <div class="card mt-5">

        <!--=========================================================================================
            S H O W   C R O P P I E
            =========================================================================================-->
        <div :id=" 'croppie-config-'+imageConfig.id "></div>


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
                B U T T O N   S A V E                =========================================================================================-->
            <button type="button" role="button"
                    class="btn btn-success ml-3"
                    @click="editImage">
                    Simpan
            </button>

            <!--=========================================================================================
                B U T T O N   C A N C E L
                =========================================================================================-->
            <button class="btn btn-danger"
                    type="button" role="button"
                    @click="closeEditForm"> 
                    Batal
            </button>
        </div>

        <!--=========================================================================================
            A C T I O N   B U T T O N
            =========================================================================================-->
        <div class="panel panel-transparent">
        </div>
    </div>
    </transition>
</template>

<script>
    import {Croppie} from 'croppie';
    import {mapGetters} from 'vuex';    

    export default {

    props:{imageConfig:{}},

    data(){
        return{
            croppie: null,
            image: this.imageConfig.image_path,
            save_image: '',
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
            let file = document.getElementById('croppie-config-'+this.imageConfig.id);

            if(this.imageConfig.page_name === 'Home'){
                this.croppie = new Croppie(file,{
                    viewport: {width: 576, height: 263 },
                    boundary: {width: 626, height: 313 },
                    enableOrientation: false,
                });
            }else{
                this.croppie = new Croppie(file,{
                    viewport: {width: 576, height: 81 },
                    boundary: {width: 626, height: 131 },
                    enableOrientation: false,
                });
            }

            let imageBcg = this.imageConfig.page_name === 'Home' 
            ? '/img/upcoming-event-bg.jpg'
            : '/img/page-banner-bg.jpg'
            
            
            if(this.image === null || this.image === ''){
                this.croppie.bind({
                    url: imageBcg
                });
            }else {
                this.croppie.bind({
                    url: this.image
                });
            }

            this.croppie.options.update = function() {
                vm.setImage();
            };
        },

        setImage(){
            const vm  = this;

            if(this.imageConfig.page_name === 'Home'){
                this.croppie.result({
                    type: 'canvas',
                    size: {width: 1920, height: 876, type: 'square'},
                }).then(response => {
                    vm.save_image = response;
                });
            }else{
                this.croppie.result({
                    type: 'canvas',
                    size: {width: 1920, height: 270, type: 'square'},
                }).then(response => {
                    vm.save_image = response;
                });
            }
        },

        editImage(){

            const vm = this;

            if (this.image != this.imageConfig.image_path) {

                const updatedImage = {
                    id: this.imageConfig.id,
                    image: this.save_image
                };

                this.$store.dispatch('update_image', updatedImage)                        

                    .then((updatedImage) => {
                        flash('Image Berhasil diperbaharui', 'success');
                        vm.closeEditForm();
                    })
                    .catch(errors => {});
              }
          },

        closeEditForm() {
            this.$emit('editionFormIsClosed', false);
        }
    },
};
</script>

<style type="text/css">
    .croppie-container {
        height: unset;
    }
</style>

<style scoped>
    .bg-grey {
        background: #fafafa;
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