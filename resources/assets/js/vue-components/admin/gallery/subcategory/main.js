import Subcategories from './components/Subcategories.vue';
import Flash from './../../../global/Flash.vue';
import {store} from './store';

const admin = new Vue({
    el: '#subcategories',

    components: {
        Subcategories,
        Flash
    },

    mounted(){
        this.$store.dispatch('load_subCategories');
    },

    store
});