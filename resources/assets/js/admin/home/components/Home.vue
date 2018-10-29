<template>
  <div class="container">
  	<div class="row">
		<div class="col-md-12">
			<transition-group name="slide">
	            <sosmed
	                    v-for="sosmed in sosmeds"
	                    :sosmed="sosmed"
	                    :key="sosmed.id">
	            </sosmed>
	        </transition-group>
	  	</div>
  	</div>
  </div>
</template>

<script>
	import Sosmed from './Sosmed.vue';
	import {mapGetters} from 'vuex';

	export default {
		components:{
			Sosmed
		},

		computed:{
            ...mapGetters({
                sosmeds: 'getSosmed',
            })
        }
	};
</script>