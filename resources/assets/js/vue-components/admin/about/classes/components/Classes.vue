<template>
  <div class="container">
    <h1>CLASS</h1>
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
  import SingleClass from './Class.vue';
  import {mapGetters} from 'vuex';

  export default {
    components:{
      SingleClass
    },

    computed:{
            ...mapGetters({
                classes: 'getClasses',
            })
        }
  };
</script>