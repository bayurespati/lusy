import MessageList from './components/List.vue';
import Flash from './../../../global/Flash.vue';
import SideBar from './../../../global/Sidebar.vue';
import {store} from './store';
import Vuelidate from 'vuelidate';
Vue.use(Vuelidate);

const admin = new Vue({
    el: '#contact-message',

    components: {
        MessageList,
        SideBar,
        Flash
    },

    mounted(){
        this.$store.dispatch('load_items');
    },

    store
});