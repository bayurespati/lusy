<template>
  <div class="container">
    <h3>Member</h3>
    <p class="mb-3">
      Here is where you can see list of members
    </p>

    <transition enterActiveClass="fade-in"leaveActiveClass="fade-out"mode="out-in">
      <template v-if="!isAddMember">
        <div class="row">
          <div class="col-12">
            <button @click="isAddMember = !isAddMember" class="btn btn-primary">Add Member</button>
          </div>
        </div>
      </template>
      <template v-else>
        <add-member @closeAddMember="isAddMember = $event"></add-member>
      </template>
    </transition>

    <div class="row">
      <div class="col-md-12">
        <transition-group name="slide">
          <member v-for="member in members"
          :member="member"
          :key="member.id">
          </member>
        </transition-group>
      </div>
    </div>
  </div>
</template>

<script>
  import AddMember from './AddMember.vue';
  import Member from './Member.vue';
  import {mapGetters} from 'vuex';

  export default {

    data(){
      return{
        isAddMember : false,
      }
    },

    components:{
      Member,
      AddMember
    },

    computed:{
        ...mapGetters({
            members : 'getMembers',
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