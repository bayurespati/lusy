import Vuex from 'vuex';

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
        getOverseasItems: state => {
            return state.items;
        }
    },


    //=========================================================================================
    //  M U T A T I O N S
    //=========================================================================================
    mutations: {
        set_items: (state, items) =>{
            state.items = items;
        },

        delete_item(state, ids){
            
            const itemIndex = _.findIndex(state.items, ['id', ids.itemId]);

            state.items.splice(itemIndex, 1);
        }
    },


    //=========================================================================================
    //  A C T I O N S
    //=========================================================================================
    actions: {
        load_items: ({commit}) => {
            axios.get('/admin/bookkeeping/data/overseas')
                .then(response =>{
                    commit('set_items',response.data);
                });
        },

        destroy_item({commit}, ids) {

            return new Promise((resolve, reject) => {

                axios.delete('delete/potensial/'+ids.itemId)
                    .then((response) => {
                        commit('delete_item', ids);
                        resolve();
                    });
            })

        },
    }
});