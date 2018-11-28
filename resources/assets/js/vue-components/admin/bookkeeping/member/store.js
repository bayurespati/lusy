import Vuex from 'vuex';

export const store = new Vuex.Store({

    //=========================================================================================
    //  S T A T E
    //=========================================================================================
    state: {
        members:{},
        rank:{},
        classList:{},
        regionList: {}
    },


    //=========================================================================================
    //  G E T T E R S
    //=========================================================================================
    getters: {
        getMembers: state => {
            return state.members;
        },

        getRanks: state => {
            return state.rank;
        },

        getClass: state => {
            return state.classList;
        },

        getRegions: state => {
            return state.regionList;
        }
    },


    //=========================================================================================
    //  M U T A T I O N S
    //=========================================================================================
    mutations: {
        set_member: (state, members) =>{
            state.members = members;
        },

        set_rank: (state, rank) =>{
            state.rank = rank;
        },

        set_class: (state, classList) =>{
            state.classList = classList;
        },

        set_region: (state, regionList) =>{
            state.regionList = regionList;
        },

        edit_member(state, member){

            const memberIndex = _.findIndex(state.members, ['id', member.id]);
            const classIndex = _.findIndex(state.classList, ['id', member.class_id]);

            state.members[memberIndex].name = member.name;
            state.members[memberIndex].gender = member.gender;
            state.members[memberIndex].place_of_birth = member.place_of_birth;
            state.members[memberIndex].date_of_birth = member.date_of_birth;
            state.members[memberIndex].email = member.email;
            state.members[memberIndex].fax = member.fax;
            state.members[memberIndex].telephone = member.telephone;
            state.members[memberIndex].mobile = member.mobile;
            state.members[memberIndex].teacher_id = member.teacher_id;
            state.members[memberIndex].join_date = member.join_date;

        },

        delete_member(state, ids){
            
            const memberIndex = _.findIndex(state.members, ['id', ids.memberId]);

            state.members.splice(memberIndex, 1);
        },

        add_rank(state, dataRank){

            const memberIndex = _.findIndex(state.members, ['id', dataRank.member_id]);

            state.members[memberIndex].ranks.push({
                annointed_date: dataRank.annointed_date,
                rankId: dataRank.rank_id,
                title: dataRank.title
            })
        },

        update_rank(state, dataRank){
            const memberIndex = _.findIndex(state.members, ['id', dataRank.member_id]);
            const rankIndex = _.findIndex(state.members[memberIndex].ranks, ['rankId', dataRank.rank_id]);

            state.members[memberIndex].ranks[rankIndex].annointed_date = dataRank.annointed_date;
        },

        delete_rank(state, dataRank){
            const memberIndex = _.findIndex(state.members, ['id', dataRank.member_id]);
            const rankIndex = _.findIndex(state.members[memberIndex].ranks, ['rankId', dataRank.rank_id]);

            state.members[memberIndex].ranks.splice(rankIndex, 1);
        },

        add_subscription(state, dataSubscription){
            const memberIndex = _.findIndex(state.members, ['id', dataSubscription.member_id]);

            state.members[memberIndex].subscription.push({
                member_id: dataSubscription.member_id,
                year: dataSubscription.year,
                id: dataSubscription.id
            });
        },

        delete_subscription(state, ids){

            const memberIndex = _.findIndex(state.members, ['id', ids.member_id])
            const subscriptionIndex = _.findIndex(state.members[memberIndex].subscription, ['id', ids.subscription_id])

            state.members[memberIndex].subscription.splice(subscriptionIndex, 1);

        },

        add_region(state, dataRegion){

            const memberIndex = _.findIndex(state.members, ['id', dataRegion.member_id]);

            state.members[memberIndex].region.push({
                id: dataRegion.region_id,
                name: dataRegion.name
            })
        },

        delete_region(state, dataRegion){

            const memberIndex = _.findIndex(state.members, ['id', dataRegion.member_id]);
            const regionIndex = _.findIndex(state.members[memberIndex].region, ['id', dataRegion.region_id]);

            state.members[memberIndex].region.splice(regionIndex, 1);

        },

        add_class(state, dataClass){

            const memberIndex = _.findIndex(state.members, ['id', dataClass.member_id]);

            state.members[memberIndex].class.push({
                id: dataClass.class_id,
                title: dataClass.title
            })

        },

        delete_class(state, dataClass){

            const memberIndex = _.findIndex(state.members, ['id', dataClass.member_id]);
            const classIndex = _.findIndex(state.members[memberIndex].class, ['id', dataClass.class_id]);

            state.members[memberIndex].class.splice(classIndex, 1);
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

        load_region: ({commit}) => {
            axios.get('/admin/bookkeeping/data/region')
                .then(response =>{
                    commit('set_region',response.data);
                });
        },

        store_new_member({commit,dispatch}, dataMember) {

            return new Promise((resolve, reject) => {

                axios.post('add/member', dataMember)
                    .then(response => {

                        dispatch('load_members');

                        resolve(dataMember);
                    })
                    .catch(errors => {
                        reject(errors.response.data);
                    })
            })
        },

        update_member({commit}, member){

            return new Promise((resolve,reject) => {

                axios.patch('update/member/'+ member.id, member)
                    .then(response => {

                        commit('edit_member', member);

                        resolve(member);
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

        add_rank({commit}, dataRank){

            return new Promise((resolve, reject) => {
                axios.post('add/rank',dataRank)
                    .then(response => {

                        commit('add_rank', dataRank);

                        resolve(dataRank);
                    })
                    .catch(errors => {
                        reject(errors.response.data);
                    })
            })
        },

        edit_rank({commit}, dataRank) {

            return new Promise((resolve, reject) => {

                axios.patch('update/rank', dataRank)
                    .then((response) => {
                        commit('update_rank', dataRank);
                        resolve();
                    });
            })
        },

        destroy_rank({commit}, dataRank) {

            return new Promise((resolve, reject) => {

                axios.patch('delete/rank', dataRank)
                    .then((response) => {
                        commit('delete_rank', dataRank);
                        resolve();
                    });
            })
        },

        add_subscription({commit}, dataSubscription){

            return new Promise((resolve, reject) => {

                axios.post('add/subscription', dataSubscription)
                    .then(response => {

                        const data = {
                            id: response.data.id,
                            year: dataSubscription.year,
                            member_id: dataSubscription.member_id
                        }

                        commit('add_subscription', data)

                        resolve(data);
                    })
                    .catch(errors => {

                        reject(errors.response.data);
                    })
            })
        },

        destroy_subscription({commit}, ids){

            return new Promise((resolve, reject) => {

                axios.delete('delete/subscription/'+ids.subscription_id)
                    .then((response) => {
                        commit('delete_subscription', ids);
                        resolve();
                    });
            })
        },

        add_region({commit}, dataRegion){

            return new Promise((resolve, reject) => {

                axios.post('add/class_region', dataRegion)
                    .then(response => {

                        commit('add_region', dataRegion)

                        resolve(dataRegion);
                    })
                    .catch(errors => {

                        reject(errors.response.data);
                    })
            })
        },

        destroy_region({commit}, dataRegion){

            return new Promise((resolve, reject) => {

                axios.patch('delete/class_region', dataRegion)
                    .then((response) => {
                        commit('delete_region', dataRegion);
                        resolve();
                    });
            })
        },

        add_class({commit}, dataClass){

            return new Promise((resolve, reject) => {

                axios.post('add/class_member', dataClass)
                    .then(response => {

                        commit('add_class', dataClass)

                        resolve(dataClass);
                    })
                    .catch(errors => {

                        reject(errors.response.data);
                    })
            })
        },

        destroy_class({commit}, dataClass){

            return new Promise((resolve, reject) => {

                axios.delete('delete/class_member/'+dataClass.member_id+'/'+dataClass.class_id)
                    .then((response) => {
                        commit('delete_class',dataClass);
                        resolve();
                    });
            })
        }
    }
});