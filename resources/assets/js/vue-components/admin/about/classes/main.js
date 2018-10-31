import Classes from './components/Classes.vue';
import Flash from './../../../global/Flash.vue';
import {store} from './store';

const admin = new Vue({
    el: '#classes',

    components: {
        Classes,
        Flash
    },

    mounted(){
        this.$store.dispatch('load_classes');
    },

    store
});