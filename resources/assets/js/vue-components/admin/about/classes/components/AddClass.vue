<template>
  <div class="card">
    <div class="col-md-12 text-center">
      <h3 class="text-center font-weight-bold mb-5">Add Class</h3>
    </div>

    <div class="row">
      <div class="col-md-4 text-center">
        <div id="croppie">
          <transition appear enterActiveClass="fade-in-down" leaveActiveClass="fade-out-up">
            <div class="panel" v-if="url != '' "> 
                 <img :src="url" alt="">
            </div>
          </transition>
        </div>

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
          <button type="button" role="button"
          class="btn btn-success"
          @click="addClass">
            Save
          </button>

          <button type="button" role="button"
          class="btn btn-warning ml-2"
          @click="closeAddForm">
            Cancel
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
	import {mapGetters} from 'vuex';

	export default {
    data(){
      return{
        isRequesting: '',
        url: '',
        content: '',
        image: '',
        title: '',
      }
    },

    computed:{
      formIsFilled(){
        return this.image != '' 
            && this.content != '' 
            && this.title != ''
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

      addClass(){

        const self = this;

        if(this.formIsFilled && !self.isRequesting) {

          self.isRequesting = true;

          const classProfile = {
            title: this.title,
            content: this.content,
            image: this.image
          };

          this.$store.dispatch('store_new_class', classProfile)                        
            .then((updatedProfile) => {

              flash('Class added', 'success');

              self.closeAddForm();

              self.isRequesting = false  

            })
            .catch(errors => {

              self.isRequesting = false

            });
        }
      },

      closeAddForm() {
        this.$emit('closeAddClass', false);
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