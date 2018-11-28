<template>
  <div class="container">
    <h3>Contact Messages</h3>
    <p class="mb-0">
      Here you can see <strong>messages</strong> sent from the <strong>Contact</strong> page by guests
    </p>
    <p class="mb-5">
      You can also <strong>replied</strong> to their messages here and have it sent straight to their <strong>email</strong>.
    </p>

    <div class="row">
      <div class="col-md-12">
        <transition-group name="slide">
          <message-item v-for="messageContact in list"
          :messageContact="messageContact"
          :key="messageContact.id">
          </message-item>
        </transition-group>
      </div>
    </div>
  </div>
</template>

<script>
  import MessageItem from './Message.vue';
  import {mapGetters} from 'vuex';

  export default {

    data(){
      return{
      }
    },

    components:{
      MessageItem
    },

    computed:{
        ...mapGetters({
            list : 'getMessageItems',
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