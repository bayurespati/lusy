<template>
  <div class="container">
    <h3>Class Region</h3>
    <p class="mb-3">
      Here is where you can see list of Class Region
    </p>

    <transition enterActiveClass="fade-in"leaveActiveClass="fade-out"mode="out-in">
      <template v-if="!isAddRegion">
        <div class="row">
          <div class="col-12">
            <button @click="isAddRegion = !isAddRegion" class="btn btn-primary">Add Region</button>
          </div>
        </div>
      </template>
      <template v-else>
        <add-region @closeAddRegion="isAddRegion = $event"></add-region>
      </template>
    </transition>


    <div class="row">
      <div class="col-md-12">
        <transition-group name="slide">
          <region-item v-for="region in list"
          :region="region"
          :key="region.id">
          </region-item>
        </transition-group>
      </div>
    </div>
  </div>
</template>

<script>
  import AddRegion from './AddRegion.vue';
  import RegionItem from './Region.vue';
  import {mapGetters} from 'vuex';

  export default {

    data(){
      return{
        isAddRegion: false
      }
    },

    components:{
      RegionItem,
      AddRegion
    },

    computed:{
        ...mapGetters({
            list : 'getRegions',
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