<template>
  <div class="container">
    <h3>Gallery's Images Master</h3>
    <p class="mb-0">Here you can manages <strong>images</strong> that are shown in <strong>Gallery</strong> page, images uploaded here will also shows up in <strong>Gallery Showcase</strong> page as options.</p>
    <p>Dimension: (480 x 500) or (960 x 500)</p>

    <transition enterActiveClass="fade-in" leaveActiveClass="fade-out" mode="out-in">
      <template v-if="!isAddImage">
        <div class="row pt-5">
          <div class="col-6">
              <button @click="isAddImage = !isAddImage" class="btn btn-primary">Add Image</button>
              <transition enterActiveClass="fade-in" leaveActiveClass="fade-out" mode="out-in">
                <span style="color: #999" v-if="searchBy.length >= 1">
                  Image find by 
                  <strong style="color: #3f3e3e">"{{ searchBy }}"</strong> 
                </span>
              </transition>
          </div>
          <div class="col-6">
            <input type="text" placeholder="Find" class="form-control mr-3" @input="search">
          </div>
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
          v-for="galleryImage in showGallery"
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
        searchBy: '',
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
        }),

        showGallery(){
          let re = new RegExp(this.searchBy, 'i');
        
          let tempGallery =  _.sortBy(this.gallery, ['date']);

          let galleryBySearch =  tempGallery.filter(gallery => {
              return re.test(gallery.title)
                  || re.test(gallery.date)
                  || re.test(gallery.location)
                  || re.test(gallery.creator);        
          }); 

          return galleryBySearch;
        },
    },

    methods:{
      search(event) {
        this.searchBy = event.target.value;
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