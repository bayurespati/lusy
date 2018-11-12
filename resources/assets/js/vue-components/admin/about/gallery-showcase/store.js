import Vuex from 'vuex';
import helpers from './helpers';

export const store = new Vuex.Store({

    //=========================================================================================
    //  S T A T E
    //=========================================================================================
    state: {
        galleryShow:{},
        galleryHide:{}
    },


    //=========================================================================================
    //  G E T T E R S
    //=========================================================================================
    getters: {
        getGalleryShow: state => {
            return state.galleryShow;
        },

        getGalleryHide: state => {
            return state.galleryHide;
        }
    },

    //=========================================================================================
    //  M U T A T I O N S
    //=========================================================================================
    mutations: {
        set_gallery: (state, gallery) =>{
            state.galleryHide = gallery[0];
            state.galleryShow = gallery[1];
        },

        edit_gallery(state, updatedGallery) {


            if(updatedGallery.is_showcase){

                //Find index object on array gallery hide
                const galleryIndex = helpers.getIndexOfGalleryHide(updatedGallery.id);
                state.galleryHide[galleryIndex].is_showcase = updatedGallery.is_showcase;

                //Push object to array gallery show
                state.galleryShow.push(state.galleryHide[galleryIndex]);

                //Delete the same object on gallery hide
                state.galleryHide.splice(galleryIndex, 1);

            }else{

                //Find index object on array gallery show
                const galleryIndex = helpers.getIndexOfGalleryShow(updatedGallery.id);
                state.galleryShow[galleryIndex].is_showcase = updatedGallery.is_showcase;

                //Push object to array gallery Hide
                state.galleryHide.push(state.galleryShow[galleryIndex]);

                //Delete the same object on gallery Show
                state.galleryShow.splice(galleryIndex, 1);

            }
        },
    },

    //=========================================================================================
    //  A C T I O N S
    //=========================================================================================
    actions: {
        load_gallery: ({commit}) => {
            axios.get('/admin/about/data/showcase')
                .then(response =>{
                    commit('set_gallery',response.data);
                });
        },

        update_galllery({commit}, updatedGallery) {

            return new Promise((resolve, reject) => {

                axios.patch('update/showcase/' + updatedGallery.id, {
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