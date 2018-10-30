<template>
  <div class="container">
    <h1>GALLERY</h1>
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
  import GalleryImage from './GalleryImage.vue';
  import {mapGetters} from 'vuex';

  export default {
    components:{
      GalleryImage
    },

    computed:{
            ...mapGetters({
                gallery: 'getGallery',
            })
        }
  };
</script>