<template>
  <div class="container">
    <h3 class="text-uppercase">{{ item.title }} IMAGE LIST MASTER</h3>
    <p class="mb-5">This is where you can manage images shown in the shop item's poster shown in Shop page and shop item's images shown in {{ item.title }} single page</p>
    
    <ul class="breadcrumb">
      <li><a href="/admin/shop/list">{{ item.title }}</a></li>
      <li>Image List Master</li>
    </ul>

    <transition enterActiveClass="fade-in"leaveActiveClass="fade-out"mode="out-in">
      <template v-if="!isAddImage">
        <div class="row">
          <div class="col-12" v-if="totalImageList < 4">
            <button @click="isAddImage = !isAddImage" class="btn btn-primary">Tambah Image</button>
          </div>
        </div>
      </template>
      <template v-else>
        <add-image @closeAddImage="isAddImage = $event" :itemName="item.title"></add-image>
      </template>
    </transition>

    <div class="row">
      <div class="col-md-12">
        <transition-group name="slide">
          <image-list
          v-for="imageItem in imageList"
          :imageItem="imageItem"
          :key="imageItem.id">
          </image-list>
        </transition-group>
      </div>
    </div>
  </div>
</template>

<script>
  import AddImage from './AddImage.vue';
  import ImageList from './Image.vue';
  import {mapGetters} from 'vuex';

  export default {

    data(){
      return{
        isAddImage: false
      }
    },

    components:{
      ImageList,
      AddImage
    },

    computed:{
        ...mapGetters({
            imageList: 'getImageList',
            item: 'getItem',
        }),

        totalImageList(){
          return this.imageList.length;
        }
    },
  };
</script>

<style>
  ul.breadcrumb {
      padding: 10px 16px;
      list-style: none;
      background-color: #eee;
  }
  ul.breadcrumb li {
      display: inline;
      font-size: 18px;
  }
  ul.breadcrumb li+li:before {
      padding: 8px;
      color: black;
      content: "/\00a0";
  }
  ul.breadcrumb li a {
      color: #0275d8;
      text-decoration: none;
  }
  ul.breadcrumb li a:hover {
      color: #01447e;
      text-decoration: underline;
  }
  a { cursor: pointer !important; }
</style>

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