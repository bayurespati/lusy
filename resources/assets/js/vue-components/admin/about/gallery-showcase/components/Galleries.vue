<template>
  <div class="container">
    <h1>GALLERY</h1>
    <div class="row">
    <div class="col-md-12">
      <transition-group name="slide">
              <gallery
                      v-for="gallery in galleries"
                      :gallery="gallery"
                      :key="gallery.id">
              </gallery>
          </transition-group>
      </div>
    </div>
  </div>
</template>

<script>
  import Gallery from './Gallery.vue';
  import {mapGetters} from 'vuex';

  export default {
    components:{
      Gallery
    },

    computed:{
            ...mapGetters({
                galleries: 'getGalleries',
            })
        }
  };
</script>