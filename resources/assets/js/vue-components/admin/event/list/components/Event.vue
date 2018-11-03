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
                    <div class="col col-xs-12">
                        <p class="small text-uppercase mb-0"><strong>Nama</strong></p>
                        <div class="detail">
                            <p class="mb-0">{{ event.title }}</p>
                        </div>
                    </div>


                    <!--=========================================================================================
                         S T A R T   D A T E
                        =========================================================================================-->
                    <div class="col col-xs-12">
                        <p class="small text-uppercase mb-0"><strong>Date</strong></p>
                        <div class="detail">
                            <p class="mb-0">{{ event.start_date }}</p>
                        </div>
                    </div>


                    <!--=========================================================================================
                        E N D  D A T E
                        =========================================================================================-->
                    <div class="col col-xs-12">
                        <p class="small text-uppercase mb-0"><strong>Date</strong></p>
                        <div class="detail">
                            <p class="mb-0">{{ event.start_date }}</p>
                        </div>
                    </div>


                    <!--=========================================================================================
                        L O C A T I O N
                        =========================================================================================-->
                    <div class="col col-xs-12">
                        <p class="small text-uppercase mb-0"><strong>Location</strong></p>
                        <div class="detail">
                            <p class="mb-0">{{ event.location }}</p>
                        </div>
                    </div>


                    <!--=========================================================================================
                        B U T T O N   A C T I O N
                        =========================================================================================-->
                    <div class="col-md-2 d-flex align-items-center justify-content-around">
                        <button type="button" 
                                class="btn btn-sm btn-warning"
                                @click="isEditingEvent = !isEditingEvent">EDIT</button>               
                        <button type="button" 
                                class="btn btn-sm btn-danger"
                                @click="deleteTheEvent">DELETE</button>
                        <button type="button" 
                                class="btn btn-sm btn-danger"
                                @click="">Image List</button>
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

    export default{
        props: {event: {}},

        components:{
            EditEvent
        },

        data() {
            return {
                isEditingEvent: false,
            }
        },

        methods:{

            deleteTheEvent() {
                const self = this;

                this.$store.dispatch('destroy_event', {
                    eventId: self.event.id
                })
                .then(() => {
                    self.isRequesting = false;

                    flash('Event berhasil dihapus', 'danger')
                })
            }
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
        line-height: 30px !important;
        vertical-align: middle !important;
        padding: 0 !important;
    }

    .f-24 {
        font-size: 24px !important;
    }
</style>