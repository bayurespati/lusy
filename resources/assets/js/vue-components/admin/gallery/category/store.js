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

        edit_category(state, updatedCategory) {

            const categoryIndex = helpers.getIndexOfCategory(updatedCategory.id);


            state.category[categoryIndex].title = updatedCategory.title;
        },
    },

    //=========================================================================================
    //  A C T I O N S
    //=========================================================================================
    actions: {
        load_categories: ({commit}) => {
            axios.get('/admin/data/category')
                .then(response =>{
                    commit('set_categories',response.data);
                });
        },

        update_category({commit}, updatedCategory) {

            return new Promise((resolve, reject) => {

                axios.patch('/admin/category/' + updatedCategory.id, {
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
    }
});