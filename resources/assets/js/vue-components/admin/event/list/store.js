import Vuex from 'vuex';
import helpers from './helpers';

export const store = new Vuex.Store({

    //=========================================================================================
    //  S T A T E
    //=========================================================================================
    state: {
        events:{},
        categories: {},
        subcategories:{}
    },


    //=========================================================================================
    //  G E T T E R S
    //=========================================================================================
    getters: {
        getEvents: state => {
            return state.events;
        },

        getCategories: state => {
            return state.categories;
        },

        getSubcategories: state =>{
            return state.subcategories;
        }
    },

    //=========================================================================================
    //  M U T A T I O N S
    //=========================================================================================
    mutations: {
        set_events: (state, events) =>{
            state.events = events[0];
            state.categories = events[1];
            state.subcategories = events[2];
        },

        add_new_event(state, event){
            state.events.push({
                id: event.id,
                title: event.detail.title,
                sub_category_id: event.detail.sub_category_id,
                start_date: event.start_date,
                end_date: event.end_date,
                location: event.detail.location,
                address: event.detail.address,
                organiser: event.detail.organiser,
                content: event.detail.content,
            });
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
            state.events[eventIndex].sub_category_id = updatedEvent.sub_category_id;
        },

        delete_event(state, ids){
            const eventIndex = helpers.getIndexOfEvent(ids.eventId);

            state.events.splice(eventIndex, 1);
        },

    },

    //=========================================================================================
    //  A C T I O N S
    //=========================================================================================
    actions: {
        load_events: ({commit}) => {
            axios.get('/admin/event/data/list')
                .then(response =>{
                    commit('set_events',response.data);
                });
        },

        store_new_event({commit}, newEvent) {

            return new Promise((resolve, reject) => {

                axios.post('add/list', {
                    id: newEvent.id,
                    title: newEvent.title,
                    start_date: newEvent.start_date.substring(0,19).replace("T", " "),
                    end_date: newEvent.end_date.substring(0,19).replace("T", " "),
                    location: newEvent.location,
                    address: newEvent.address,
                    organiser: newEvent.organiser,
                    sub_category_id: newEvent.sub_category_id,
                    content: newEvent.content,
                })
                    .then(response => {

                        const event = {
                            id: response.data,
                            start_date : newEvent.start_date.substring(0,19).replace("T", " "),
                            end_date : newEvent.end_date.substring(0,19).replace("T", " "),
                            detail: newEvent
                        };

                        commit('add_new_event', event);

                        resolve(event);
                    })
                    .catch(errors => {
                        reject(errors.response.data);
                    })
            })
        },

        update_event({commit}, updatedEvent) {

            return new Promise((resolve, reject) => {

                axios.patch('update/list/' + updatedEvent.id, {
                    id: updatedEvent.id,
                    title: updatedEvent.title,
                    start_date: updatedEvent.start_date,
                    end_date: updatedEvent.end_date,
                    location: updatedEvent.location,
                    address: updatedEvent.address,
                    organiser: updatedEvent.organiser,
                    sub_category_id: updatedEvent.sub_category_id,
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

        destroy_event({commit}, ids) {

            return new Promise((resolve, reject) => {

                axios.delete('delete/list/'+ids.eventId)
                    .then((response) => {
                        commit('delete_event', ids);
                        resolve();
                    });
            })
        },
    }
});