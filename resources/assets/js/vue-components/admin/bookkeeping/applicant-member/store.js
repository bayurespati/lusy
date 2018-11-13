import Vuex from 'vuex';

export const store = new Vuex.Store({

    //=========================================================================================
    //  S T A T E
    //=========================================================================================
    state: {
        applicantMember:{},
    },


    //=========================================================================================
    //  G E T T E R S
    //=========================================================================================
    getters: {
        getApplicantMemberItems: state => {
            return state.applicantMember;
        },
    },

    //=========================================================================================
    //  M U T A T I O N S
    //=========================================================================================
    mutations: {
        set_items: (state, items) =>{
            state.applicantMember = items;
        },

        delete_member(state, ids){

            const memberIndex = _.findIndex(state.applicantMember,['id',ids.id]);

            state.applicantMember.splice(memberIndex, 1);
        }
    },

    //=========================================================================================
    //  A C T I O N S
    //=========================================================================================
    actions: {
        load_items: ({commit}) => {
            axios.get('/admin/bookkeeping/data/applicant-member')
                .then(response =>{
                    commit('set_items',response.data);
                });
        },

        update_member({commit}, updatedItem) {

            return new Promise((resolve, reject) => {

                axios.patch('update/applicant-member/' + updatedItem.id, {
                    id: updatedItem.id,
                    is_approve: updatedItem.is_approve,
                })
                    .then(response => {
                        commit('delete_member', updatedItem);

                        resolve(updatedItem);
                    })
                    .catch(errors => {
                        reject(errors.response.data);
                    })
            })
        },

        destroy_item({commit}, ids) {

            return new Promise((resolve, reject) => {

                axios.delete('delete/applicant-member/'+ids.id)
                    .then((response) => {
                        commit('delete_member', ids);
                        resolve();
                    });
            })

        },

    }
});