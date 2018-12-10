<template>
    <div class="row pt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="col-md-12 text-center">
                    <h3 class="text-center mb-5">
                        Add New Image for <strong>{{ itemName }}</strong>
                    </h3>
                </div>

                <div class="row">
                    <div class="col-md-4 text-center">
                        <transition appear enterActiveClass="fade-in-down" leaveActiveClass="fade-out-up">
                            <div class="panel" v-if="url != '' "> 
                                 <img :src="url" alt="">
                            </div>
                        </transition>

                        <div class="panel mt-2">
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
                            <div class="col-md-3 d-flex align-items-center justify-content-end">
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
                            <button type="button" role="button"class="btn btn-success" @click="uploadImage">
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

    export default{
        props: {
            itemName: {
                type: String
            }
        },
        
        data: function () {
            return{
                imageType: 1,
                isRequesting : false,
                image: '',
                title:'',
                is_poster:'',
                url: ''
                
            }
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

                this.url = URL.createObjectURL(files[0]);

                this.createImage(files[0]);
            },

            createImage(file){
                const reader = new FileReader();
                const self = this;

                reader.onload = (event) => {
                    self.image = event.target.result;
                };

                reader.readAsDataURL(file);
            },

            uploadImage(){

                const self = this;
                
                if(this.formIsFilled && !this.isRequesting){

                    this.isRequesting = true;

                    const imageData = {
                        image : this.image,
                        title : this.title,
                        shopId: this.shopId,
                        imageType: this.imageType
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
                    this.dirtyAllInputs();
                }
            },

            closeAdd(){
               this.$emit('closeAddImage',false);
            },

            dirtyAllInputs(){
                this.$v.title.$touch();
                this.$v.image.$touch();
            },

        },
    };
</script>

<style type="text/css">
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

    img{
        max-width: 180px;
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