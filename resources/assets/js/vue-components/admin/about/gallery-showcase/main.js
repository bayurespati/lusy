import GalleryShowcase from './components/GalleryShowcase.vue';
import Flash from './../../../global/Flash.vue';
import {store} from './store';

const admin = new Vue({
    el: '#gallery-showcase',

    components: {
        GalleryShowcase,
        Flash
    },

    mounted(){
        this.$store.dispatch('load_gallery');
    },

    store
});