<template>

    <transition enterActiveClass="fade-in-down"
                leaveActiveClass="fade-out-up"
                mode="out-in">

        <div class="panel-default panel mt-5" id="edit_class">
            <div class="panel-body">
                <div class="row pl-0 pr-0 m-0 pt-4 pb-4 bg-grey">


                    <!--=========================================================================================
                        N A M A
                        =========================================================================================-->
                    <div class="col-sm-12 row form-group">
                        <div class="col-sm-3 col-xs-12 d-flex align-items-center justify-content-end">
                            <label for="title"
                                   class="form-control-label panel-font-small m-0">
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


                    <!--=========================================================================================
                        C O N T E N T
                        =========================================================================================-->
                    <div class="col-sm-12 row form-group">
                        <div class="col-sm-3 col-xs-12 d-flex align-items-center justify-content-end">
                            <label for="content"
                                   class="form-control-label panel-font-small m-0">
                                Content
                            </label>
                        </div>
                        <div class="col-sm-9 col-xs-12">
                          <textarea class="form-control" id="content" v-model="content"></textarea>
                        </div>
                    </div>

                    
                    <!--=========================================================================================
                        C R O P P I E
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
                                @click="editClass">
                                Save
                        </button>

                        <button type="button" role="button"
                                class="btn btn-warning"
                                @click="closeEditForm">
                                Tutup
                        </button>
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
              viewport: {width: 470, height: 600, type: 'square'},
              boundary: {width: 570, height: 700 },
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
              size: 'viewport',
          }).then(response => {
              vm.save_image = response;
          });
      },

      editClass(){

          const vm = this;

          if (this.image != this.singleClass.image_path
            || this.content != this.singleClass.content 
            || this.title != this.singleClass.title) {

              const updatedProflie = {
                  id: this.singleClass.id,
                  title: this.title,
                  content: this.content,
                  image: this.save_image
              };

              this.$store.dispatch('update_class', updatedProflie)                        

                  .then((updatedClass) => {

                      flash('Class Berhasil diperbaharui', 'success');

                      vm.closeEditForm();

                  })
                  .catch(errors => {

                  });
          }
      },

      closeEditForm() {
          this.$emit('editionFormIsClosed', false);
      }
    },
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