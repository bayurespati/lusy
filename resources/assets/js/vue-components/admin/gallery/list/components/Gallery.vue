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