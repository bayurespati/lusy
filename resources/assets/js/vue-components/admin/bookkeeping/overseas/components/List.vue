<template>
  <div class="container">
    <h3>Overseas Inquiry</h3>
    <p class="mb-3">
      Here is where you can see list of inquiries that are approved
    </p>

    <div class="row">
      <div class="col-md-12">
        <transition-group name="slide">
          <overseas-item v-for="overseas in list"
          :overseas="overseas"
          :key="overseas.id">
          </overseas-item>
        </transition-group>
      </div>
    </div>
  </div>
</template>

<script>
  import OverseasItem from './Overseas.vue';
  import {mapGetters} from 'vuex';

  export default {

    data(){
      return{
      }
    },

    components:{
      OverseasItem
    },

    computed:{
        ...mapGetters({
            list : 'getOverseasItems',
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