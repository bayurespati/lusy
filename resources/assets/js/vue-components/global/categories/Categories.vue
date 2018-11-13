<template>
  <div>
    <transition enterActiveClass="fade-in"
    leaveActiveClass="fade-out"
    mode="out-in">
      <template v-if="!isAddCategory">
        <div class="row pt-5">
          <div class="col-12">
            <button @click="isAddCategory = !isAddCategory" class="btn btn-primary">Add Category</button>
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