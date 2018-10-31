import Vuex from 'vuex';
import helpers from './helpers';

export const store = new Vuex.Store({

    //=========================================================================================
    //  S T A T E
    //=========================================================================================
    state: {
        gallery:{},
    },


    //=========================================================================================
    //  G E T T E R S
    //=========================================================================================
    getters: {
        getGallery: state => {
            return state.gallery;
        },
    },

    //=========================================================================================
    //  M U T A T I O N S
    //=========================================================================================
    mutations: {
        set_gallery: (state, gallery) =>{
            state.gallery = gallery;
        },

        edit_gallery(state, updatedGallery) {

            const galleryIndex = helpers.getIndexOfGallery(updatedGallery.id);


            state.gallery[galleryIndex].is_showcase = updatedGallery.is_showcase;
        },
    },

    //=========================================================================================
    //  A C T I O N S
    //=========================================================================================
    actions: {
        load_gallery: ({commit}) => {
            axios.get('/admin/data/gallery')
                .then(response =>{
                    commit('set_gallery',response.data);
                });
        },

        update_gallery({commit}, updatedGallery) {

            return new Promise((resolve, reject) => {

                axios.patch('/admin/gallery/' + updatedGallery.id, {
                    id: updatedGallery.id,
                    is_showcase: updatedGallery.is_showcase,  
                })
                    .then(response => {
                        commit('edit_gallery', updatedGallery);

                        resolve(updatedGallery);
                    })
                    .catch(errors => {
                        reject(errors.response.data);
                    })
            })
        },
    }
});