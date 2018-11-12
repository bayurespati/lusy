import Vuex from 'vuex';
import helpers from './helpers';

export const store = new Vuex.Store({

    //=========================================================================================
    //  S T A T E
    //=========================================================================================
    state: {
        shopShow:{},
        shopHide:{}
    },


    //=========================================================================================
    //  G E T T E R S
    //=========================================================================================
    getters: {
        getShopShow: state => {
            return state.shopShow;
        },

        getShopHide: state => {
            return state.shopHide;
        }
    },


    //=========================================================================================
    //  M U T A T I O N S
    //=========================================================================================
    mutations: {
        set_shop: (state, shop) =>{
            state.shopHide = shop[0];

            state.shopShow = shop[1];
        },

        edit_shop(state, updatedShop) {


            if(updatedShop.is_showcase){

                //Find index object on array shop hide
                const shopIndex = helpers.getIndexOfShopHide(updatedShop.id);
                state.shopHide[shopIndex].is_showcase = updatedShop.is_showcase;

                //Push object to array shop show
                state.shopShow.push(state.shopHide[shopIndex]);

                //Delete the same object on show hide
                state.shopHide.splice(shopIndex, 1);

            }else{

                //Find index object on array show show
                const shopIndex = helpers.getIndexOfShopShow(updatedShop.id);
                state.shopShow[shopIndex].is_showcase = updatedShop.is_showcase;

                //Push object to array show Hide
                state.shopHide.push(state.shopShow[shopIndex]);

                //Delete the same object on show Show
                state.shopShow.splice(shopIndex, 1);

            }
        },
    },


    //=========================================================================================
    //  A C T I O N S
    //=========================================================================================
    actions: {
        load_shop: ({commit}) => {
            axios.get('/admin/about/data/shop-showcase')
                .then(response =>{
                    commit('set_shop',response.data);
                });
        },

        update_shop({commit}, updatedShop) {

            return new Promise((resolve, reject) => {

                axios.patch('update/shop-showcase/' + updatedShop.id, {
                    is_showcase: updatedShop.is_showcase,  
                })
                    .then(response => {
                        commit('edit_shop', updatedShop);

                        resolve(updatedShop);
                    })
                    .catch(errors => {
                        reject(errors.response.data);
                    })
            })
        },
    }
});