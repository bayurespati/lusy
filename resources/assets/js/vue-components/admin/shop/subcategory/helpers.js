import {store} from './store';

export default {

    getIndexOfSubCategory(subcategoryId) {
        return _.findIndex(store.state.subcategories, function (subcategory) {
            return subcategory.id === subcategoryId;
        });
    },

    getIndexOfCategory(categoryId) {
        return _.findIndex(store.state.categories, function (category) {
            return category.id === categoryId;
        });
    },
}