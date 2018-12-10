<template>
  <div class="container">
    <h3>Shop's Item Master</h3>
    <p class="mb-5">
      Here you can manage <strong>items</strong> shown in <strong>Shop</strong> page.
    </p>
    <transition enterActiveClass="fade-in"leaveActiveClass="fade-out"mode="out-in">
      <template v-if="!isAddShop">
        <div class="row">
          <div class="col-6">
            <button @click="isAddShop = !isAddShop" class="btn btn-primary">Add Item</button>
            <transition enterActiveClass="fade-in" leaveActiveClass="fade-out" mode="out-in">
                <span style="color: #999" v-if="searchBy.length >= 1">
                  Shop find by 
                  <strong style="color: #3f3e3e">"{{ searchBy }}"</strong> 
                </span>
            </transition>
          </div>
          <div class="col-6">
            <input type="text" placeholder="Find" class="form-control mr-3" @input="search">
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
          <shop-item v-for="shop in showShop"
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
        searchBy: '',
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
        }),

        showShop(){
          let re = new RegExp(this.searchBy, 'i');
        
          let tempShop =  _.sortBy(this.list, ['end_date']);

          let shopBySearch =  tempShop.filter(shop => {
              return re.test(shop.title)
                  || re.test(shop.sub_title)
                  || re.test(shop.location)
                  || re.test(shop.price);       
          }); 

          return shopBySearch;
        }
    },

    methods:{
      search(event) {
        this.searchBy = event.target.value;
      }
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