<template>
  <div class="container">
  	<h3>Social Media Setting</h3>
  	<p>You can set which <strong>social media</strong> to be displayed on the <strong>footer</strong> through here.</p>

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