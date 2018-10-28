import Dashboard from './Dashboard.vue';
import VueSidebarMenu from 'vue-sidebar-menu';
Vue.use(VueSidebarMenu)

const admin = new Vue({
    el: '#admin',

    components: {
        Dashboard
    }
});