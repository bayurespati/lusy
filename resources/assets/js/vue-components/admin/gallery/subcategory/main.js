import Subcategories from './../../../global/subcategories/Subcategories.vue';
import Flash from './../../../global/Flash.vue';
import SideBar from './../../../global/Sidebar.vue';
import {store} from './store';

const admin = new Vue({
    el: '#subcategories',

    components: {
        Subcategories,
        SideBar,
        Flash
    },

    mounted(){
        this.$store.dispatch('load_subCategories');
    },

    store
});