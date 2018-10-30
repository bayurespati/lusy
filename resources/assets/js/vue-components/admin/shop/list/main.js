import ShopItem from './components/List.vue';
import Flash from './../../../global/Flash.vue';
import {store} from './store';

const admin = new Vue({
    el: '#shop-item',

    components: {
        ShopItem,
        Flash
    },

    mounted(){
        this.$store.dispatch('load_list');
    },

    store
});