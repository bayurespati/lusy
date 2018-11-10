import {store} from './store';

export default {

    getIndexOfMessage(messageId) {
        return _.findIndex(store.state.items, function (message) {
            return message.id === messageId;
        });
    },
}