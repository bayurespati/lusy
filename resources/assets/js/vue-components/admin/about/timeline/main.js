import Timeline from './components/Timeline.vue';
import Flash from './../../../global/Flash.vue';
import SideBar from './../../../global/Sidebar.vue';
import {store} from './store';
import Vuelidate from 'vuelidate';
Vue.use(Vuelidate)

const admin = new Vue({
    el: '#timeline',

    components: {
        Timeline,
        SideBar,
        Flash
    },

    mounted(){
        this.$store.dispatch('load_timeline');
    },

    store
});