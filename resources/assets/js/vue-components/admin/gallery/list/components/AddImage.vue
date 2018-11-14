<template>
    <div class="row pt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="col-md-12 text-center">
                    <h3 class="text-center font-weight-bold mb-5">Add Image Gallery</h3>
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
                                        Title is required
                                    </span>
                                    <span class="text-danger" v-if="!$v.title.minLength">
                                        Title has minimum of {{ $v.title.$params.minLength.min }} character
                                    </span>
                                    <span class="text-danger" v-if="!$v.title.maxLength">
                                        Title has maximum of {{ $v.title.$params.maxLength.max }} character
                                    </span>
                                </transition>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-3 d-flex align-items-center">
                                <label class="m-0 pl-1" for="date">Date</label>
                            </div>
                            <div class="col-md-9">
                                <datetime type="date" v-model="date"
                                          :class="{'form-control-danger': $v.date.$error}"
                                          class="full-width"></datetime>

                            <!--======================================================================================
                                V A L I D A T I O N     E R R O R   M E S S A G E S
                                ======================================================================================-->                                
                                <transition appear enterActiveClass="fade-in-down" leaveActiveClass="fade-out-up">
                                    <span class="text-danger" v-if="!$v.date.required && $v.date.$dirty">
                                        Date is required
                                    </span>
                                </transition>

                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-3 d-flex align-items-center">
                                <label class="m-0 pl-1" for="lokasi">Location</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" v-model="location"
                                       @input="$v.location.$touch()"
                                       :class="{'form-control-danger': $v.location.$error}"
                                       class="form-control full-width" id="lokasi">

                            <!--======================================================================================
                                V A L I D A T I O N     E R R O R   M E S S A G E S
                                ======================================================================================-->
                                <transition appear enterActiveClass="fade-in-down" leaveActiveClass="fade-out-up">
                                    <span class="text-danger" v-if="!$v.location.minLength">
                                        Location has minimum of {{ $v.location.$params.minLength.min }} character
                                    </span>
                                    <span class="text-danger" v-if="!$v.location.maxLength">
                                        Location has maximum of {{ $v.location.$params.maxLength.max }} character
                                    </span>
                                </transition>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-3 d-flex align-items-center">
                                <label class="m-0 pl-1" for="creator">Creator</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" v-model="creator"
                                        @input="$v.creator.$touch()"
                                       :class="{'form-control-danger': $v.creator.$error}"
                                       class="form-control full-width" id="creator">

                            <!--======================================================================================
                                V A L I D A T I O N     E R R O R   M E S S A G E S
                                ======================================================================================-->
                                <transition appear enterActiveClass="fade-in-down" leaveActiveClass="fade-out-up">
                                    <span class="text-danger" v-if="!$v.creator.minLength">
                                        Creator has minimum of {{ $v.creator.$params.minLength.min }} character
                                    </span>
                                    <span class="text-danger" v-if="!$v.creator.maxLength">
                                        Creator has Maximum of {{ $v.creator.$params.maxLength.max }} character
                                    </span>
                                </transition>

                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-3 d-flex align-items-center">
                                <label class="m-0 pl-1" for="category">Category</label>
                            </div>      
                            <div class="col-md-9">
                                <select class="form-control full-width" id="category" v-model="subcategories">
                                    <option value="" disabled>Choose Category</option>
                                    <option v-for="category in categories" 
                                            :value=category.subcategories>{{ category.title }}
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-3 d-flex align-items-center">
                                <label class="m-0 pl-1" for="subcategory">subcategory</label>
                            </div>
                            <div class="col-md-9">
                                <select class="form-control full-width" id="subcategory" 
                                        :class="{'form-control-danger': $v.sub_category_id.$error}"
                                        v-model="sub_category_id" @input="$v.sub_category_id.$touch()">
                                    <option value="" disabled>Choose Subcategory</option>
                                    <option v-for="subcategory in subcategories" 
                                            :value=subcategory.id>{{ subcategory.title }}
                                    </option>
                                </select>

                            <!--======================================================================================
                                V A L I D A T I O N     E R R O R   M E S S A G E S
                                ======================================================================================-->                                
                                <transition appear enterActiveClass="fade-in-down" leaveActiveClass="fade-out-up">
                                    <span class="text-danger" v-if="!$v.sub_category_id.required && $v.sub_category_id.$dirty">
                                        Sub category is required
                                    </span>
                                </transition>
                            </div>
                        </div> 

                        <div class="col-sm-9 offset-3 d-flex justify-content-start mt-3 pl-2">
                            <button type="button" role="button" class="btn btn-success" @click="uploadImage">
                                Save
                            </button>

                            <button class="btn btn-danger ml-2" type="button" role="button" @click="closeAdd"> 
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
    import {Datetime} from 'vue-datetime';
    Vue.use(Datetime)

    import {mapGetters} from 'vuex';
    import {Croppie} from 'croppie';

    export default{
        props:{
            dataUser : {}
        },

        data: function () {
            return{
                isRequesting : false,
                subcategories: '',
                croppie: null,
                image_save:'',
                image: '',
                sub_category_id:'',
                title:'',
                date:'',
                location:'',
                creator:'',
                save_image:'',
            }
        },

        mounted(){
            this.setUpCroppie();
        },

        components:{
            Datetime
        },

        validations: {
            title: {
                required,
                minLength: minLength(3),
                maxLength: maxLength(50)
            },
            sub_category_id:{
                required
            },
            date:{
                required
            },
            location:{
                minLength: minLength(3),
                maxLength: maxLength(30)
            },
            creator:{
                minLength: minLength(3),
                maxLength: maxLength(30)
            },
            image:{
                required
            }
        },

        computed:{
            ...mapGetters({
                categories : 'getCategories'
            }),

            formIsFilled(){
                return this.image != '' 
                    && this.sub_category_id != '' 
                    && this.date != ''
                    && this.title != '' && this.title.length >= 3 && this.title.length <= 50
                    && ( this.location == '' || (this.location.length >= 3 && this.location.length <= 30) )
                    && ( this.creator == '' || (this.creator.length >= 3 && this.creator.length <= 30) )
             }
        },

        watch:{
            subcategories(){
                this.sub_category_id = "";
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
                let file = document.getElementById('croppie');

                this.croppie = new Croppie(file,{
                    viewport: {width: 240, height: 250, type: 'square'},
                    boundary: {width: 290, height: 300 },
                    enableOrientation: false
                });

                if(this.image === null || this.image === ''){
                    this.croppie.bind({
                        url: '/img/portfolio-2.jpg'
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
                    size: {witdh: 480, height: 500, type: 'square'},
                }).then(response => {
                    self.save_image = response;
                });
            },

            uploadImage(){

                const self  = this;
                
                if(this.formIsFilled && !self.isRequesting){

                    this.isRequesting = true;

                    const galleryData = {
                        image : this.save_image,
                        sub_category_id : this.sub_category_id,
                        title : this.title,
                        date : this.date.substring(0,10),
                        location : this.location,
                        creator: this.creator
                    };

                    this.$store.dispatch('store_new_image', galleryData)
                        .then((response) => {
                            flash('Image Added','success');

                            self.isRequesting = false;

                            self.closeAdd();
                        })
                        .catch((errors) => {
                            vselfm.isRequesting = false;

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
                this.$v.date.$touch();
                this.$v.sub_category_id.$touch();
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

    .form-control-danger input {
        border-color: #dc3545 !important;
    }

    .form-control-danger input:focus {
        border-color: #dc3545 !important;
        box-shadow: 0 0 0 0.2rem rgba(220,53,69,.25) !important;
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