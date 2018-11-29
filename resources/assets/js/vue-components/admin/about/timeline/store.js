import Vuex from 'vuex';
import helpers from './helpers';

export const store = new Vuex.Store({

    //=========================================================================================
    //  S T A T E
    //=========================================================================================
    state: {
        timelines:{},
    },


    //=========================================================================================
    //  G E T T E R S
    //=========================================================================================
    getters: {
        getTimelines: state => {
            return state.timelines;
        }
    },

    //=========================================================================================
    //  M U T A T I O N S
    //=========================================================================================
    mutations: {
        set_timelines: (state, timelines) =>{
            state.timelines = timelines;
        },

        add_new_timeline(state, newTimeline){
            state.timelines.push({
                id: newTimeline.id,
                title: newTimeline.title,
                dateReal: newTimeline.dateReal,
                date: newTimeline.date,
                desc: newTimeline.desc,
            });

            state.timelines.sort(function compare(a, b) {
                var dateA = new Date(a.dateReal);
                var dateB = new Date(b.dateReal);
                return dateA - dateB;
            });
        },

        update_timeline(state, updatedTimeline) {

            const timelineIndex = helpers.getIndexOfTimeline(updatedTimeline.id);

            state.timelines[timelineIndex].title = updatedTimeline.title;
            state.timelines[timelineIndex].dateReal = updatedTimeline.dateReal;
            state.timelines[timelineIndex].date = updatedTimeline.date;
            state.timelines[timelineIndex].desc = updatedTimeline.desc;

            state.timelines.sort(function compare(a, b) {
                var dateA = new Date(a.dateReal);
                var dateB = new Date(b.dateReal);
                return dateA - dateB;
            });
        },

        delete_timeline(state, ids){
            const timelineIndex = helpers.getIndexOfTimeline(ids);

            state.timelines.splice(timelineIndex, 1);
        },
    },

    //=========================================================================================
    //  A C T I O N S
    //=========================================================================================
    actions: {
        load_timeline: ({commit}) => {
            axios.get('data/timeline')
                .then(response =>{
                    commit('set_timelines',response.data);
                });
        },

        store_new_timeline({commit}, timelineData) {

            return new Promise((resolve, reject) => {

                axios.post('add/timeline', timelineData)
                    .then(response => {

                        const newTimelineData = response.data;

                        commit('add_new_timeline', newTimelineData);

                        resolve(newTimelineData);
                    })
                    .catch(errors => {
                        reject(errors.response.data);
                    })
            })
        },

        update_timeline({commit}, updatedTimeline) {

            return new Promise((resolve, reject) => {

                axios.patch('update/timeline/' + updatedTimeline.id, updatedTimeline)
                    .then(response => {

                        const newUpdatedTimeline = response.data;

                        commit('update_timeline', newUpdatedTimeline);

                        resolve(newUpdatedTimeline);
                    })
                    .catch(errors => {
                        reject(errors.response.data);
                    })
            })
        },


        destroy_timeline({commit}, ids) {

            return new Promise((resolve, reject) => {

                axios.delete('delete/timeline/' + ids)
                    .then((response) => {
                        commit('delete_timeline', ids);

                        resolve();
                    });
            })
        },

    }

});