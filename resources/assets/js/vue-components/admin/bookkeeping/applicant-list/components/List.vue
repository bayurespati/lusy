<template>
  <div class="container">
    <h1>Applicant list for {{ event.title }} Event </h1>

    <ul class="breadcrumb">
      <li><a href="/admin/bookkeeping/applicant-event">Event</a></li>
      <li>List</li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <transition-group name="slide">
                <item   
                        v-for="item in listApprove"
                        :item="item"
                        :key="item.id">
                </item>
            </transition-group>
        </div>
    </div>


    <div class="row">
      <div class="col-md-12">
        <transition-group name="slide">
                <item   
                        v-for="item in list"
                        :item="item"
                        :key="item.id">
                </item>
            </transition-group>
        </div>
    </div>
  </div>
</template>

<script>
  import Item from './Item.vue';
  import {mapGetters} from 'vuex';

  export default {

    data(){
      return{
      }
    },

    components:{
      Item
    },

    computed:{
        ...mapGetters({
            list : 'getApplicantList',
            listApprove : 'getApplicantApprove',
            event : 'getEvent'
        })
    }
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