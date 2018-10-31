<template>
  <div class="container">
    <h1>EVENTS</h1>
    <div class="row">
    <div class="col-md-12">
      <transition-group name="slide">
              <event
                      v-for="event in events"
                      :event="events"
                      :key="event.id">
              </event>
          </transition-group>
      </div>
    </div>
  </div>
</template>

<script>
  import Event from './Event.vue';
  import {mapGetters} from 'vuex';

  export default {
    components:{
      Event
    },

    computed:{
            ...mapGetters({
                events: 'getEvents',
            })
        }
  };
</script>