<template>
  <div class="container">
    <h3>Showcased Shop</h3>
    <p class="m-0">Here you can manages shop shown in About page.</p>

    <div class="row">
      <div class="col-md-12">
      <!--=====================================================================================
          I M A G E   S H O W
          =====================================================================================-->
          <transition-group name="slide">
            <showcased
            v-for="shopItem in shopShow"
            :shopItem="shopItem"
            :key="shopItem.id">
            </showcased>
          </transition-group>


      <!--=====================================================================================
          I M A G E   H I D E
          =====================================================================================-->
          <transition-group name="slide" >
            <showcased v-if="totalShow < 4"
            v-for="shopItem in shopHide"
            :shopItem="shopItem"
            :key="shopItem.id">
            </showcased>
          </transition-group>
      </div>
    </div>
  </div>
</template>

<script>
  import Showcased from './Showcase.vue';
  import {mapGetters} from 'vuex';

  export default {
    components:{
      Showcased
    },

    computed:{
        ...mapGetters({
            shopShow: 'getShopShow',
            shopHide: 'getShopHide'
        }),

        totalShow() {
            return this.shopShow.length;
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