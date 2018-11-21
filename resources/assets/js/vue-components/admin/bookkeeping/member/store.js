import Vuex from 'vuex';

export const store = new Vuex.Store({

    //=========================================================================================
    //  S T A T E
    //=========================================================================================
    state: {
        memebers:{},
        rank:{},
        classList:{}
    },


    //=========================================================================================
    //  G E T T E R S
    //=========================================================================================
    getters: {
        getMembers: state => {
            return state.memebers;
        },

        getRanks: state => {
            return state.rank;
        },

        getClass: state => {
            return state.classList;
        } 
    },


    //=========================================================================================
    //  M U T A T I O N S
    //=========================================================================================
    mutations: {
        set_member: (state, memebers) =>{
            state.memebers = memebers;
        },

        set_rank: (state, rank) =>{
            state.rank = rank;
        },

        set_class: (state, classList) =>{
            state.classList = classList;
        },

        delete_member(state, ids){
            
            const memberIndex = _.findIndex(state.memebers, ['id', ids.memberId]);

            state.memebers.splice(memberIndex, 1);
        }
    },


    //=========================================================================================
    //  A C T I O N S
    //=========================================================================================
    actions: {
        load_members: ({commit}) => {
            axios.get('/admin/bookkeeping/data/member')
                .then(response =>{
                    commit('set_member',response.data);
                });
        },

        load_rank: ({commit}) => {
            axios.get('/admin/bookkeeping/data/rank')
                .then(response =>{
                    commit('set_rank',response.data);
                });
        },

        load_class: ({commit}) => {
            axios.get('/admin/bookkeeping/data/class')
                .then(response =>{
                    commit('set_class',response.data);
                });
        },

        store_new_member({commit}, dataMember) {

            return new Promise((resolve, reject) => {

                axios.post('add/member', dataMember)
                    .then(response => {

                        // commit('add_new_member', dataMember);

                        resolve(dataMember);
                    })
                    .catch(errors => {
                        reject(errors.response.data);
                    })
            })
        },

        destroy_member({commit}, ids) {

            return new Promise((resolve, reject) => {

                axios.delete('delete/applicant-member/'+ids.memberId)
                    .then((response) => {
                        commit('delete_member', ids);
                        resolve();
                    });
            })

        },
    }
});