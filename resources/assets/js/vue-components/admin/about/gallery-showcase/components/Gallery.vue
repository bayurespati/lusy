<template>
  <div class="container">
    <h3>Showcased Images</h3>
    <p class="m-0">Here you can manages images shown in Home and About page.</p>
    <p class="mb-5">(Images shown are in the group of 4 or 8).</p>

    <div class="row">
      <div class="col-md-12">
      <!--=====================================================================================
          I M A G E   S H O W
          =====================================================================================-->
          <transition-group name="slide">
            <showcased-image
            v-for="galleryImage in galleryShow"
            :galleryImage="galleryImage"
            :key="galleryImage.id">
            </showcased-image>
          </transition-group>


      <!--=====================================================================================
          I M A G E   H I D E
          =====================================================================================-->
          <transition-group name="slide" >
            <showcased-image v-if="totalShow < 8"
            v-for="galleryImage in galleryHide"
            :galleryImage="galleryImage"
            :key="galleryImage.id">
            </showcased-image>

            <template v-else>
              <p>There are no images added in gallery yet.</p>
            </template>
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
            galleryShow: 'getGalleryShow',
            galleryHide: 'getGalleryHide'
        }),

        totalShow() {
            return this.galleryShow.length;
        }
    }
  };
</script>

<style scoped>
.slide-enter {
        opacity: 0;
    }

    .slide-enter-active {
        animation: slide-in 0.6s ease;
        transition: opacity 0.6s;
    }

    .slide-leave {
    }

    .slide-leave-active {
        animation: slide-out 0.6s ease forwards;
        transition: opacity 0.6s;
        opacity: 0;
        position: absolute;
        width: 100%;
    }

    .slide-move {
        transition: transform 0.6s;
    }

    @keyframes slide-in {
        from {
            transform: translateY(-20px);
        }
        to {
            background-color: white;
            transform: translateY(0px);
        }
    }

    @keyframes slide-out {
        from {
            transform: translateY(0);
        }
        to {
            transform: translateY(-20px);
        }
    }
</style>