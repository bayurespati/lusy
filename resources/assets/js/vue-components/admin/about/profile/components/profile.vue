<template>
  <div class="container">
  	<div class="row">
      <div class="col-md-12">
        <h1>PROFILE</h1>
	  	</div>
  	</div>
  </div>
</template>

<script>
	import {mapGetters} from 'vuex';

	export default {

		computed:{
            ...mapGetters({
                profile: 'getProfile',
            })
        }
	};
</script>