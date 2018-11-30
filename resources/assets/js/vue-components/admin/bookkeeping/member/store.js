import Vuex from 'vuex';

export const store = new Vuex.Store({

    //=========================================================================================
    //  S T A T E
    //=========================================================================================
    state: {
        teachers:{},
        studentNoTeacher:{},
        rank:{},
        classList:{},
        regionList: {},
        subscription: {}
    },


    //=========================================================================================
    //  G E T T E R S
    //=========================================================================================
    getters: {
        getTeachers: state => {
            return state.teachers;
        },

        getStudentNoTeacher : state =>{
            return state.studentNoTeacher;
        },

        getRanks: state => {
            return state.rank;
        },

        getClass: state => {
            return state.classList;
        },

        getRegions: state => {
            return state.regionList;
        },

        getSubscription: state => {
            return state.subscription;
        }

    },


    //=========================================================================================
    //  M U T A T I O N S
    //=========================================================================================
    mutations: {
        set_data_teacher_student: (state, data) =>{

            state.teachers = data[0];
            state.studentNoTeacher = data[1];
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

        set_subscription: (state, subscription) =>{
            state.subscription = subscription;  
        },

        edit_member(state, member){

            const memberIndex = _.findIndex(state.teachers, ['id', member.id]);
            const classIndex = _.findIndex(state.classList, ['id', member.class_id]);

            state.teachers[memberIndex].name = member.name;
            state.teachers[memberIndex].gender = member.gender;
            state.teachers[memberIndex].is_active = member.is_active;
            state.teachers[memberIndex].is_teacher = member.is_teacher;
            state.teachers[memberIndex].place_of_birth = member.place_of_birth;
            state.teachers[memberIndex].date_of_birth = member.date_of_birth;
            state.teachers[memberIndex].email = member.email;
            state.teachers[memberIndex].fax = member.fax;
            state.teachers[memberIndex].telephone = member.telephone;
            state.teachers[memberIndex].mobile = member.mobile;
            state.teachers[memberIndex].teacher_id = member.teacher_id;
            state.teachers[memberIndex].join_date = member.join_date;

        },

        delete_member(state, ids){
            
            const memberIndex = _.findIndex(state.teachers, ['id', ids.memberId]);

            state.teachers.splice(memberIndex, 1);
        },

        add_rank(state, dataRank){

            const memberIndex = _.findIndex(state.teachers, ['id', dataRank.member_id]);

            state.teachers[memberIndex].ranks.push({
                annointed_date: dataRank.annointed_date,
                rankId: dataRank.rank_id,
                title: dataRank.title
            })
        },

        update_rank(state, dataRank){
            const memberIndex = _.findIndex(state.teachers, ['id', dataRank.member_id]);
            const rankIndex = _.findIndex(state.teachers[memberIndex].ranks, ['rankId', dataRank.rank_id]);

            state.teachers[memberIndex].ranks[rankIndex].annointed_date = dataRank.annointed_date;
        },

        delete_rank(state, dataRank){
            const memberIndex = _.findIndex(state.teachers, ['id', dataRank.member_id]);
            const rankIndex = _.findIndex(state.teachers[memberIndex].ranks, ['rankId', dataRank.rank_id]);

            state.teachers[memberIndex].ranks.splice(rankIndex, 1);
        },

        add_subscription(state, dataSubscription){

            if(dataSubscription.teacher_id == undefined){

                const memberIndex = _.findIndex(state.studentNoTeacher, ['id', dataSubscription.member_id]);

                state.studentNoTeacher[memberIndex].subscription.push({
                    member_id: dataSubscription.member_id,
                    year: dataSubscription.year,
                    id: dataSubscription.id
                })

            }else{

                const teacherIndex = _.findIndex(state.teachers, ['id', dataSubscription.teacher_id]); 
                const memberIndex = _.findIndex(state.teachers[teacherIndex].student, ['id', dataSubscription.member_id]);

                state.teachers[teacherIndex].student[memberIndex].subscription.push({
                    member_id: dataSubscription.member_id,
                    year: dataSubscription.year,
                    id: dataSubscription.id
                });

            }
            
        },

        delete_subscription(state, ids){

            if(ids.teacher_id == undefined){
                const memberIndex = _.findIndex(state.studentNoTeacher, ['id', ids.member_id]);
                const subscriptionIndex = _.findIndex(state.studentNoTeacher[memberIndex].subscription, ['id', ids.subscription_id]);

                state.studentNoTeacher[memberIndex].subscription.splice(subscriptionIndex, 1);
            }else{

                const teacherIndex = _.findIndex(state.teachers, ['id', ids.teacher_id]); 
                const memberIndex = _.findIndex(state.teachers[teacherIndex].student, ['id', ids.member_id]);
                const subscriptionIndex = _.findIndex(state.teachers[teacherIndex].student[memberIndex].subscription, ['id', ids.subscription_id]);

                state.teachers[teacherIndex].student[memberIndex].subscription.splice(subscriptionIndex, 1);
            }
        },

        add_region(state, dataRegion){

            const memberIndex = _.findIndex(state.teachers, ['id', dataRegion.member_id]);

            state.teachers[memberIndex].region.push({
                id: dataRegion.region_id,
                name: dataRegion.name
            })
        },

        delete_region(state, dataRegion){

            const memberIndex = _.findIndex(state.teachers, ['id', dataRegion.member_id]);
            const regionIndex = _.findIndex(state.teachers[memberIndex].region, ['id', dataRegion.region_id]);

            state.teachers[memberIndex].region.splice(regionIndex, 1);

        },

        add_class(state, dataClass){

            const memberIndex = _.findIndex(state.teachers, ['id', dataClass.member_id]);

            state.teachers[memberIndex].class.push({
                id: dataClass.class_id,
                title: dataClass.title
            })

        },

        delete_class(state, dataClass){

            const memberIndex = _.findIndex(state.teachers, ['id', dataClass.member_id]);
            const classIndex = _.findIndex(state.teachers[memberIndex].class, ['id', dataClass.class_id]);

            state.teachers[memberIndex].class.splice(classIndex, 1);
        }
    },


    //=========================================================================================
    //  A C T I O N S
    //=========================================================================================
    actions: {
        load_data_teacher_student: ({commit}) => {
            axios.get('/admin/bookkeeping/data/teacher_student')
                .then(response =>{
                    commit('set_data_teacher_student',response.data);
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

        load_subscription: ({commit}) => {
            axios.get('/admin/bookkeeping/data/subscription')
                .then(response =>{
                    commit('set_subscription',response.data);
                });
        },

        store_new_member({commit,dispatch}, dataMember) {

            return new Promise((resolve, reject) => {

                axios.post('add/member', dataMember)
                    .then(response => {

                        dispatch('load_data_teacher_student');

                        dispatch('load_region');

                        dispatch('load_class');

                        resolve(dataMember);
                    })
                    .catch(errors => {
                        reject(errors.response.data);
                    })
            })
        },

        update_member({commit,dispatch}, member){

            return new Promise((resolve,reject) => {

                axios.patch('update/member/'+ member.id, member)
                    .then(response => {

                        dispatch('load_data_teacher_student');

                        resolve(member);
                    })
                    .catch(errors => {
                        reject(errors.response.data);
                    })
            })
        },

        destroy_member({commit,dispatch}, ids) {

            return new Promise((resolve, reject) => {

                axios.delete('delete/member/'+ids)
                    .then((response) => {
                        
                        dispatch('load_data_teacher_student');

                        resolve();
                    });
            })
        },

        add_rank({commit,dispatch}, dataRank){

            return new Promise((resolve, reject) => {
                axios.post('add/rank',dataRank)
                    .then(response => {

                        dispatch('load_data_teacher_student');

                        resolve(dataRank);
                    })
                    .catch(errors => {
                        reject(errors.response.data);
                    })
            })
        },

        edit_rank({commit,dispatch}, dataRank) {

            return new Promise((resolve, reject) => {

                axios.patch('update/rank', dataRank)
                    .then((response) => {

                        dispatch('load_data_teacher_student');

                        resolve();
                    });
            })
        },

        destroy_rank({commit,dispatch}, dataRank) {

            return new Promise((resolve, reject) => {

                axios.patch('delete/rank', dataRank)
                    .then((response) => {

                        dispatch('load_data_teacher_student');

                        resolve();
                    });
            })
        },

        add_subscription({commit,dispatch}, dataSubscription){

            return new Promise((resolve, reject) => {

                axios.post('add/subscription', dataSubscription)
                    .then(response => {

                        const data = {
                            id: response.data,
                            year: dataSubscription.year,
                            member_id: dataSubscription.member_id,
                            teacher_id: dataSubscription.teacher_id
                        }

                        commit('add_subscription',data);

                        resolve(data);
                    })
                    .catch(errors => {

                        reject(errors.response.data);
                    })
            })
        },

        destroy_subscription({commit,dispatch}, ids){

            return new Promise((resolve, reject) => {

                axios.delete('delete/subscription/'+ids.subscription_id)
                    .then((response) => {
                        commit('delete_subscription', ids);
                        resolve();
                    });
            })
        },

        add_region({commit,dispatch}, dataRegion){

            return new Promise((resolve, reject) => {

                axios.post('add/class_region', dataRegion)
                    .then(response => {

                        dispatch('load_data_teacher_student');

                        resolve(dataRegion);
                    })
                    .catch(errors => {

                        reject(errors.response.data);
                    })
            })
        },

        destroy_region({commit,dispatch}, dataRegion){

            return new Promise((resolve, reject) => {

                axios.patch('delete/class_region', dataRegion)
                    .then((response) => {
                            
                        dispatch('load_data_teacher_student');

                        resolve();
                    });
            })
        },

        add_class({commit,dispatch}, dataClass){

            return new Promise((resolve, reject) => {

                axios.post('add/class_member', dataClass)
                    .then(response => {

                        dispatch('load_data_teacher_student');

                        resolve(dataClass);
                    })
                    .catch(errors => {

                        reject(errors.response.data);
                    })
            })
        },

        destroy_class({commit,dispatch}, dataClass){

            return new Promise((resolve, reject) => {

                axios.delete('delete/class_member/'+dataClass.member_id+'/'+dataClass.class_id)
                    .then((response) => {
                        
                        dispatch('load_data_teacher_student');

                        resolve();
                    });
            })
        }
    }
});