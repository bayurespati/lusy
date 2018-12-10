<template>
  <div class="container">
    <h3>Events' Master</h3>
    <p class="mb-5">Here you can manages <strong>events</strong> shown in <strong>Events & Activities</strong> page.</p>

    <transition enterActiveClass="fade-in"leaveActiveClass="fade-out"mode="out-in">
      <template v-if="!isAddEvent">
        <div class="row">
          <div class="col-6">
            <button @click="isAddEvent = !isAddEvent" class="btn btn-primary">Add Event</button>
            <transition enterActiveClass="fade-in" leaveActiveClass="fade-out" mode="out-in">
                <span style="color: #999" v-if="searchBy.length >= 1">
                  Event find by 
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
        <add-event @closeAddEvent="isAddEvent = $event"></add-event>
      </template>
    </transition>

    <div class="row">
      <div class="col-md-12">
        <transition-group name="slide">
            <event v-for="event in showEvent"
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
        searchBy: '',
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
        }),

        showEvent(){
          let re = new RegExp(this.searchBy, 'i');
        
          let tempEvent =  _.sortBy(this.events, ['end_date']);

          let eventBySearch =  tempEvent.filter(event => {
              return re.test(event.title)
                  || re.test(event.address)
                  || re.test(event.location)
                  || re.test(event.content)
                  || re.test(event.end_date)
                  || re.test(event.organiser)
                  || re.test(event.start_date);       
          }); 

          return eventBySearch;
        }
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