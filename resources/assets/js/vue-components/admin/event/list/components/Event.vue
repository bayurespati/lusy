<template>
    <div class="card mt-3">
        <div class="card-block">

            <transition enterActiveClass="fade-in"
                        leaveActiveClass="fade-out"
                        mode="out-in">
                <div class="row">

                    <!--=========================================================================================
                        S H O W    T I T L E
                        =========================================================================================-->
                    <div class="col-md-3 col-xs-12 d-flex align-items-center">
                        <span>
                            <p class="small text-uppercase mb-0"><strong>Title</strong></p>
                        
                            <div class="detail">
                                <p class="mb-0">{{ event.title }}</p>
                            </div>
                        </span>
                    </div>


                    <!--=========================================================================================
                         S T A R T   D A T E
                        =========================================================================================-->
                    <div class="col-md-2 col-xs-12 d-flex align-items-center">
                        <span>
                            <p class="small text-uppercase mb-0"><strong>Start Date</strong></p>
                        
                            <div class="detail">
                                <p class="mb-0">{{ event.start_date }}</p>
                            </div>
                        </span>
                    </div>


                    <!--=========================================================================================
                        E N D  D A T E
                        =========================================================================================-->
                    <div class="col-md-2 col-xs-12 d-flex align-items-center">
                        <span>
                            <p class="small text-uppercase mb-0"><strong>End Date</strong></p>
                            <div class="detail">
                                <p class="mb-0">{{ event.end_date }}</p>
                            </div>
                        </span>
                    </div>


                    <!--=========================================================================================
                        L O C A T I O N
                        =========================================================================================-->
                    <div class="col-md-3 col-xs-12 d-flex align-items-center">
                        <span>
                            <p class="small text-uppercase mb-0"><strong>Location</strong></p>
                        
                            <div class="detail">
                                <p class="mb-0">{{ event.location }}</p>
                            </div>
                        </span>
                    </div>


                    <!--=========================================================================================
                        B U T T O N   A C T I O N
                        =========================================================================================-->
                    <div class="col-md-2 d-flex align-items-center justify-content-end">
                        <a :href="'list/image/' + event.id">
                            <button type="button" 
                            class="btn btn-sm btn-primary">
                                <i class="fa fa-image"></i>
                            </button>
                        </a>
                        <button type="button" 
                                class="btn btn-sm btn-warning ml-1"
                                @click="isEditingEvent = !isEditingEvent">
                            Edit
                        </button>               
                        <button type="button" 
                                class="btn btn-sm btn-danger ml-1"
                                @click="deleteTheEvent">
                            Delete
                        </button>
                    </div>


                    <!--=========================================================================================
                        E D I T
                        =========================================================================================-->
                    <div class="col-md-12">
                        <edit-event v-if="isEditingEvent" :event="event"
                            @editionFormIsClosed="isEditingEvent = $event">
                        </edit-event>
                    </div>

                </div>
            </transition>
        </div>
    </div>
</template>

<script>
    import EditEvent from './EditEvent.vue';
    export default{
        props: {event: {}},

        components:{
            EditEvent
        },

        data() {
            return {
                isRequesting: false,
                isEditingEvent: false,
            }
        },

        methods:{

            deleteTheEvent() {
                const self = this;

                if(!self.isRequesting){

                    self.isRequesting = true;

                    this.$store.dispatch('destroy_event', {
                        eventId: self.event.id
                    })
                    .then(() => {

                        self.isRequesting = false;

                        flash('Event deleted', 'danger')
                    })
                }
            },
        }
    };
</script>
<style scoped>
    .card {
        border: 1px solid transparent !important;
    }

    .boxImage{
        width: 50px;
        height: 50px;
    }

    img{
        max-width: 100%;
        height: auto;
    }

    .card-block{
        padding: 1em !important;
    }
    
    .detail {
        vertical-align: middle !important;
        padding: 0 !important;
    }

    .detail p {
        line-height: 20px !important;
        font-size: 14px;
    }
</style>