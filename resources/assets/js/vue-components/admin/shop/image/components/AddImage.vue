<template>
    <div class="row pt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="col-md-12 text-center">
                    <h3 class="text-center font-weight-bold mb-5">
                        Add Image {{ itemName }}
                    </h3>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div id="croppie"></div>

                        <div class="panel panel-transparent text-center">
                            <input type="file"
                            accept="image/*"
                            id="file-2"
                            class="inputfile"
                            @change="setUpFileUploader">

                            <label for="file-2" class="btn btn-primary pt-1 pb-1 pr-2 pl-2">
                                <span>Browse Image</span>
                            </label>
                            <transition appear enterActiveClass="fade-in-down" leaveActiveClass="fade-out-up">
                                <p class="text-danger" v-if="!$v.image.required && $v.image.$dirty">
                                    Image is required
                                </p>
                            </transition>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-3 d-flex align-items-center">
                                <label class="m-0 pl-1" for="name">Name</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" v-model="title"
                                       @input="$v.title.$touch()"
                                       :class="{'form-control-danger': $v.title.$error}"
                                       class="form-control full-width" id="name">


                            <!--======================================================================================
                                V A L I D A T I O N     E R R O R   M E S S A G E S
                                ======================================================================================-->
                                <transition appear enterActiveClass="fade-in-down" leaveActiveClass="fade-out-up">
                                    <span class="text-danger" v-if="!$v.title.required && $v.title.$dirty">
                                        Name is required
                                    </span>
                                    <span class="text-danger" v-if="!$v.title.minLength">
                                        Name has minimum of {{ $v.title.$params.minLength.min }} character
                                    </span>
                                    <span class="text-danger" v-if="!$v.title.maxLength">
                                        Name has maximum of {{ $v.title.$params.maxLength.max }} character
                                    </span>
                                </transition>

                            </div>
                        </div>

                        <div class="col-sm-9 offset-3 d-flex justify-content-start mt-3 pl-2">
                            <button type="button" role="button"class="btn btn-success"@click="uploadImage">
                                Save
                            </button>

                            <button class="btn btn-danger ml-2"type="button" role="button" @click="closeAdd"> 
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</template>

<script>
    import {required, minLength, maxLength} from 'vuelidate/lib/validators';
    import {mapGetters} from 'vuex';
    import {Croppie} from 'croppie';

    export default{
        props: {
            itemName: {
                type: String
            }
        },
        
        data: function () {
            return{
                isRequesting : false,
                croppie: null,
                save_image:'',
                image: '',
                title:'',
                description:'',
                is_poster:'',
                
            }
        },

        mounted(){
            this.setUpCroppie();
        },

        validations: {
            title: {
                required,
                minLength: minLength(3),
                maxLength: maxLength(30)
            },
            image:{
                required
            }
        },

        computed:{
            ...mapGetters({
                shopId : 'getShopId'
            }),

            formIsFilled(){
                return this.image != '' 
                    && this.title != '' 
                    && this.title.length >= 3
                    && this.title.length <= 30
             }
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
                const self = this;

                reader.onload = (event) => {
                    self.image = event.target.result;
                    this.croppie.destroy();
                    this.setUpCroppie();
                };

                reader.readAsDataURL(file);
            },

            setUpCroppie(){
                const self = this;
                let file = document.getElementById('croppie');

                this.croppie = new Croppie(file,{
                    viewport: {width: 235, height: 300, type: 'square'},
                    boundary: {width: 285, height: 350 },
                    enableOrientation: false
                });

                if(this.image === null || this.image === ''){
                    this.croppie.bind({
                        url: '/img/welcome-1.jpg'
                    });
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

                this.croppie.result({
                    type: 'canvas',
                    size: {witdh: 470, height: 600, type: 'square'},
                }).then(response => {
                    self.save_image = response;
                });
            },

            uploadImage(){

                const self = this;
                
                if(this.formIsFilled && !this.isRequesting){

                    this.isRequesting = true;

                    const imageData = {
                        image : this.save_image,
                        title : this.title,
                        shopId: this.shopId
                    };

                    this.$store.dispatch('store_new_image', imageData)
                        .then((response) => {
                            flash('Image added','success');

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
                }else{
                    this.diryAllInputs();
                }
            },

            closeAdd(){
               this.$emit('closeAddImage',false);
            },

            diryAllInputs(){
                this.$v.title.$touch();
                this.$v.image.$touch();
            },

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
    .card {
        display: inline-block;
        width: 100%;
        padding: 36px 20px 26px 20px;
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