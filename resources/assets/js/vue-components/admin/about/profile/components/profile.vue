<template>
  <div class="container">
  	<div class="row">
      <div class="col-md-12">
        <h1>PROFILE</h1>
        <transition enterActiveClass="fade-in"leaveActiveClass="fade-out"mode="out-in">
        <template class="row" v-if="!isEditProfile">
          <button @click="isEditProfile = !isEditProfile" class="btn btn-primary">Edit Profle</button>
        </template>
        <template class="row" v-else>
          <edit-profile :profile="profile" @closeEditProfile="isEditProfile = $event"></edit-profile>
        </template>
      </transition>
      </div>
  	</div>
  </div>
</template>

<script>
  import EditProfile from './EditProfile.vue';
  import {Croppie} from 'croppie';
	import {mapGetters} from 'vuex';

	export default {

    data(){
      return{
        isEditProfile: false
      }
    },

    components:{
      EditProfile
    },

		computed:{
        ...mapGetters({
            profile: 'getProfile',
        })
    },

	};
</script>

<style scoped>
    input[type='file']::-webkit-file-upload-button
    {
        color: #fff;
        background-color: #34495e;
        border: none;
        padding: 5px;
        border-radius: 5px;
    }
    .frame{
        border: 1px gainsboro solid;
        padding: 10px;
        margin-left: auto;
    }

    .inputfile {
        width: 0.1px;
        height: 0.1px;
        opacity: 0;
        overflow: hidden;
        position: absolute;
        z-index: -1; 
    }
    .inputfile + label {
        padding: 0.81rem 0.7692rem;
        display: inline-block;
        cursor: pointer; 
    }
    .inputfile + label i {
        margin-right: 10px; 
    }
</style>

