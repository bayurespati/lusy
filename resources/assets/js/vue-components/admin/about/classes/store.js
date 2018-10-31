import Vuex from 'vuex';
import helpers from './helpers';

export const store = new Vuex.Store({

    //=========================================================================================
    //  S T A T E
    //=========================================================================================
    state: {
        classes:{},
    },


    //=========================================================================================
    //  G E T T E R S
    //=========================================================================================
    getters: {
        getClasses: state => {
            return state.classes;
        },
    },

    //=========================================================================================
    //  M U T A T I O N S
    //=========================================================================================
    mutations: {
        set_classes: (state, classes) =>{
            state.classes = classes;
        },

        edit_class(state, updatedClass) {

            const classIndex = helpers.getIndexOfClass(updatedClass.id);


            state.classes[classIndex].image_path = updatedClass.image_path;
            state.classes[classIndex].title = updatedClass.title;
            state.classes[classIndex].content = updatedClasses.content;
        },
    },

    //=========================================================================================
    //  A C T I O N S
    //=========================================================================================
    actions: {
        load_classes: ({commit}) => {
            axios.get('/admin/data/class')
                .then(response =>{
                    commit('set_classes',response.data);
                });
        },

        update_sosmed({commit}, updatedClass) {

            return new Promise((resolve, reject) => {

                axios.patch('/admin/class/' + updatedClass.id, {
                    id: updatedClass.id,
                    image_path: updatedClass.image_path,
                    title: updatedClass.title,
                    content: updatedClass.content,
                })
                    .then(response => {
                        commit('edit_class', updatedClass);

                        resolve(updatedClass);
                    })
                    .catch(errors => {
                        reject(errors.response.data);
                    })
            })
        },
    }
});