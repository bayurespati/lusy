<template>
    <div class="card">
        <form>
            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" v-model="title" class="form-control" id="name">
            </div>
            <div class="form-group">
                <label for="date">Date</label>
                <datetime type="date" v-model="date"></datetime>
            </div>

            <div class="form-group">
                <label for="lokasi">Lokasi</label>
                <input type="text" v-model="location" class="form-control" id="lokasi">
            </div>
            <div class="form-group">
                <label for="creator">Creator</label>
                <input type="text" v-model="creator" class="form-control" id="creator">
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select class="form-control" id="category" v-model="subcategories">
                    <option value="">Pilih Category</option>
                    <option v-for="category in categories" :value=category.subcategories>{{ category.title }}</option>
                </select>
            </div>
            <div class="form-group">
                <label for="subcategory">Sub category</label>
                <select class="form-control" id="subcategory" v-model="sub_category_id">
                    <option value="">Pilih Sub Category</option>
                    <option v-for="subcategory in subcategories" :value=subcategory.id>{{ subcategory.title }}</option>
                </select>
            </div>                         
        </form> 

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
                    viewport: {width: 480, height: 500, type: 'square'},
                    boundary: {width: 580, height: 600 },
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
            },

            uploadImage(){

                const vm  = this;
                
                if(this.formIsFilled){

                    this.croppie.result({
                        type: 'canvas',
                        size: 'viewport',
                    }).then(response => {
                        vm.image = response;
                    });

                    this.isRequesting = true;
                    const galleryData = {
                        image : this.image,
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