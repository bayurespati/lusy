<template>
    <div class="card mt-3">
        <div class="card-block">

            <transition enterActiveClass="fade-in"
                        leaveActiveClass="fade-out"
                        mode="out-in">
                <div class="row">


                    <!--=========================================================================================
                        T I T L E
                        =========================================================================================-->
                    <div class="col-md-5 d-flex align-items-center">
                        <span>
                            <p class="small text-uppercase mb-0"><strong>Title</strong></p>
                            <div class="detail">
                                <p class="mb-0">{{ timeline.title }}</p>
                            </div>
                        </span>
                    </div>


                    <!--=========================================================================================
                        D A T E
                        =========================================================================================-->
                    <div class="col-md-5 d-flex align-items-center justify-content-center">
                        <span>
                            <p class="small text-uppercase text-center mb-0"><strong>Date</strong></p>
                            <div class="detail text-center">
                                <p class="mb-0">{{ timeline.date }}</p>
                            </div>
                        </span>
                    </div>


                    <!--=========================================================================================
                        B U T T O N   A C T I O N
                        =========================================================================================-->
                    <div class="col-md-2 d-flex align-items-center justify-content-end">
                        <button type="button" 
                                class="btn btn-sm btn-warning"
                                @click="isEditingTimeline = !isEditingTimeline">Edit</button>               
                        <button type="button" 
                                class="btn btn-sm btn-danger ml-2"
                                @click="deleteTheTimeline">Delete</button>
                    </div>


                    <!--=========================================================================================
                        E D I T
                        =========================================================================================-->
                    <div class="col-md-12">
                        <edit-timeline v-if="isEditingTimeline" :timeline="timeline"
                            @editionFormIsClosed="isEditingTimeline = $event">
                        </edit-timeline>
                    </div>

                </div>
            </transition>
        </div>
    </div>
</template>

<script>
    import EditTimeline from './EditTimeline.vue';

    export default{
        props: {timeline: {}},

        components:{
            EditTimeline
        },

        data() {
            return {
                isRequesting: false,
                isEditingTimeline: false,
            }
        },

        methods:{

            deleteTheTimeline() {
                const self = this;

                if(!self.isRequesting){

                    self.isRequesting = true;

                    this.$store.dispatch('destroy_timeline', this.timeline.id)
                    .then(() => {
                        self.isRequesting = false;

                        flash('Timeline deleted', 'danger')
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

    img{
        max-width: 100%;
        max-height: 125px;
        border: 1px solid lightgrey;
    }

    .card-block{
        padding: 1em !important;
    }
    
    .detail {
        line-height: 30px !important;
        vertical-align: middle !important;
        padding: 0 !important;
    }
</style>