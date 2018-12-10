<template>
    <div class="card">


        <!--=========================================================================================
            S H O W   C R O P P I E
            =========================================================================================-->
            <transition appear enterActiveClass="fade-in-down" leaveActiveClass="fade-out-up">
                <div class="panel mt-5" v-if="url != ''" style="text-align: center;">
                    <img :src="url" alt="">
                </div>
            </transition>


        <!--=========================================================================================
            I N P U T   I M A G E
            =========================================================================================-->
        <div class="panel panel-transparent p-1 pb-4 mt-3" style="text-align: center;">
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
                image: '',
                url: ''
            }
        },

        methods:{
            setUpFileUploader(event){
                let files = event.target.files || event.dataTransfer.files;

                if(!files.length){
                    return
                }

                this.url = URL.createObjectURL(files[0]);

                this.createImage(files[0]);
            },

            createImage(file){
                const reader = new FileReader();
                const self  = this;

                reader.onload = (event) => {
                    self.image = event.target.result;
                };

                reader.readAsDataURL(file);
            },

            uploadImage(){

                const self = this;
                
                if(this.image !== '' && !this.isRequesting){

                    this.isRequesting = true;
                    
                    const imageFile = {
                        image : this.image                        
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

    img{
        max-width: 300px;
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