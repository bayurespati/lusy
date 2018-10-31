import Vuex from 'vuex';
import helpers from './helpers';

export const store = new Vuex.Store({

    //=========================================================================================
    //  S T A T E
    //=========================================================================================
    state: {
        items:{},
    },


    //=========================================================================================
    //  G E T T E R S
    //=========================================================================================
    getters: {
        getItems: state => {
            return state.items;
        },
    },

    //=========================================================================================
    //  M U T A T I O N S
    //=========================================================================================
    mutations: {
        set_items: (state, items) =>{
            state.items = items;
        },

        edit_item(state, updatedItem) {

            const itemIndex = helpers.getIndexOfItem(updatedItem.id);


            state.items[itemIndex].title = updatedItem.title;
            state.items[itemIndex].sub_title = updatedItem.sub_title;
            state.items[itemIndex].date = updatedItem.date;
            state.items[itemIndex].stock = updatedItem.stock;
            state.items[itemIndex].description = updatedItem.description;
            state.items[itemIndex].price = updatedItem.price;
            state.items[itemIndex].store_link = updatedItem.store_link;
            state.items[itemIndex].is_displayed = updatedItem.is_displayed;
        },
    },

    //=========================================================================================
    //  A C T I O N S
    //=========================================================================================
    actions: {
        load_items: ({commit}) => {
            axios.get('/admin/data/list')
                .then(response =>{
                    commit('set_items',response.data);
                });
        },

        update_item({commit}, updatedItem) {

            return new Promise((resolve, reject) => {

                axios.patch('/admin/list/' + updatedItem.id, {
                    id: updatedItem.id,
                    title: updatedItem.title,
                    sub_title: updatedItem.sub_title,
                    date: updatedItem.date,
                    stock: updatedItem.stock,
                    description: updatedItem.description,
                    price: updatedItem.price,
                    store_link: updatedItem.store_link,
                    is_displayed: updatedItem.is_displayed,
                })
                    .then(response => {
                        commit('edit_item', updatedItem);

                        resolve(updatedItem);
                    })
                    .catch(errors => {
                        reject(errors.response.data);
                    })
            })
        },
    }
});