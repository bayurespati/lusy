import Vuex from 'vuex';
import helpers from './helpers';

export const store = new Vuex.Store({

    //=========================================================================================
    //  S T A T E
    //=========================================================================================
    state: {
        gallery:{},
        categories:{},
    },


    //=========================================================================================
    //  G E T T E R S
    //=========================================================================================
    getters: {
        getGallery: state => {
            return state.gallery;
        },

        getCategories: state => {
            return state.categories;
        }
    },

    //=========================================================================================
    //  M U T A T I O N S
    //=========================================================================================
    mutations: {
        set_gallery: (state, data) =>{
            state.gallery = data[0];
            state.categories = data[1];
        },

        add_new_image(state, imageData){

            state.gallery.push({
                id: imageData.id,
                image_path: imageData.image_path,
                title: imageData.detail.title,
                sub_category_id: imageData.detail.sub_category_id,
                date: imageData.detail.date,
                location: imageData.detail.location,
                creator: imageData.detail.creator,
            });
        },

        edit_image(state, updatedGallery) {

            const imageIndex = helpers.getIndexOfGallery(updatedGallery.detail.id);

            state.gallery[imageIndex].title = updatedGallery.detail.title;
            state.gallery[imageIndex].date = updatedGallery.detail.date;
            state.gallery[imageIndex].location = updatedGallery.detail.location;
            state.gallery[imageIndex].creator = updatedGallery.detail.creator;
            state.gallery[imageIndex].sub_category_id = updatedGallery.detail.sub_category_id;
            state.gallery[imageIndex].image_path = updatedGallery.image_path;
        },

        delete_gallery(state, ids){
            const galleryIndex = helpers.getIndexOfGallery(ids.galleryId);

            state.gallery.splice(galleryIndex, 1);
        },
    },

    //=========================================================================================
    //  A C T I O N S
    //=========================================================================================
    actions: {
        load_gallery: ({commit}) => {
            axios.get('/admin/gallery/data/list')
                .then(response =>{
                    commit('set_gallery',response.data);
                });
        },

        store_new_image({commit}, galleryData) {

            return new Promise((resolve, reject) => {

                axios.post('add/list', galleryData)
                    .then(response => {

                        const imageData = {
                            id: response.data[0],
                            image_path: response.data[1],
                            detail: galleryData
                        };

                        commit('add_new_image', imageData);

                        resolve(imageData);
                    })
                    .catch(errors => {
                        reject(errors.response.data);
                    })
            })
        },

        update_galllery({commit}, updatedGallery) {

            return new Promise((resolve, reject) => {

                axios.patch('update/list/' + updatedGallery.id, {
                    id: updatedGallery.id,
                    title: updatedGallery.title,
                    date: updatedGallery.date,
                    location: updatedGallery.location,
                    creator: updatedGallery.creator,
                    sub_category_id: updatedGallery.sub_category_id,
                    image: updatedGallery.image
                })
                    .then(response => {

                        const updateData = {
                            image_path : response.data,
                            detail : updatedGallery
                        }

                        commit('edit_image', updateData);

                        resolve(updatedGallery);
                    })
                    .catch(errors => {
                        reject(errors.response.data);
                    })
            })
        },


        destroy_gallery({commit}, ids) {

            return new Promise((resolve, reject) => {

                axios.delete('delete/list/'+ids.galleryId)
                    .then((response) => {
                        commit('delete_gallery', ids);
                        resolve();
                    });
            })
        },
    }
});