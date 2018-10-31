<<<<<<< HEAD:resources/assets/js/vue-components/admin/home/sosmed/main.js
import Sosmed from './components/Sosmed.vue';
import Flash from './../../../global/flash.vue';
=======
import Home from './components/Home.vue';
import Flash from './../../global/Flash.vue';
>>>>>>> master:resources/assets/js/vue-components/admin/home/main.js
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