import Gallery from './components/Gallery.vue';
import Flash from './../../../global/Flash.vue';
import SideBar from './../../../global/Sidebar.vue';
import {store} from './store';
import 'vue-datetime/dist/vue-datetime.css';
import Vuelidate from 'vuelidate';
Vue.use(Vuelidate);

const admin = new Vue({
    el: '#photos',

    components: {
        Gallery,
        SideBar,
        Flash,
    },

    mounted(){
        this.$store.dispatch('load_gallery');
    },

    store
});