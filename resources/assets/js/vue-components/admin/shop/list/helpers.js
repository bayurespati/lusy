import {store} from './store';

export default {

    getIndexOfShop(shopId) {
        return _.findIndex(store.state.items, function (shop) {
            return shop.id === shopId;
        });
    },
}