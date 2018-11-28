<template>
  <div class="container">
    <h3>Classes Master</h3>
    <p class="mb-0">Here you can manages <strong>classes info</strong> shown in <strong>About</strong> page.</p>
    <p class="mb-5">Dimension: 470 x 600</p>

    <transition enterActiveClass="fade-in" leaveActiveClass="fade-out" mode="out-in">
      <template v-if="!isAddClass">
        <button @click="isAddClass = !isAddClass" class="btn btn-primary">Add Class</button>
      </template>

      <template v-else>
        <div class="row">
          <div class="col-md-12 mb-3">
            <add-class @closeAddClass="isAddClass = $event"></add-class>
          </div>
        </div>
      </template>
    </transition>

    <div class="row">
      <div class="col-md-12">
        <transition-group name="slide">
          <single-class
          v-for="singleClass in classes"
          :singleClass="singleClass"
          :key="singleClass.id">
          </single-class>
        </transition-group>
      </div>
    </div>
  </div>
</template>

<script>
  import AddClass from './AddClass.vue'
  import SingleClass from './Class.vue';
  import {mapGetters} from 'vuex';

  export default {

    data(){
      return{
        isAddClass: false
      }
    },

    components:{
      SingleClass,
      AddClass
    },

    computed:{
      ...mapGetters({
        classes: 'getClasses',
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