import MemberDetail from './MemberDetail.vue';
import SideBar from './../../../global/Sidebar.vue';
import {store} from './store.js';

const admin = new Vue({
    el: '#show-member-detail',

    components: {
        MemberDetail,
        SideBar
    },

    store
});