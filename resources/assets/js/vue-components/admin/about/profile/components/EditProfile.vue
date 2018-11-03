<template>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="col-md-12 text-center">
          <h3 class="text-center font-weight-bold mb-5">Edit Info Profile</h3>
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
                <span>Browse image</span>
              </label>
            </div>
          </div>

          <div class="col-md-8">
            <div class="row">
              <div class="col-md-2 d-flex align-items-center">
                <label class="m-0 pl-1" for="title">Title</label>
              </div>

              <div class="col-md-10">
                <input class="form-control full-width" id="title"  v-model="title"></input>
              </div>
            </div>

            <div class="row mt-2">
              <div class="col-md-2 d-flex align-items-center">
                <label class="m-0 pl-1" for="content-about">Content</label>
              </div>
              
              <div class="col-md-10">
                <textarea class="m-0 pl-1 form-control" id="content-about" rows="12" v-model="content"></textarea>
              </div>
            </div>

            <div class="col-sm-10 offset-2 d-flex justify-content-start mt-3 pl-1">
              <button type="button" role="button"
              class="btn btn-success"
              @click="editProfile">
                Simpan
              </button>

              <button type="button" role="button"
              class="btn btn-danger ml-2"
              @click="closeEditForm">
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
  import {Croppie} from 'croppie';
	import {mapGetters} from 'vuex';

	export default {

    props:{profile:{}},

    data(){
      return{
        croppie: null,
        content: this.profile.content,
        image: this.profile.image_path,
        title: this.profile.title,
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
          let file = document.getElementById('croppie');

          this.croppie = new Croppie(file,{
              viewport: {width: 161.5, height: 260, type: 'square'},
              boundary: {width: 211.5, height: 310 },
              enableOrientation: false,
          });

          if(this.image === null || this.image === ''){
              this.croppie.bind({
                  url: '/img/welcome-2.png'
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

          this.croppie.result({
              type: 'canvas',
              size: {width: 323, height: 520, type: 'square'},
          }).then(response => {
              vm.save_image = response;
          });
      },

      editProfile(){

          const vm = this;

          if (this.image != null 
            || this.content != this.profile.content 
            || this.title != this.profile.title) {

              const updatedProflie = {
                  id: this.profile.id,
                  title: this.title,
                  content: this.content,
                  image: this.save_image
              };

              this.$store.dispatch('update_profile', updatedProflie)                        

                  .then((updatedProfile) => {

                      flash('Profile Berhasil diperbaharui', 'success');

                  })
                  .catch(errors => {

                  });
          }
      },

      setInput(){
        this.croppie = null;
        this.content = '';
        this.image = '';
        this.title = '';
        this.save_image = '';
      },

      closeEditForm() {
          this.$emit('closeEditProfile', false);
      }
    },
	};
</script>

<style type="text/css">
    .croppie-container {
        height: unset;
    }

    .croppie-container .cr-slider-wrap {
        margin: 15px auto 5px auto;
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