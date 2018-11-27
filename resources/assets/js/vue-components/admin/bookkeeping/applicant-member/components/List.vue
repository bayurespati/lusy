<template>
  <div class="container">
    <h3>Applicant member list</h3>
    <p class="mb-5">
      Here is where you can see list of applicant members
    </p>
    
    <div class="row">
      <div class="col-md-12">
        <transition-group name="slide">
          <item v-for="(member, index) in list"
          :member="member"
          :key="index">
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

    components:{
      Item
    },

    computed:{
        ...mapGetters({
            list: 'getApplicantMemberItems',
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