<template>
  <div class="container">
    <h1>GALLERY SUBCATEGORIES</h1>
    <transition enterActiveClass="fade-in"
                    leaveActiveClass="fade-out"
                    mode="out-in">

      <template class="row" v-if="!isAddSubCategory">
        <button @click="isAddSubCategory = !isAddSubCategory" class="btn btn-primary">TAMBAH SUBCATEGORY</button>
      </template>
      <template class="row" v-else>
        <add @closeAddSubCategory="isAddSubCategory = $event"></add>
      </template>
    </transition>

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
  import Add from './AddSubcategory.vue';
  import Subcategory from './Subcategory.vue';
  import {mapGetters} from 'vuex';

  export default {

    data(){
      return{
        isAddSubCategory: false,
      }
    },

    components:{
      Subcategory,
      Add
    },

    computed:{
        ...mapGetters({
            subcategories: 'getSubcategories',
        })
    }
  };
</script>