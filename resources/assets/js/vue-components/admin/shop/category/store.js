import Vuex from 'vuex';
import helpers from './helpers';

export const store = new Vuex.Store({

    //=========================================================================================
    //  S T A T E
    //=========================================================================================
    state: {
        categories:{},
    },


    //=========================================================================================
    //  G E T T E R S
    //=========================================================================================
    getters: {
        getCategories: state => {
            return state.categories;
        },
    },

    //=========================================================================================
    //  M U T A T I O N S
    //=========================================================================================
    mutations: {
        set_categories: (state, categories) =>{
            state.categories = categories;
        },

        add_new_category(state, category){
            state.categories.push({
                id: category.id,
                title: category.detail.title,
                type: 1
            });
        },

        edit_category(state, updatedCategory) {

            const categoryIndex = helpers.getIndexOfCategory(updatedCategory.id);


            state.categories[categoryIndex].title = updatedCategory.title;
        },

        delete_category(state, ids){
            const categoryIndex = helpers.getIndexOfCategory(ids.categoryId);

            state.categories.splice(categoryIndex, 1);
        },
    },

    //=========================================================================================
    //  A C T I O N S
    //=========================================================================================
    actions: {
        load_categories: ({commit}) => {
            axios.get('/admin/shop/data/category')
                .then(response =>{
                    commit('set_categories',response.data);
                });
        },

        store_new_category({commit}, newCategory) {

            return new Promise((resolve, reject) => {

                axios.post('add/category', newCategory)
                    .then(response => {

                        const category = {
                            id: response.data,
                            detail: newCategory
                        };

                        commit('add_new_category', category);

                        resolve(category);
                    })
                    .catch(errors => {
                        reject(errors.response.data);
                    })
            })
        },

        update_category({commit}, updatedCategory) {

            return new Promise((resolve, reject) => {

                axios.patch('update/category/' + updatedCategory.id, {
                    id: updatedCategory.id,
                    title: updatedCategory.title,                
                })
                    .then(response => {
                        commit('edit_category', updatedCategory);

                        resolve(updatedCategory);
                    })
                    .catch(errors => {
                        reject(errors.response.data);
                    })
            })
        },


        destroy_category({commit}, ids) {

            return new Promise((resolve, reject) => {

                axios.delete('delete/category/'+ids.categoryId)
                    .then((response) => {
                        commit('delete_category', ids);
                        resolve();
                    });
            })
        },
    }
});