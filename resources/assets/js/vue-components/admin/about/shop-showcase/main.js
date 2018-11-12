import Shop from './components/Shop.vue';
import Flash from './../../../global/Flash.vue';
import SideBar from './../../../global/Sidebar.vue';
import {store} from './store';

const admin = new Vue({
    el: '#shop-showcase',

    components: {
        Shop,
        SideBar,
        Flash
    },

    mounted(){
        this.$store.dispatch('load_shop');
    },

    store
});