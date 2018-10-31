<template>
    <div class="card">


        <!--=========================================================================================
            S H O W   C R O P P I E
            =========================================================================================-->
        <div id="croppie"></div>


        <!--=========================================================================================
            I N P U T   I M A G E
            =========================================================================================-->
        <div class="panel panel-transparent" >
            <input type="file"
                   accept="image/*"
                   id="file-2"
                   class="inputfile"
                   @change="setUpFileUploader">

            <label for="file-2" class="btn btn-outline-primary">
                <span>Browse image</span>
            </label>

            <!--=========================================================================================
                B U T T O N   S A V E                =========================================================================================-->
            <button type="button" role="button"
                    class="btn btn-success"
                    @click="uploadImage">
                    Save
            </button>

            <!--=========================================================================================
                B U T T O N   C A N C E L
                =========================================================================================-->
            <button class="btn btn-danger"
                    type="button" role="button"
                    @click="closeAdd"> 
                    Cancel
            </button>
        </div>

        <!--=========================================================================================
            A C T I O N   B U T T O N
            =========================================================================================-->
        <div class="panel panel-transparent">
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
                image_show: '',
                image_points: '',
                image_ori: '',
                thumbnail: '',
                croppie: null,
                messageError : ''
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
                    vm.image_ori = event.target.result;
                    this.croppie.destroy();
                    this.setUpCroppie();
                };

                reader.readAsDataURL(file);
            },

            setUpCroppie(){
                const vm = this;
                let file = document.getElementById('croppie');

                this.croppie = new Croppie(file,{
                    viewport: {width: 800, height: 390, type: 'square'},
                    boundary: {width: 900, height: 450 },
                    enableOrientation: false
                });

                if(this.image_ori === null || this.image_ori === ''){
                    this.croppie.bind({
                        url: 'https://static.wixstatic.com/media/b77fe464cfc445da9003a5383a3e1acf.jpg'
                    });
                }else {
                    this.croppie.bind({
                        url: this.image_ori,
                    });
                }

                this.croppie.options.update = function() {
                    vm.setImage();
                };
            },

            setImage(){
                const vm  = this;

                this.croppie.result({
                    type: 'canvas',
                    size: {width: 1290, height: 880, type: 'square'},
                }).then(response => {
                    vm.image_show = response;
                });

                this.croppie.result({
                    type: 'canvas',
                    size: {width: 100, height: 100, type: 'square'},
                }).then(response => {
                    vm.thumbnail = response;
                });


                this.image_points = this.croppie.get().points;
            },

            uploadImage(){

                const vm  = this;
                
                if(this.image_ori !== null || this.image_ori !== ''){

                    this.isRequesting = true;
                    const imageFile = {
                        image_show : this.image_show,
                        image_ori : this.image_ori,
                        thumbnail : this.thumbnail,
                        image_points : JSON.stringify(vm.image_points)
                    };

                    this.$store.dispatch('store_image_slider', imageFile)
                        .then((response) => {
                            flash('Foto berhasil di tambahkan','success');

                            vm.isRequesting = false;

                            vm.closeAdd();
                        })
                        .catch((errors) => {
                            vm.isRequesting = false;

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