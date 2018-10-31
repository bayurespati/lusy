import Vuex from 'vuex';
import helpers from './helpers';

export const store = new Vuex.Store({

    //=========================================================================================
    //  S T A T E
    //=========================================================================================
    state: {
        subcategories:{},
    },


    //=========================================================================================
    //  G E T T E R S
    //=========================================================================================
    getters: {
        getSubcategories: state => {
            return state.subcategories;
        },
    },

    //=========================================================================================
    //  M U T A T I O N S
    //=========================================================================================
    mutations: {
        set_subcategories: (state, subcategories) =>{
            state.subcategories = subcategories;
        },

        edit_subcategory: (state,updatedSubcategory) =>{

        },

        edit_subcategory(state, updatedSubcategory) {

            const subcategoryIndex = helpers.getIndexOfSubcategory(updatedSubcategory.id);


            state.subcategory[subcategoryIndex].title = updatedSubcategory.title;
        },
    },

    //=========================================================================================
    //  A C T I O N S
    //=========================================================================================
    actions: {
        load_categories: ({commit}) => {
            axios.get('/admin/data/categories')
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