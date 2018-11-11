import ImageConfig from './components/List.vue';
import Flash from './../../../global/Flash.vue';
import SideBar from './../../../global/Sidebar.vue';
import {store} from './store';

const admin = new Vue({
    el: '#image-config',

    components: {
        ImageConfig,
        SideBar,
        Flash
    },

    mounted(){
    	this.$store.dispatch('load_image_config');
    },

    store
});