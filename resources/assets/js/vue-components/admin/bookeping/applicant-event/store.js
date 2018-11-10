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
        getApplicantEvent: state => {
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

        delete_applicant(state, ids){

            const applicantIndex = helpers.getIndexOfApplicant(ids.id);

            state.items.splice(applicantIndex, 1);
        },

    },


    //=========================================================================================
    //  A C T I O N S
    //=========================================================================================
    actions: {
        load_items: ({commit}) => {
            axios.get('/admin/bookkeeping/data/applicant-event')
                .then(response =>{
                    commit('set_items',response.data);
                });
        },

        update_applicant({commit}, applciant) {

            return new Promise((resolve, reject) => {

                axios.patch('update/appplicant-event/' + applciant.id, {
                    id: applciant.id,
                    is_apprive: applciant.is_approve,
                })
                    .then(response => {
                        commit('delete_applicant', applciant);

                        resolve(response.data);
                    })
                    .catch(errors => {
                        reject(errors.response.data);
                    })
            })
        },
    }
});