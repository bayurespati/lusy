<template>
  <div class="container">
    <h3>Gallery's Images Master</h3>
    <p>Here you can manages images that are shown in Gallery page.</p>

    <transition enterActiveClass="fade-in" 
    leaveActiveClass="fade-out" 
    mode="out-in">
      <template v-if="!isAddImage">
        <div class="row col pt-5">
          <button @click="isAddImage = !isAddImage" class="btn btn-primary">Tambah Image</button>
        </div>
      </template>
      <template v-else>
        <add-image @closeAddImage="isAddImage = $event"></add-image>
      </template>
    </transition>
    <div class="row">
      <div class="col-md-12">
        <transition-group name="slide">
          <gallery-image
          v-for="galleryImage in gallery"
          :galleryImage="galleryImage"
          :key="galleryImage.id">
          </gallery-image>
        </transition-group>
      </div>
    </div>
  </div>
</template>

<script>
  import AddImage from './AddImage.vue';
  import GalleryImage from './GalleryImage.vue';
  import {mapGetters} from 'vuex';

  export default {

    data(){
      return{
        isAddImage: false
      }
    },

    components:{
      GalleryImage,
      AddImage
    },

    computed:{
            ...mapGetters({
                gallery: 'getGallery',
            })
        }
  };
</script>