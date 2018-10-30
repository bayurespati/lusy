import Home from './components/Home.vue';
import Flash from './../../global/Flash.vue';
import {store} from './store';

const admin = new Vue({
    el: '#home',

    components: {
        Home,
        Flash
    },

    mounted(){
        this.$store.dispatch('load_sosmed');
    },

    store
});