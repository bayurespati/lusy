import Vuex from 'vuex';

export const store = new Vuex.Store({

    //=========================================================================================
    //  S T A T E
    //=========================================================================================
    state: {
        regions:{},
    },


    //=========================================================================================
    //  G E T T E R S
    //=========================================================================================
    getters: {
        getRegions: state => {
            return state.regions;
        },
    },

    //=========================================================================================
    //  M U T A T I O N S
    //=========================================================================================
    mutations: {
        set_regions: (state, data) =>{
            state.regions = data
        },

        add_new_region(state, region){

            state.regions.push({
                id: region.id,
                name: region.detail.name,
                city: region.detail.city,
                address: region.detail.address
            });
        },

        edit_region(state, updatedRegion) {
            const regionIndex = _.findIndex(state.regions, ['id', updatedRegion.id]);

            state.regions[regionIndex].name = updatedRegion.name;
            state.regions[regionIndex].city = updatedRegion.city;
            state.regions[regionIndex].address = updatedRegion.address;
        },

        delete_region(state, ids){
            const regionIndex = _.findIndex(state.regions, ['id', ids.regionId])

            state.regions.splice(regionIndex, 1);
        },
    },

    //=========================================================================================
    //  A C T I O N S
    //=========================================================================================
    actions: {
        load_region: ({commit}) => {
            axios.get('/admin/bookkeeping/data/region')
                .then(response =>{
                    commit('set_regions',response.data);
                });
        },

        store_new_region({commit}, newRegion) {

            return new Promise((resolve, reject) => {

                axios.post('add/region', newRegion)
                    .then(response => {

                        const region = {
                            id: response.data,
                            detail: newRegion
                        };

                        commit('add_new_region', region);

                        resolve(region);
                    })
                    .catch(errors => {
                        reject(errors.response.data);
                    })
            })
        },

        update_region({commit}, updatedRegion) {

            return new Promise((resolve, reject) => {

                axios.patch('update/region/' + updatedRegion.id, {
                    id: updatedRegion.id,
                    name: updatedRegion.name,
                    city: updatedRegion.city,
                    address: updatedRegion.address              
                })
                    .then(response => {
                        commit('edit_region', updatedRegion);

                        resolve(updatedRegion);
                    })
                    .catch(errors => {
                        reject(errors.response.data);
                    })
            })
        },

        destroy_region({commit}, ids) {

            return new Promise((resolve, reject) => {

                axios.delete('delete/region/'+ids.regionId)
                    .then((response) => {
                        commit('delete_region', ids);

                        resolve();
                    });
            })
        },
    }
});