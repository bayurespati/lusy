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

        add_new_class(state, classData){

            state.classes.push({
                id: classData.id,
                image_path: classData.image_path,
                title: classData.title,
                content: classData.content
            });
        },

        edit_class(state, updatedClass) {

            const classIndex = helpers.getIndexOfClass(updatedClass.id);

            state.classes[classIndex].image_path = updatedClass.image_path;
            state.classes[classIndex].title = updatedClass.title;
            state.classes[classIndex].content = updatedClass.content;
        },

        delete_class(state, ids){
            const classIndex = helpers.getIndexOfClass(ids.classId);
            state.classes.splice(classIndex, 1);
        },

    },

    //=========================================================================================
    //  A C T I O N S
    //=========================================================================================
    actions: {
        load_classes: ({commit}) => {
            axios.get('/admin/about/data/class')
                .then(response =>{
                    commit('set_classes',response.data);
                });
        },

        store_new_class({commit}, addClass) {

            return new Promise((resolve, reject) => {

                axios.post('add/class', addClass)
                    .then(response => {

                        commit('add_new_class', response.data);

                        resolve(response.data);
                    })
                    .catch(errors => {
                        reject(errors.response.data);
                    })
            })
        },

        update_class({commit}, updatedClass) {

            return new Promise((resolve, reject) => {

                axios.patch('update/class/' + updatedClass.id, {
                    id: updatedClass.id,
                    image: updatedClass.image,
                    title: updatedClass.title,
                    content: updatedClass.content,
                })
                    .then(response => {

                        commit('edit_class', response.data);

                        resolve(response.data);
                    })
                    .catch(errors => {
                        reject(errors.response.data);
                    })
            })
        },

        destroy_class({commit}, ids) {

            return new Promise((resolve, reject) => {

                axios.delete('delete/class/'+ids.classId)
                    .then((response) => {
                        commit('delete_class', ids);
                        resolve();
                    });
            })
        },
    }
});