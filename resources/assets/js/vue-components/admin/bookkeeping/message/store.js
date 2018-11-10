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
        getMessageItems: state => {
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

        delete_message(state, ids){

            const messageIndex = helpers.getIndexOfMessage(ids.id);

            state.items.splice(messageIndex, 1);
        },

    },


    //=========================================================================================
    //  A C T I O N S
    //=========================================================================================
    actions: {
        load_items: ({commit}) => {
            axios.get('/admin/bookkeeping/data/message')
                .then(response =>{
                    commit('set_items',response.data);
                });
        },

        send_message({commit}, message) {

            return new Promise((resolve, reject) => {

                axios.patch('replay/message/' + message.id, {
                    id: message.id,
                    message: message.message,
                    subject: message.subject
                })
                    .then(response => {
                        commit('delete_message', message);

                        resolve(response.data);
                    })
                    .catch(errors => {
                        reject(errors.response.data);
                    })
            })
        },
    }
});