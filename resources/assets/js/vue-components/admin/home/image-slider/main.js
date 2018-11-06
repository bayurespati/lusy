import ImageSlider from './components/ImageSlider.vue';
import Flash from './../../../global/Flash.vue';
import SideBar from './../../../global/Sidebar.vue';
import {store} from './store';

const admin = new Vue({
    el: '#image-slider',

    components: {
        ImageSlider,
        SideBar,
        Flash
    },

    mounted(){
    	this.$store.dispatch('load_image_slider');
    },

    store
});