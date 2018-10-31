<template>
  <div class="container">
    <h1>SHOWCASED GALLERY</h1>
    <div class="row">
    <div class="col-md-12">
      <transition-group name="slide">
              <showcased-image
                      v-for="showcasedImage in gallery"
                      :showcasedImage="showcasedImage"
                      :key="showcasedImage.id">
              </showcased-image>
          </transition-group>
      </div>
    </div>
  </div>
</template>

<script>
  import ShowcasedImage from './showcasedImage.vue';
  import {mapGetters} from 'vuex';

  export default {
    components:{
      ShowcasedImage
    },

    computed:{
            ...mapGetters({
                gallery: 'getGallery',
            })
        }
  };
</script>