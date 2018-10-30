import Vuex from 'vuex';
import helpers from './helpers';

export const store = new Vuex.Store({

    //=========================================================================================
    //  S T A T E
    //=========================================================================================
    state: {
        events:{},
    },


    //=========================================================================================
    //  G E T T E R S
    //=========================================================================================
    getters: {
        getEvents: state => {
            return state.events;
        },
    },

    //=========================================================================================
    //  M U T A T I O N S
    //=========================================================================================
    mutations: {
        set_events: (state, events) =>{
            state.events = events;
        },

        edit_event(state, updatedEvent) {

            const eventIndex = helpers.getIndexOfEvent(updatedEvent.id);


            state.events[eventIndex].title = updatedEvent.title;
            state.events[eventIndex].start_date = updatedEvent.start_date;
            state.events[eventIndex].end_date = updatedEvent.end_date;
            state.events[eventIndex].location = updatedEvent.location;
            state.events[eventIndex].address = updatedEvent.address;
            state.events[eventIndex].organiser = updatedEvent.organiser;
            state.events[eventIndex].content = updatedEvent.content;
        },
    },

    //=========================================================================================
    //  A C T I O N S
    //=========================================================================================
    actions: {
        load_events: ({commit}) => {
            axios.get('/admin/data/list')
                .then(response =>{
                    commit('set_events',response.data);
                });
        },

        update_event({commit}, updatedEvent) {

            return new Promise((resolve, reject) => {

                axios.patch('/admin/list/' + updatedEvent.id, {
                    id: updatedEvent.id,
                    title: updatedEvent.title,
                    start_date: updatedEvent.start_date,
                    end_date: updatedEvent.end_date,
                    location: updatedEvent.location,
                    address: updatedEvent.address,
                    organiser: updatedEvent.organiser,
                    content: updatedEvent.content,
                })
                    .then(response => {
                        commit('edit_event', updatedEvent);

                        resolve(updatedEvent);
                    })
                    .catch(errors => {
                        reject(errors.response.data);
                    })
            })
        },
    }
});