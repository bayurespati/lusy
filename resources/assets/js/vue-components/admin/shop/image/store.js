import Vuex from 'vuex';
import helpers from './helpers';

export const store = new Vuex.Store({

    //=========================================================================================
    //  S T A T E
    //=========================================================================================
    state: {
        imageList:{},
        shopId: {}
    },


    //=========================================================================================
    //  G E T T E R S
    //=========================================================================================
    getters: {
        getImageList: state => {
            return state.imageList;
        },

        getShopId: state => {
            return state.shopId;
        }
    },

    //=========================================================================================
    //  M U T A T I O N S
    //=========================================================================================
    mutations: {
        set_images: (state, items) =>{
            
            state.imageList = items.data;
            state.shopId = items.id; 
        },

        add_new_image(state, imageItem){

            state.imageList.push({
                id: imageItem.id,
                image_path: imageItem.image_path,
                is_poster: imageItem.is_poster,
                title: imageItem.title,
                shop_item_id: imageItem.shop_item_id,
            });
        },

        edit_item(state, updatedItem) {

            const imageIndex = helpers.getIndexOfImageList(updatedItem.id);

            state.imageList[imageIndex].shop_item_id = updatedItem.shop_item_id;
            state.imageList[imageIndex].image_path = updatedItem.image_path;
            state.imageList[imageIndex].title = updatedItem.title;
            state.imageList[imageIndex].is_poster = updatedItem.is_poster;
        },

        delete_image(state, ids){
            const imageIndex = helpers.getIndexOfImageList(ids.imageId);

            state.imageList.splice(imageIndex, 1);
        },
    },

    //=========================================================================================
    //  A C T I O N S
    //=========================================================================================
    actions: {
        load_images: ({commit}, id) => {
            axios.get('/admin/shop/data/image/'+id)
                .then(response =>{
                    commit('set_images',{data:response.data,id:id});
                });
        },

        store_new_image({commit}, imageItem) {

            return new Promise((resolve, reject) => {

                axios.post('/admin/shop/add/image', imageItem)
                    .then(response => {

                        commit('add_new_image', response.data);

                        resolve(imageItem);
                    })
                    .catch(errors => {
                        reject(errors.response.data);
                    })
            })
        },

        update_image({commit}, updatedItem) {

            return new Promise((resolve, reject) => {

                axios.patch('/admin/shop/update/image/' + updatedItem.id, {
                    id: updatedItem.id,
                    title: updatedItem.title,
                    image: updatedItem.image,
                    is_poster: updatedItem.is_poster,
                })
                    .then(response => {
                        commit('edit_item', response.data);

                        resolve(updatedItem);
                    })
                    .catch(errors => {
                        reject(errors.response.data);
                    })
            })
        },

        destroy_image({commit}, ids) {

            return new Promise((resolve, reject) => {

                axios.delete('/admin/shop/delete/image/'+ids.imageId)
                    .then((response) => {
                        commit('delete_image', ids);
                        resolve();
                    });
            })

        },
    }
});