import ImageSlider from './components/ImageSlider.vue';
import Flash from './../../../global/flash.vue';
import {store} from './store';

const admin = new Vue({
    el: '#image-slider',

    components: {
        ImageSlider,
        Flash
    },

    mounted(){
    	this.$store.dispatch('load_image_slider');
    },

    store
});