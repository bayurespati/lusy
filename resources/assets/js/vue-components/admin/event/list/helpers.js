import {store} from './store';

export default {

    getIndexOfEvent(eventId) {
        return _.findIndex(store.state.events, function (event) {
            return event.id === eventId;
        });
    },
}