import {store} from './store';

export default {

    getIndexOfItems(itemId) {
        return _.findIndex(store.state.items, function (item) {
            return item.id === itemId;
        });
    },
}