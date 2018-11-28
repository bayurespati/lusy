<template>
	<div class="container">
		<h3>Image Slider Setting</h3>

		<p>You can insert a maximum to 4 (four) images here to be displayed at the <strong>Home</strong> page.</p>
		<transition enterActiveClass="fade-in"
		            leaveActiveClass="fade-out"
		            mode="out-in">
			<template class="row" v-if="!isAddImage">
				<button v-if="totalImage < 4" @click="isAddImage = !isAddImage" class="btn btn-primary mt-1">
					Add Image
				</button>
			</template>
			<template class="row" v-else>
				<image-box @closeAddImage="isAddImage = $event"></image-box>
			</template>
		</transition>

		<div class="row pt-4">
			<image-list
				v-for="(value, key, index) in imageSliders"
				:imageSlider="value"
				:imageNumber="key"
				:key="index">
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