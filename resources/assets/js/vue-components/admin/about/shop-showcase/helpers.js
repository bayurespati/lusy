import {store} from './store';

export default {

    getIndexOfShopShow(shopId) {
        return _.findIndex(store.state.shopShow, function (shop) {
            return shop.id === shopId;
        });
    },


    getIndexOfShopHide(shopId) {
        return _.findIndex(store.state.shopHide, function (shop) {
            return shop.id === shopId;
        });
    },
}