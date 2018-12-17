<template>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="col-md-12 text-center">
          <h3 class="text-center font-weight-bold mb-5">Edit Profile Info</h3>
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
                <textarea class="form-control" id="content-about" rows="12" v-model="content"></textarea>
              </div>
            </div>

            <div class="col-sm-10 offset-2 d-flex justify-content-start mt-3 pl-1">
              <button type="button" role="button"class="btn btn-success"@click="editProfile">
                Save
              </button>

              <button type="button" role="button"class="btn btn-danger ml-2"@click="closeEditForm">
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
  import {Croppie} from 'croppie';
	import {mapGetters} from 'vuex';

	export default {

    props:{profile:{}},

    data(){
      return{
        isRequsting: false,
        url: this.profile.image_path,
        content: this.profile.content,
        image: this.profile.image_path,
        title: this.profile.title
      }
    },
    
    computed:{
      isEdited(){
        return this.image != this.profile.image_path
            || this.content != this.profile.content 
            || this.title != this.profile.title;
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

      editProfile(){

          const self = this;

          if (self.isEdited && !self.isRequsting) {

              self.isRequsting = true;

              const updatedProflie = {
                  id: this.profile.id,
                  title: this.title,
                  content: this.content,
                  image: this.image
              };

              this.$store.dispatch('update_profile', updatedProflie)                        
              .then((updatedProfile) => {

                  flash('Profile updated', 'success');

                  self.isRequsting = false;
                  self.closeEditForm();

              })
              .catch(errors => {

                self.isRequsting = false;

              });
          }
      },

      setInput(){
        this.content = '';
        this.image = '';
        this.title = '';
      },

      closeEditForm() {
          this.$emit('closeEditProfile', false);
      }
    },
	};
</script>

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