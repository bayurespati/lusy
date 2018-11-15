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
            state.profile.title = updatedProfile.title;
            state.profile.content = updatedProfile.content;
            state.profile.image_path = updatedProfile.image_path;
        },
    },

    //=========================================================================================
    //  A C T I O N S
    //=========================================================================================
    actions: {
        load_profile: ({commit}) => {
            axios.get('/admin/about/data/profile')
                .then(response =>{
                    commit('set_profile',response.data);
                });
        },

        update_profile({commit}, updatedProfile) {

            return new Promise((resolve, reject) => {

                axios.patch('update/profile/' + updatedProfile.id, {
                    id: updatedProfile.id,
                    title: updatedProfile.title,
                    content: updatedProfile.content,
                    image: updatedProfile.image
                })
                    .then(response => {

                        updatedProfile.image_path = response.data;

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