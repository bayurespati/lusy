import Categories from './../../../global/categories/Categories.vue';
import Flash from './../../../global/Flash.vue';
import SideBar from './../../../global/Sidebar.vue';
import {store} from './store';
import Vuelidate from 'vuelidate';
Vue.use(Vuelidate);

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