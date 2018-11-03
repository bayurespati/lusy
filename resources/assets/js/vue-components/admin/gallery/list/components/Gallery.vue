<template>
  <div class="container">
    <h1>GALLERY</h1>
    <transition enterActiveClass="fade-in"leaveActiveClass="fade-out"mode="out-in">
      <template class="row" v-if="!isAddImage">
        <button @click="isAddImage = !isAddImage" class="btn btn-primary">TAMBAH IMAGE</button>
      </template>
      <template class="row" v-else>
        <image-box @closeAddImage="isAddImage = $event"></image-box>
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
  import ImageBox from './ImageBox.vue';
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
      ImageBox
    },

    computed:{
            ...mapGetters({
                gallery: 'getGallery',
            })
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