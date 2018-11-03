<template>
  <div class="container">
    <h3>Profile</h3>
    <p class="mb-5">Here you can manages info shown in Home and About pages.</p>

    <transition enterActiveClass="fade-in"leaveActiveClass="fade-out"mode="out-in">
        <template v-if="!isEditProfile">
          <div class="row">
            <div class="col-md-12 mb-3">
              <button @click="isEditProfile = !isEditProfile" class="btn btn-primary">
                Edit Profile Info
              </button>
            </div>

            <div class="col-md-12">
              <div class="card pt-3 pr-4 pl-4 pb-3">
                <div class="row">
                  <div class="col-md-4">
                  <div class="image-showcase">
                    <i><img :src="profile.image_path"></i>
                  </div>
                </div>
                <div class="col-md-8">
                  <h3 class="text-center text-uppercase font-weight-bold mb-3 mt-3">{{ profile.title }}</h3>
                  <textarea class="form-control text-center" id="content-about" rows="12" disabled v-model="profile.content">
                  </textarea>
                </div>
                </div>
              </div>
            </div>
          </div>
        </template>
        <template v-else>
          <edit-profile :profile="profile" 
          @closeEditProfile="isEditProfile = $event">
          </edit-profile>
        </template>
      </transition>
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
  .image-showcase img {
    width: 100%;
    height: auto;
  }

  textarea {
    background: none !important;
    border: none;
    resize: none;
    width: 100%;
    height: 100%;
  }
</style>

