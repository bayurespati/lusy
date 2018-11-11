import Vuex from 'vuex';

export const store = new Vuex.Store({

    //=========================================================================================
    //  S T A T E
    //=========================================================================================
    state: {
        imageConfig:{},
    },


    //=========================================================================================
    //  G E T T E R S
    //=========================================================================================
    getters: {
        getImageConfig: state => {
            return state.imageConfig;
        }
    },

    //=========================================================================================
    //  M U T A T I O N S
    //=========================================================================================
    mutations: {
        set_image_config: (state, imageConfig) =>{
            state.imageConfig = imageConfig;
        },

        update_image(state, updatedImage) {

            const imageIndex = _.findIndex(state.imageConfig,['id',updatedImage.id ])

            state.imageConfig[imageIndex].image_path = updatedImage.image_path;
        }
    },

    //=========================================================================================
    //  A C T I O N S
    //=========================================================================================
    actions: {
        load_image_config: ({commit}) => {
            axios.get('/admin/data/image-config')
                .then(response =>{
                    commit('set_image_config',response.data);
                });
        },

        update_image({commit}, updatedImage) {

            return new Promise((resolve, reject) => {

                axios.patch('update/image-config/' + updatedImage.id, {
                    id: updatedImage.id,
                    image: updatedImage.image,
                })
                    .then(response => {

                        commit('update_image', response.data);

                        resolve(response.data);
                    })
                    .catch(errors => {
                        reject(errors.response.data);
                    })
            })
        },

    }

});