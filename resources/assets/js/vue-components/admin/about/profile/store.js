import Vuex from 'vuex';
import helpers from './helpers';

export const store = new Vuex.Store({

    //=========================================================================================
    //  S T A T E
    //=========================================================================================
    state: {
        profile:{},
    },


    //=========================================================================================
    //  G E T T E R S
    //=========================================================================================
    getters: {
        getProfile: state => {
            return state.profile;
        },
    },

    //=========================================================================================
    //  M U T A T I O N S
    //=========================================================================================
    mutations: {
        set_profile: (state, profile) =>{
            state.profile = profile;
        },

        edit_profile(state, updatedProfile) {

            const profileIndex = helpers.getIndexOfProfile(updatedProfile.id);


            state.profile[profileIndex].image_path = updatedProfile.image_path;
            state.profile[profileIndex].title = updatedProfile.title;
            state.profile[profileIndex].content = updatedProfile.content;
        },
    },

    //=========================================================================================
    //  A C T I O N S
    //=========================================================================================
    actions: {
        load_profile: ({commit}) => {
            axios.get('/admin/data/profile')
                .then(response =>{
                    commit('set_profile',response.data);
                });
        },

        update_profile({commit}, updatedProfile) {

            return new Promise((resolve, reject) => {

                axios.patch('/admin/profile/' + updatedProfile.id, {
                    id: updatedProfile.id,
                    image_path: updatedProfile.image_path,
                    title: updatedProfile.title,
                    content: updatedProfile.content,
                })
                    .then(response => {
                        commit('edit_profile', updatedProfile);

                        resolve(updatedProfile);
                    })
                    .catch(errors => {
                        reject(errors.response.data);
                    })
            })
        },
    }
});