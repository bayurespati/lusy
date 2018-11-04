<template>
  <div class="container">
    <h1>SHOP</h1>
    <transition enterActiveClass="fade-in"leaveActiveClass="fade-out"mode="out-in">
      <template v-if="!isAddShop">
        <div class="row">
          <div class="col-12">
            <button @click="isAddShop = !isAddShop" class="btn btn-primary">Tambah Shop</button>
          </div>
        </div>
      </template>
      <template v-else>
        <add-shop @closeAddShop="isAddShop = $event"></add-shop>
      </template>
    </transition>

    <div class="row">
    <div class="col-md-12">
      <transition-group name="slide">
              <shop-item
                      v-for="shop in list"
                      :shop="shop"
                      :key="shop.id">
              </shop-item>
          </transition-group>
      </div>
    </div>
  </div>
</template>

<script>
  import AddShop from './AddShop.vue';
  import ShopItem from './Shop.vue';
  import {mapGetters} from 'vuex';

  export default {

    data(){
      return{
        isAddShop: false
      }
    },

    components:{
      ShopItem,
      AddShop
    },

    computed:{
        ...mapGetters({
            list: 'getItems',
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