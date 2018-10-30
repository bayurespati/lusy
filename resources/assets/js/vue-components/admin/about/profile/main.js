import Profile from './components/Profile.vue';
import Flash from './../../../global/Flash.vue';
import {store} from './store';

const admin = new Vue({
    el: '#profile',

    components: {
        Profile,
        Flash
    },

    mounted(){
        this.$store.dispatch('load_profile');
    },

    store
});