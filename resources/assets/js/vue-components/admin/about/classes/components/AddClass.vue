<template>
  <div class="card">
    <form>
      <div class="form-group">
        <label for="title">Title</label>
          <input class="form-control" id="title"  v-model="title"></input>
      </div>

      <div class="form-group">
        <label for="content-about">Content</label>
          <textarea class="form-control" id="content-about" rows="12" v-model="content">
        </textarea>
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
                @click="addClass">
                Save
        </button>

        <button type="button" role="button"
                class="btn btn-warning"
                @click="closeAddForm">
                Batal
        </button>

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
        content: '',
        image: '',
        title: '',
        save_image: ''
      }
    },

    mounted(){
      this.setUpCroppie();
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
                  url: '/img/welcome-1.jpg'
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

      addClass(){

          const vm = this;

          if (this.formIsFilled) {

              const classProfile = {
                  title: this.title,
                  content: this.content,
                  image: this.save_image
              };

              this.$store.dispatch('store_new_class', classProfile)                        

                  .then((updatedProfile) => {

                      flash('Class Berhasil ditambah', 'success');

                      vm.closeAddForm()

                  })
                  .catch(errors => {

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