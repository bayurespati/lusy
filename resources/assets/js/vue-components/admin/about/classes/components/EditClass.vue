<template>
  <transition enterActiveClass="fade-in-down"
  leaveActiveClass="fade-out-up"
  mode="out-in">
    <div class="panel-default panel mt-3 pt-4 bg-grey" id="edit_class">
      <div class="panel-body">
        <h3 class="text-center font-weight-bold">Edit {{ singleClass.title }}</h3>

        <div class="row pl-0 pr-0 m-0 pt-4 pb-4">
          <div class="col-md-4">
            <div id="croppie"></div>

            <div class="panel panel-transparent text-center">
              <input type="file"
              accept="image/*"
              id="file-2"
              class="inputfile"
              @change="setUpFileUploader">
              <label for="file-2" class="btn btn-outline-primary btn btn-primary pt-1 pb-1 pr-2 pl-2">
                <span>Browse Image</span>
              </label>              
            </div>
          </div>

          <div class="col-md-8">
            <div class="col-sm-12 row form-group">
              <div class="col-sm-3 col-xs-12 d-flex align-items-center justify-content-end">
                <label for="title" class="form-control-label panel-font-small m-0 font-weight-bold">
                  Title
                </label>
              </div>
              <div class="col-sm-9 col-xs-12">
                <input id="title"
                type="text"
                class="form-control form-control-sm"
                @keyup.enter="editClass"
                v-model="title">
              </div>
            </div>

            <div class="col-sm-12 row form-group">
              <div class="col-sm-3 col-xs-12 d-flex align-items-center justify-content-end">
                <label for="content" class="form-control-label panel-font-small m-0 font-weight-bold">
                  Content
                </label>
              </div>
              <div class="col-sm-9 col-xs-12">
                <textarea class="form-control" id="content" v-model="content"></textarea>
              </div>

              <div class="col-sm-4 offset-3 d-flex justify-content-start mt-3 pl-3">
                 <button type="button" role="button"
                         class="btn btn-success"
                         @click="editClass"> Save
                </button>

                <button type="button" role="button"
                        class="btn btn-warning ml-2"
                        @click="closeEditForm"> Close
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </transition>
</template>

<script>
  import {Croppie} from 'croppie';
	import {mapGetters} from 'vuex';

	export default {

    props:{singleClass:{}},

    data(){
      return{
        isRequesting: false,
        croppie: null,
        content: this.singleClass.content,
        image: this.singleClass.image_path,
        title: this.singleClass.title,
        save_image: '',
      }
    },

    mounted(){
      this.setUpCroppie();
    },

    computed:{
      isEdited(){
        return this.image != this.singleClass.image_path
            || this.content != this.singleClass.content 
            || this.title != this.singleClass.title;
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
            viewport: {width: 235, height: 300 },
            boundary: {width: 285, height: 350 },
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
            self.setImage();
        };
      },

      setImage(){
        const self  = this;

        this.croppie.result({
            type: 'canvas',
            size: {width: 470, height: 600, type: 'square'},
        }).then(response => {
            self.save_image = response;
        });
      },

      editClass(){

        const self = this;

        if (self.isEdited && !self.isRequesting) {

          self.isRequesting = true;

          const updatedProflie = {
              id: this.singleClass.id,
              title: this.title,
              content: this.content,
              image: this.save_image
          };

          this.$store.dispatch('update_class', updatedProflie)                        
            .then((updatedClass) => {

              flash('Class updated', 'success');

              self.isRequesting = false;

              self.closeEditForm();

            })
            .catch(errors => {

              self.isRequesting = false;

            });
        }
      },

      closeEditForm() {
          this.$emit('editionFormIsClosed', false);
      }
    },
	};
</script>

<style type="text/css">
    .croppie-container {
        height: unset;
    }
</style>

<style scoped>
    .bg-grey {
        background: #fafafa;
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