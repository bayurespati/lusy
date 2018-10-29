import Vuex from 'vuex';
import helpers from './helpers';

export const store = new Vuex.Store({

    //=========================================================================================
    //  S T A T E
    //=========================================================================================
    state: {
        sosmeds:{},
    },


    //=========================================================================================
    //  G E T T E R S
    //=========================================================================================
    getters: {
        getSosmed: state => {
            return state.sosmeds;
        },
    },

    //=========================================================================================
    //  M U T A T I O N S
    //=========================================================================================
    mutations: {
        set_sosmed: (state,sosmeds) =>{
            state.sosmeds = sosmeds;
        },

        edit_sosmed: (state,updatedSosmed) =>{

        },

        edit_sosmed(state, updatedSosmed) {

            const sosmedIndex = helpers.getIndexOfSosmed(updatedSosmed.id);


            state.sosmeds[sosmedIndex].is_active = updatedSosmed.is_active;
            state.sosmeds[sosmedIndex].link = updatedSosmed.link;
        },
    },

    //=========================================================================================
    //  A C T I O N S
    //=========================================================================================
    actions: {
        load_sosmed: ({commit}) => {
            axios.get('/admin/data/sosmed')
                .then(response =>{
                    commit('set_sosmed',response.data);
                });
        },

        update_sosmed({commit}, updatedSosmed) {

            return new Promise((resolve, reject) => {

                axios.patch('/admin/sosmed/' + updatedSosmed.id, {
                    id: updatedSosmed.id,
                    is_active: updatedSosmed.is_active,
                    link: updatedSosmed.link                
                })
                    .then(response => {
                        commit('edit_sosmed', updatedSosmed);

                        resolve(updatedSosmed);
                    })
                    .catch(errors => {
                        reject(errors.response.data);
                    })
            })
        },
    }
});