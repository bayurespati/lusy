import Vuex from 'vuex';
import helpers from './helpers';

export const store = new Vuex.Store({

    //=========================================================================================
    //  S T A T E
    //=========================================================================================
    state: {
        items:{},

        itemsApprove:[],

        event:{}
    },


    //=========================================================================================
    //  G E T T E R S
    //=========================================================================================
    getters: {
        getApplicantList: state => {
            return state.items;
        },

        getApplicantApprove: state => {
            return state.itemsApprove;
        },

        getEvent: state => {
            return state.event;
        }
    },


    //=========================================================================================
    //  M U T A T I O N S
    //=========================================================================================
    mutations: {
        set_items: (state, items) =>{

            const data = _.groupBy(items, 'is_approve');
            state.items = data[0];
            if(data[1] !== undefined){
                state.itemsApprove = data[1];
            }
        },

        set_event: (state, event) => {
            state.event = event;
        },

        update_item(state, updatedItem){

            const itemIndex = helpers.getIndexOfItems(updatedItem.id);
            state.items[itemIndex].is_approve = updatedItem.is_approve;
            state.itemsApprove.push(state.items[itemIndex]);
            state.items.splice(itemIndex, 1);
        },

        delete_item(state, ids){
            const itemIndex = helpers.getIndexOfItems(ids.itemId);

            state.items.splice(itemIndex, 1);
        }
    },


    //=========================================================================================
    //  A C T I O N S
    //=========================================================================================
    actions: {
        load_items: ({commit}, id) => {
            axios.get('/admin/bookkeeping/data/applicant-event/list/'+id)
                .then(response =>{
                    commit('set_items',response.data);
                });
        },

        update_item({commit}, applicant) {

            return new Promise((resolve, reject) => {

                axios.patch('/admin/bookkeeping/update/applicant-event/list/' + applicant.id, {
                    id: applicant.id,
                    is_approve: applicant.is_approve,
                })
                    .then(response => {
                        commit('update_item', response.data);

                        resolve(response.data);
                    })
                    .catch(errors => {
                        reject(errors.response.data);
                    })
            })
        },

        destroy_item({commit}, ids) {

            return new Promise((resolve, reject) => {

                axios.delete('/admin/bookkeeping/delete/applicant-event/list/'+ids.itemId)
                    .then((response) => {
                        commit('delete_item', ids);
                        resolve();
                    });
            })

        },

    }
});