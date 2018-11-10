import ApplicantList from './components/List.vue';
import Flash from './../../../global/Flash.vue';
import SideBar from './../../../global/Sidebar.vue';
import {store} from './store';

const admin = new Vue({
    el: '#applicant-list',

    components: {
        ApplicantList,
        SideBar,
        Flash
    },

    mounted(){
        this.$store.dispatch('load_items',$event.id);
        this.$store.commit('set_event', $event);
    },

    store
});