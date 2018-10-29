import {store} from './store';

export default {

    getIndexOfSosmed(sosmedId) {
        return _.findIndex(store.state.sosmeds, function (sosmed) {
            return sosmed.id === sosmedId;
        });
    },
}