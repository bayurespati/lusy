import Vuex from 'vuex';
import helpers from './helpers';

export const store = new Vuex.Store({

    //=========================================================================================
    //  S T A T E
    //=========================================================================================
    state: {
        items:{},
        categories:{},
        subcategories:{}
    },


    //=========================================================================================
    //  G E T T E R S
    //=========================================================================================
    getters: {
        getItems: state => {
            return state.items;
        },

        getCategories: state => {
            return state.categories;
        },

        getSubcategories: state =>{

            return state.subcategories;

        }
    },

    //=========================================================================================
    //  M U T A T I O N S
    //=========================================================================================
    mutations: {
        set_items: (state, items) =>{
            state.items = items[0];
            state.categories = items[1];
            state.subcategories = items[2];
        },

        add_new_shop(state, shopItem){
            state.items.push({
                id: shopItem.id,
                title: shopItem.detail.title,
                sub_title: shopItem.detail.sub_title,
                stock: shopItem.detail.stock,
                description: shopItem.detail.description,
                price: shopItem.detail.price,
                store_link: shopItem.detail.store_link,
                is_displayed: shopItem.detail.is_displayed,
                category_id: shopItem.detail.category_id,
                sub_category_id: shopItem.detail.sub_category_id,
            });
        },

        edit_item(state, updatedItem) {

            const itemIndex = helpers.getIndexOfShop(updatedItem.id);

            state.items[itemIndex].title = updatedItem.title;
            state.items[itemIndex].sub_title = updatedItem.sub_title;
            state.items[itemIndex].stock = updatedItem.stock;
            state.items[itemIndex].description = updatedItem.description;
            state.items[itemIndex].price = updatedItem.price;
            state.items[itemIndex].store_link = updatedItem.store_link;
            state.items[itemIndex].is_displayed = updatedItem.is_displayed;
            state.items[itemIndex].category_id = updatedItem.category_id;
            state.items[itemIndex].sub_category_id = updatedItem.sub_category_id;
        },

        delete_item_shop(state, ids){
            const itemIndex = helpers.getIndexOfShop(ids.imageId);

            state.items.splice(itemIndex, 1);
        },
    },

    //=========================================================================================
    //  A C T I O N S
    //=========================================================================================
    actions: {
        load_items: ({commit}) => {
            axios.get('/admin/shop/data/list')
                .then(response =>{
                    commit('set_items',response.data);
                });
        },

        store_new_shop({commit}, shopItem) {

            return new Promise((resolve, reject) => {

                axios.post('add/list', shopItem)
                    .then(response => {

                        const shop = {
                            id: response.data,
                            detail: shopItem
                        };

                        commit('add_new_shop', shop);

                        resolve(shopItem);
                    })
                    .catch(errors => {
                        reject(errors.response.data);
                    })
            })
        },

        update_shop({commit}, updatedItem) {

            return new Promise((resolve, reject) => {

                axios.patch('update/list/' + updatedItem.id, {
                    id: updatedItem.id,
                    title: updatedItem.title,
                    sub_title: updatedItem.sub_title,
                    stock: updatedItem.stock,
                    description: updatedItem.description,
                    price: updatedItem.price,
                    store_link: updatedItem.store_link,
                    is_displayed: updatedItem.is_displayed,
                    category_id: updatedItem.category_id,
                    sub_category_id: updatedItem.sub_category_id
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

        destroy_item({commit}, ids) {

            return new Promise((resolve, reject) => {

                axios.delete('delete/list/'+ids.itemId)
                    .then((response) => {
                        commit('delete_item_shop', ids);
                        resolve();
                    });
            })

        },
    }
});