<template>
  <div class="container">
    <h1>GALLERY CATEGORIES</h1>
    <transition enterActiveClass="fade-in"
                    leaveActiveClass="fade-out"
                    mode="out-in">

      <template class="row" v-if="!isAddCategory">
        <button @click="isAddCategory = !isAddCategory" class="btn btn-primary">TAMBAH CATEGORY</button>
      </template>
      <template class="row" v-else>
        <add @closeAddCategory="isAddCategory = $event"></add>
      </template>
    </transition>

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
  import Add from './AddCategory.vue'
  import Category from './Category.vue';
  import {mapGetters} from 'vuex';

  export default {

    data(){
      return{
        isAddCategory: false,
      }
    },

    components:{
      Category,
      Add
    },

    computed:{
            ...mapGetters({
                categories: 'getCategories',
            })
        }
  };
</script>