<template>
    <div class="row pt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="col-md-12 text-center">
                    <h3 class="text-center font-weight-bold mb-5">Tambah Gambar Gallery</h3>
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
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-3 d-flex align-items-center">
                                <label class="m-0 pl-1" for="name">Nama</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" v-model="title" class="form-control full-width" id="name">
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-3 d-flex align-items-center">
                                <label class="m-0 pl-1" for="date">Tanggal</label>
                            </div>
                            <div class="col-md-9">
                                <datetime type="date" v-model="date" class="full-width"></datetime>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-3 d-flex align-items-center">
                                <label class="m-0 pl-1" for="lokasi">Lokasi</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" v-model="location" class="form-control full-width" id="lokasi">
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-3 d-flex align-items-center">
                                <label class="m-0 pl-1" for="creator">Dibuat Oleh</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" v-model="creator" class="form-control full-width" id="creator">
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-3 d-flex align-items-center">
                                <label class="m-0 pl-1" for="category">Kategori</label>
                            </div>      
                            <div class="col-md-9">
                                <select class="form-control full-width" id="category" v-model="subcategories">
                                    <option value="">Pilih Kategori</option>
                                    <option v-for="category in categories" :value=category.subcategories>{{ category.title }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-3 d-flex align-items-center">
                                <label class="m-0 pl-1" for="subcategory">Subkategori</label>
                            </div>
                            <div class="col-md-9">
                                <select class="form-control full-width" id="subcategory" v-model="sub_category_id">
                                    <option value="">Pilih Subkategori</option>
                                    <option v-for="subcategory in subcategories" :value=subcategory.id>{{ subcategory.title }}</option>
                                </select>
                            </div>
                        </div> 

                        <div class="col-sm-9 offset-3 d-flex justify-content-start mt-3 pl-2">
                            <button type="button" role="button"
                            class="btn btn-success"
                            @click="uploadImage">
                                Simpan
                            </button>

                            <button class="btn btn-danger ml-2"
                            type="button" role="button" 
                            @click="closeAdd"> 
                                Batal
                            </button>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</template>

<script>
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

        computed:{
            ...mapGetters({
                categories : 'getCategories'
            }),

            formIsFilled(){
                return this.image != '' 
                    && this.sub_category_id != '' 
                    && this.date != ''
                    && this.title != '' && this.title.length > 3
                    && this.location != '' && this.location.length > 3
                    && this.creator != '' && this.creator.length > 3
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
                let file = document.getElementById('croppie');

                this.croppie = new Croppie(file,{
                    viewport: {width: 240, height: 250, type: 'square'},
                    boundary: {width: 290, height: 300 },
                    enableOrientation: false
                });

                if(this.image === null || this.image === ''){
                    this.croppie.bind({
                        url: 'https://static.wixstatic.com/media/b77fe464cfc445da9003a5383a3e1acf.jpg'
                    });
                }else {
                    this.croppie.bind({
                        url: this.image
                    });
                }

                this.croppie.options.update = function(){
                    vm.setImage();
                }
            },

            setImage(){
                const vm = this;

                this.croppie.result({
                    type: 'canvas',
                    size: {witdh: 480, height: 500, type: 'square'},
                }).then(response => {
                    vm.save_image = response;
                });
            },

            uploadImage(){

                const vm  = this;
                
                if(this.formIsFilled){
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