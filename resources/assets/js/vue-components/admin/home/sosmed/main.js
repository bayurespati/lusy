import Sosmed from './components/Sosmed.vue';
import Flash from './../../../global/flash.vue';
import {store} from './store';

const admin = new Vue({
    el: '#sosmed',

    components: {
        Sosmed,
        Flash
    },

    mounted(){
        this.$store.dispatch('load_sosmed');
    },

    store
});