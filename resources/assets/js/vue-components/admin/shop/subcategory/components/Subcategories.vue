<template>
  <div class="container">
    <h1>SHOP SUBCATEGORIES</h1>
    <div class="row">
    <div class="col-md-12">
      <transition-group name="slide">
              <subcategory
                      v-for="subcategory in subcategories"
                      :subcategory="subcategory"
                      :key="subcategory.id">
              </subcategory>
          </transition-group>
      </div>
    </div>
  </div>
</template>

<script>
  import Subcategory from './Subcategory.vue';
  import {mapGetters} from 'vuex';

  export default {
    components:{
      Subcategory
    },

    computed:{
            ...mapGetters({
                subcategories: 'getSubcategories',
            })
        }
  };
</script>