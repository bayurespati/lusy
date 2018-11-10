import Vuex from 'vuex';
import helpers from './helpers';

export const store = new Vuex.Store({

    //=========================================================================================
    //  S T A T E
    //=========================================================================================
    state: {
        potentials:{},
    },


    //=========================================================================================
    //  G E T T E R S
    //=========================================================================================
    getters: {
        getPotentialItems: state => {
            return state.potentials;
        },
    },

    //=========================================================================================
    //  M U T A T I O N S
    //=========================================================================================
    mutations: {
        set_items: (state, items) =>{
            state.potentials = items;
        },

        delete_potential(state, ids){

            const potentialIndex = helpers.getIndexOfPotensial(ids.id);

            state.potentials.splice(potentialIndex, 1);
        },

    },

    //=========================================================================================
    //  A C T I O N S
    //=========================================================================================
    actions: {
        load_items: ({commit}) => {
            axios.get('/admin/bookkeeping/data/potential')
                .then(response =>{
                    commit('set_items',response.data);
                });
        },

        update_potential({commit}, updatedItem) {

            return new Promise((resolve, reject) => {

                axios.patch('update/potensial/' + updatedItem.id, {
                    id: updatedItem.id,
                    is_confirmed: updatedItem.is_confirmed,
                })
                    .then(response => {
                        commit('delete_potential', updatedItem);

                        resolve(updatedItem);
                    })
                    .catch(errors => {
                        reject(errors.response.data);
                    })
            })
        },
    }
});