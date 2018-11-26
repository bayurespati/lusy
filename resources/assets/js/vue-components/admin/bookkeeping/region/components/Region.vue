<template>
    <div class="card mt-3">
        <div class="card-block">
            <transition enterActiveClass="fade-in" leaveActiveClass="fade-out" mode="out-in">
                <div class="row">

                    <div class="col-3 d-flex justify-content-start align-items-center">
                        <div>
                            <p class="small text-uppercase mb-0">
                                <strong>Name</strong>
                            </p>
                            
                            <div class="detail">
                                <p class="mb-0">{{ region.name }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-5 d-flex justify-content-center align-items-center">
                        <div>
                            <p class="small text-uppercase mb-0 text-center">
                                <strong>Address</strong>
                            </p>
                            
                            <div class="detail text-center">
                                <p class="mb-0">{{ region.address }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-2 d-flex align-items-center justify-content-end">
                        <button type="button" 
                        class="btn btn-danger btn-sm"
                        @click="deleteItems">
                            Delete
                        </button>

                        <button type="button" 
                        class="btn btn-warning btn-sm ml-2"
                        @click="isEditRegion = !isEditRegion">
                            Edit
                        </button>

                    </div>

                    <div class="col-md-12">
                        <edit-region v-if="isEditRegion" :region="region"
                            @editionFormIsClosed="isEditRegion = $event">
                        </edit-region>
                    </div>
                </div>
            </transition>
        </div>
    </div>
</template>

<script>
    import EditRegion from './EditRegion.vue';
    export default{
        props:{region:{}},

        components:{
            EditRegion,
        },

        data(){
            return{
                isRequsting: false,
                isEditRegion: false
            }
        },

        methods:{

            deleteItems(){

                let self = this;

                if(!self.isRequsting){

                    self.isRequsting = true;

                    this.$store.dispatch('destroy_region',{
                        regionId : self.region.id
                    })
                    .then(() => {
                        flash('Region deleted', 'danger');

                        self.isRequsting = false;
                    })
                }
            }
        }
    };
</script>
<style scoped>
    .card {
        border: 1px solid transparent !important;
    }

    .card-block{
        padding: 1em !important;
    }
    
    .detail {
        line-height: 30px !important;
        vertical-align: middle !important;
        padding: 0 !important;
    }

    .f-24 {
        font-size: 24px !important;
    }

    .bgSalmon {
        background: salmon;
    }

    .max-lines{
      text-overflow: ellipsis;
      max-width: 80ch;
      overflow: hidden;
      white-space: nowrap;
    }
</style>