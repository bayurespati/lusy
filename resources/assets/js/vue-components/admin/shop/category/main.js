import Categories from './../../../global/categories/Categories.vue';
import Flash from './../../../global/Flash.vue';
import {store} from './store';

const admin = new Vue({
    el: '#categories',

    components: {
        Categories,
        Flash
    },

    mounted(){
        this.$store.dispatch('load_categories');
    },

    store
});