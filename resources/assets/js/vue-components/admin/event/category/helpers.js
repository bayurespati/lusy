import {store} from './store';

export default {

    getIndexOfCategory(categoryId) {
        return _.findIndex(store.state.categories, function (category) {
            return category.id === categoryId;
        });
    },
}