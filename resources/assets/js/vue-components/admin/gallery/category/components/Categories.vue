<template>
  <div class="container">
    <h3>Gallery's Master Categories</h3>
    <p class="m-0">
      This is where you can customise categories used in Gallery page.
    </p>
    <p>
      (caution: deleting a category will also deletes subcategories and items that belong to that categories).
    </p>

    <transition enterActiveClass="fade-in"
    leaveActiveClass="fade-out"
    mode="out-in">
      <template v-if="!isAddCategory">
        <div class="row pt-5">
          <div class="col-12">
            <button @click="isAddCategory = !isAddCategory" class="btn btn-primary">Tambah Kategori</button>
          </div>
        </div>
      </template>
      
      <template v-else>
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