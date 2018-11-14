import Subcategories from './../../../global/subcategories/Subcategories.vue';
import Flash from './../../../global/Flash.vue';
import SideBar from './../../../global/Sidebar.vue';
import {store} from './store';
import Vuelidate from 'vuelidate';
Vue.use(Vuelidate);

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