import Events from './components/List.vue';
import Flash from './../../../global/Flash.vue';
import {store} from './store';

const admin = new Vue({
    el: '#events',

    components: {
        Events,
        Flash
    },

    mounted(){
        this.$store.dispatch('load_events');
    },

    store
});