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

        edit_subcategory(state, updatedSubcategory) {

            const subcategoryIndex = helpers.getIndexOfSubcategory(updatedSubcategory.id);


            state.subcategory[subcategoryIndex].title = updatedSubcategory.title;
        },
    },

    //=========================================================================================
    //  A C T I O N S
    //=========================================================================================
    actions: {
        load_subcategories: ({commit}) => {
            axios.get('/admin/data/subcategory')
                .then(response =>{
                    commit('set_subcategories',response.data);
                });
        },

        update_category({commit}, updatedSubcategory) {

            return new Promise((resolve, reject) => {

                axios.patch('/admin/subcategory/' + updatedSubcategory.id, {
                    id: updatedSubcategory.id,
                    title: updatedSubcategory.title,                
                })
                    .then(response => {
                        commit('edit_subcategory', updatedSubcategory);

                        resolve(updatedSubcategory);
                    })
                    .catch(errors => {
                        reject(errors.response.data);
                    })
            })
        },
    }
});