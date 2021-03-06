import MemberList from './components/List.vue';
import Flash from './../../../global/Flash.vue';
import SideBar from './../../../global/Sidebar.vue';
import {store} from './store';
import Vuelidate from 'vuelidate';
Vue.use(Vuelidate)

const admin = new Vue({
    el: '#member-list',

    components: {
        MemberList,
        SideBar,
        Flash
    },

    mounted(){
        this.$store.dispatch('load_data_teacher_student');

        this.$store.dispatch('load_rank');

        this.$store.dispatch('load_class');

        this.$store.dispatch('load_region');

        this.$store.dispatch('load_subscription');
    },

    store
});