<template>
  <div class="container">
    <h1>Potential Overseas Inquiry</h1>
    <div class="row">
    <div class="col-md-12">
      <transition-group name="slide">
              <potential-item
                      v-for="potential in list"
                      :potential="potential"
                      :key="potential.id">
              </potential-item>
          </transition-group>
      </div>
    </div>
  </div>
</template>

<script>
  import PotentialItem from './Potential.vue';
  import {mapGetters} from 'vuex';

  export default {

    data(){
      return{
      }
    },

    components:{
      PotentialItem
    },

    computed:{
        ...mapGetters({
            list: 'getPotentialItems',
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