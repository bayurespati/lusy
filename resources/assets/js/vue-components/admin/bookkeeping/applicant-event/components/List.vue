<template>
  <div class="container">
    <h3>Event Applicants</h3>
    <p class="mb-5">
      Here is where you can see every <strong>upcoming events</strong> shown in <strong>Events & Activites</strong> page
    </p>

    <div class="row">
      <div class="col-md-12">
        <transition-group name="slide">
          <event-item v-for="event in list"
          :event="event"
          :key="event.id">
          </event-item>
        </transition-group>
      </div>
    </div>
  </div>
</template>

<script>
  import EventItem from './Event.vue';
  import {mapGetters} from 'vuex';

  export default {

    data(){
      return{
      }
    },

    components:{
      EventItem
    },

    computed:{
        ...mapGetters({
            list : 'getApplicantEvent',
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