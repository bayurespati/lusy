import Categories from './../../../global/categories/Categories.vue';
import SideBar from './../../../global/Sidebar.vue';
import Flash from './../../../global/Flash.vue';
import {store} from './store';

const admin = new Vue({
    el: '#categories',

    components: {
        Categories,
        SideBar,
        Flash
    },

    mounted(){
        this.$store.dispatch('load_categories');
    },

    store
});