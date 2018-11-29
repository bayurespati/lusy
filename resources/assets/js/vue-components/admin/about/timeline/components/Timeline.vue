<template>
  <div class="container">
    <h3>Timeline Master</h3>
    <p class="mb-5">Here you can manages <strong>timeline</strong> shown in <strong>About</strong> page.</p>

    <transition enterActiveClass="fade-in"leaveActiveClass="fade-out"mode="out-in">
      <template v-if="!isAddTimeline">
        <div class="row">
          <div class="col-12">
            <button @click="isAddTimeline = !isAddTimeline" class="btn btn-primary">Add Timeline</button>
          </div>
        </div>
      </template>
      <template v-else>
        <add-timeline @closeAddTimeline="isAddTimeline = $event"></add-timeline>
      </template>
    </transition>

    <div class="row">
      <div class="col-md-12">
        <transition-group name="slide">
          <timeline-card
          v-for="timeline in timelines"
          :timeline="timeline"
          :key="timeline.id">
          </timeline-card>
        </transition-group>
      </div>
    </div>
  </div>
</template>

<script>
  import {mapGetters} from 'vuex';
  import AddTimeline from './AddTimeline.vue';
  import TimelineCard from './TimelineCard.vue';

  export default {
    data(){
      return{
        isAddTimeline: false
      }
    },

    components:{
      AddTimeline,
      TimelineCard,
    },

    computed:{
      ...mapGetters({
        timelines: 'getTimelines',
      }),
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