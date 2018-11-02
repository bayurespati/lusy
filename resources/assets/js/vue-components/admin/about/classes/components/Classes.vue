<template>
  <div class="container">
    <h1>CLASS</h1>
    <transition enterActiveClass="fade-in"leaveActiveClass="fade-out"mode="out-in">
      <template class="row" v-if="!isAddClass">
        <button @click="isAddClass = !isAddClass" class="btn btn-primary">TAMBAH Class</button>
      </template>
      <template class="row" v-else>
        <add-class @closeAddClass="isAddClass = $event"></add-class>
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