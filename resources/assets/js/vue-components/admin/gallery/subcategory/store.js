import Vuex from 'vuex';
import helpers from './helpers';

export const store = new Vuex.Store({

    //=========================================================================================
    //  S T A T E
    //=========================================================================================
    state: {
        subcategories:{},
        categories:{}
    },


    //=========================================================================================
    //  G E T T E R S
    //=========================================================================================
    getters: {
        getSubcategories: state => {
            return state.subcategories;
        },

        getCategories: state => {
            return state.categories;
        },

    },

    //=========================================================================================
    //  M U T A T I O N S
    //=========================================================================================
    mutations: {
        set_subCategories: (state, data) =>{
            state.subcategories = data[0];
            state.categories = data[1];
        },

        add_new_subcategory(state, subCategory){
            state.subcategories.push({
                id: subCategory.id,
                title: subCategory.detail.title,
                category_id: subCategory.detail.category_id
            });
        },

        edit_subcategory(state, updatedSubcategory) {

            const subcategoryIndex = helpers.getIndexOfSubCategory(updatedSubcategory.id);

            state.subcategories[subcategoryIndex].title = updatedSubcategory.title;
            state.subcategories[subcategoryIndex].category_id = updatedSubcategory.category_id;
        },

        delete_subcategory(state, ids){
            const subcategoryIndex = helpers.getIndexOfSubCategory(ids.subcategoryId);

            state.subcategories.splice(subcategoryIndex, 1);
        },
    },

    //=========================================================================================
    //  A C T I O N S
    //=========================================================================================
    actions: {
        load_subCategories: ({commit}) => {
            axios.get('/admin/gallery/data/subcategory')
                .then(response =>{
                    commit('set_subCategories',response.data);
                });
        },

        store_new_subcategory({commit}, newSubCategory) {

            return new Promise((resolve, reject) => {

                axios.post('add/subcategory', newSubCategory)
                    .then(response => {

                        const subcategory = {
                            id: response.data,
                            detail: newSubCategory
                        };

                        commit('add_new_subcategory', subcategory);

                        resolve(subcategory);
                    })
                    .catch(errors => {
                        reject(errors.response.data);
                    })
            })
        },


        update_subcategory({commit}, updatedSubcategory) {

            return new Promise((resolve, reject) => {

                axios.patch('update/subcategory/' + updatedSubcategory.id, {
                    id: updatedSubcategory.id,
                    title: updatedSubcategory.title,
                    category_id: updatedSubcategory.category_id              
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

        destroy_subcategory({commit}, ids) {

            return new Promise((resolve, reject) => {

                axios.delete('delete/subcategory/'+ids.subcategoryId)
                    .then((response) => {
                        commit('delete_subcategory', ids);

                        resolve();
                    });
            })
        },
    }
});