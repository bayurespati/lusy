import {store} from './store';

export default {

    getIndexOfPotensial(potensialId) {
        return _.findIndex(store.state.potentials, function (potensial) {
            return potensial.id === potensialId;
        });
    },
}