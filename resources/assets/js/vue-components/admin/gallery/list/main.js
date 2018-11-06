import Gallery from './components/Gallery.vue';
import Flash from './../../../global/Flash.vue';
import SideBar from './../../../global/Sidebar.vue';
import {store} from './store';
import 'vue-datetime/dist/vue-datetime.css'

const admin = new Vue({
    el: '#gallery',

    components: {
        Gallery,
        SideBar,
        Flash,
    },

    mounted(){
        this.$store.dispatch('load_gallery');
    },

    store
});