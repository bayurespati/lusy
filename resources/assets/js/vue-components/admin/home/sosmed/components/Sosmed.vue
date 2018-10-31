<template>
  <div class="container">
  	<h3>Social Media Setting</h3>
  	<p>You can set which social media to be displayed on the navigation bar through here.</p>

  	<div class="row">
		<div class="col-md-12">
			<transition-group name="slide">
	            <sosmed-list
	                    v-for="sosmed in sosmeds"
	                    :sosmed="sosmed"
	                    :key="sosmed.id">
	            </sosmed-list>
	        </transition-group>
	  	</div>
  	</div>
  </div>
</template>

<script>
	import SosmedList from './SosmedList.vue';
	import {mapGetters} from 'vuex';

	export default {
		components:{
			SosmedList,
		},

		computed:{
            ...mapGetters({
                sosmeds: 'getSosmed',
            })
        }
	};
</script>