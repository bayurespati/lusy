<template>
	<div class="container">
		<h1>IMAGE SLIDER</h1>
		<transition enterActiveClass="fade-in"
		                leaveActiveClass="fade-out"
		                mode="out-in">

			<template class="row" v-if="!isAddImage">
				<button v-if="totalImage < 4" @click="isAddImage = !isAddImage" class="btn btn-primary">TAMBAH IMAGE</button>
			</template>
			<template class="row" v-else>
				<image-box @closeAddImage="isAddImage = $event"></image-box>
			</template>
		</transition>

		 <div class="row">
		 	<image-list
		                v-for="imageSlider in imageSliders"
		                :imageSlider="imageSlider"
		                :key="imageSlider.id">
		    </image-list>
	    </div>	
	</div>  
</template>

<script>
	import ImageList from './ImageList.vue';
	import ImageBox from './ImageBox.vue';
	import {mapGetters} from 'vuex';
	export default {

		data(){
			return{
				isAddImage: false,
			}
		},

		components:{
			ImageBox,
			ImageList
		},

		computed:{
            ...mapGetters({
                imageSliders: 'getImageSlider',
            }),

            totalImage() {
                return this.imageSliders.length;
            }
        }
	};
</script>