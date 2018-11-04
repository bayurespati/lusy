<template>
  <div class="container">
    <h1>EVENTS</h1>
    <transition enterActiveClass="fade-in"leaveActiveClass="fade-out"mode="out-in">
      <template v-if="!isAddEvent">
        <div class="row">
          <div class="col-12">
            <button @click="isAddEvent = !isAddEvent" class="btn btn-primary">Tambah Event</button>
          </div>
        </div>
      </template>
      <template v-else>
        <add-event @closeAddEvent="isAddEvent = $event"></add-event>
      </template>
    </transition>

    <div class="row">
      <div class="col-md-12">
        <transition-group name="slide">
            <event
                  v-for="event in events"
                  :event="event"
                  :key="event.id">
            </event>
        </transition-group>
      </div>
    </div>
  </div>
</template>

<script>
  import AddEvent from './AddEvent.vue';
  import Event from './Event.vue';
  import {mapGetters} from 'vuex';

  export default {
    data(){
      return{
        isAddEvent: false
      }
    },

    components:{
      Event,
      AddEvent
    },

    computed:{
        ...mapGetters({
            events: 'getEvents',
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