<template>
  <div class="container">
    <h1>EVENT CATEGORIES</h1>
    <div class="row">
    <div class="col-md-12">
      <transition-group name="slide">
              <category
                      v-for="category in categories"
                      :category="category"
                      :key="category.id">
              </category>
          </transition-group>
      </div>
    </div>
  </div>
</template>

<script>
  import Category from './Category.vue';
  import {mapGetters} from 'vuex';

  export default {
    components:{
      Category
    },

    computed:{
            ...mapGetters({
                categories: 'getCategories',
            })
        }
  };
</script>