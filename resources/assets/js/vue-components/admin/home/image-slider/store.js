import Vuex from 'vuex';
import helpers from './helpers';

export const store = new Vuex.Store({

    //=========================================================================================
    //  S T A T E
    //=========================================================================================
    state: {
        imageSliders:{},
    },


    //=========================================================================================
    //  G E T T E R S
    //=========================================================================================
    getters: {
        getImageSlider: state => {
            return state.imageSliders;
        }
    },

    //=========================================================================================
    //  M U T A T I O N S
    //=========================================================================================
    mutations: {
        set_image_slider: (state, imageSlider) =>{
            state.imageSliders = imageSlider;
        },

        add_image_slider(state, imageSlider){

            state.imageSliders.push({
                id: imageSlider.id,
                image: imageSlider.image_show,
                thumbnail: imageSlider.thumbnail
            });
        },

        delete_image(state, ids){
            const imageIndex = helpers.getIndexOfImageSlider(ids.imageId);

            state.imageSliders.splice(imageIndex, 1);
        },

    },

    //=========================================================================================
    //  A C T I O N S
    //=========================================================================================
    actions: {
        load_image_slider: ({commit}) => {
            axios.get('/admin/data/image-slider')
                .then(response =>{
                    commit('set_image_slider',response.data);
                });
        },

        store_image_slider({commit}, imageFile) {

            return new Promise((resolve, reject) => {

                axios.post('add/image-slider', {
                    image: imageFile.image,
                })
                .then(response => {

                    commit('add_image_slider',response.data);

                    resolve(response.data);
                })
                .catch(errors => {
                    reject(errors.response.data);
                })
            })
        },

        destroy_image({commit}, ids) {

            return new Promise((resolve, reject) => {

                axios.delete('delete/image-slider/'+ids.imageId)
                    .then((response) => {
                        commit('delete_image', ids);
                        resolve();
                    });
            })

        },

    }

});