<template>
  <div class="container">
    <h1>SHOP</h1>
    <div class="row">
    <div class="col-md-12">
      <transition-group name="slide">
              <shop-item
                      v-for="shopItem in list"
                      :shopItem="shopItem"
                      :key="shopItem.id">
              </shop-item>
          </transition-group>
      </div>
    </div>
  </div>
</template>

<script>
  import ShopItem from './Item.vue';
  import {mapGetters} from 'vuex';

  export default {
    components:{
      ShopItem
    },

    computed:{
            ...mapGetters({
                list: 'getItems',
            })
        }
  };
</script>