<template>
  <div>
    <transition enterActiveClass="fade-in"
    leaveActiveClass="fade-out"
    mode="out-in">
      <template v-if="!isAddSubCategory">
        <div class="row pt-5">
          <div class="col-12">
            <button @click="isAddSubCategory = !isAddSubCategory" class="btn btn-primary">Tambah Subkategori</button>
          </div>
        </div>
      </template>
      
      <template v-else>
        <add @closeAddSubCategory="isAddSubCategory = $event"></add>
      </template>
    </transition>

    <div class="row">
      <div class="col-md-12">
        <transition-group name="slide">
          <subcategory v-for="subcategory in subcategories"
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