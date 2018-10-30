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

        edit_image(state, updatedImage) {

            const imageIndex = helpers.getIndexOfImage(updatedImage.id);


            state.gallery[imageIndex].title = updatedImage.title;
            state.gallery[imageIndex].date = updatedImage.date;
            state.gallery[imageIndex].location = updatedImage.location;
            state.gallery[imageIndex].creator = updatedImage.creator;
            state.gallery[imageIndex].image_path = updatedImage.image_path;
        },
    },

    //=========================================================================================
    //  A C T I O N S
    //=========================================================================================
    actions: {
        load_gallery: ({commit}) => {
            axios.get('/admin/data/list')
                .then(response =>{
                    commit('set_gallery',response.data);
                });
        },

        update_image({commit}, updatedImage) {

            return new Promise((resolve, reject) => {

                axios.patch('/admin/list/' + updatedImage.id, {
                    id: updatedImage.id,
                    title: updatedImage.title,
                    date: updatedImage.date,
                    location: updatedImage.location,
                    creator: updatedImage.creator,
                    image_path: updatedImage.image_path,
                })
                    .then(response => {
                        commit('edit_image', updatedImage);

                        resolve(updatedImage);
                    })
                    .catch(errors => {
                        reject(errors.response.data);
                    })
            })
        },
    }
});