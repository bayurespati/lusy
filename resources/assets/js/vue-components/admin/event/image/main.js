import ImageList from './components/List.vue';
import Flash from './../../../global/Flash.vue';
import SideBar from './../../../global/Sidebar.vue';
import {store} from './store';
import Vuelidate from 'vuelidate';
Vue.use(Vuelidate);


const admin = new Vue({
    el: '#image-list',

    components: {
        ImageList,
        SideBar,
        Flash
    },

    mounted(){
        this.$store.dispatch('load_images',$event.id);
        this.$store.commit('set_event', $event);
    },

    store
});