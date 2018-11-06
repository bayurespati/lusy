import Sosmed from './components/Sosmed.vue';
import Flash from './../../../global/Flash.vue';
import SideBar from './../../../global/Sidebar.vue';
import {store} from './store';

const admin = new Vue({
    el: '#sosmed',

    components: {
        Sosmed,
        Flash,
        SideBar
    },

    mounted(){
        this.$store.dispatch('load_sosmed');
    },

    store
});