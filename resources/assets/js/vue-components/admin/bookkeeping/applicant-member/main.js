import ApplicantMember from './components/List.vue';
import Flash from './../../../global/Flash.vue';
import SideBar from './../../../global/Sidebar.vue';
import {store} from './store';

const admin = new Vue({
    el: '#applicant-member',

    components: {
        ApplicantMember,
        SideBar,
        Flash
    },

    mounted(){
        this.$store.dispatch('load_items');
    },

    store
});