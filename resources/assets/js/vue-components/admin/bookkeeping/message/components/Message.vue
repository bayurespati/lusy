<template>
    <div class="card mt-3">
        <div class="card-block">
            <transition enterActiveClass="fade-in"
            leaveActiveClass="fade-out"
            mode="out-in">
                <div class="row">

                    <div class="col-4 d-flex justify-content-start align-items-center">
                        <div>
                            <p class="small text-uppercase mb-0">
                                <strong>Name</strong>
                            </p>
                        
                            <div class="detail">
                                <p class="mb-0">{{ messageContact.name }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-3 d-flex justify-content-center align-items-center">
                        <div>
                            <p class="small text-uppercase mb-0 text-center">
                                <strong>Email</strong>
                            </p>
                        
                            <div class="detail text-center">
                                <p class="mb-0 text-center">{{ messageContact.email }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-3 d-flex justify-content-center align-items-center">
                        <div>
                            <p class="small text-uppercase mb-0 text-center">
                                <strong>Phone</strong>
                            </p>
                        
                            <div class="detail text-center">
                                <p class="mb-0">{{ messageContact.phone }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-2 d-flex align-items-center justify-content-end">
                        <button type="button" 
                        class="btn btn-sm btn-warning"
                        @click="isReplay = !isReplay">Reply</button>
                    </div>

                    <div class="col-md-12">
                        <replay v-if="isReplay" :messageContact="messageContact"
                                @closeReplay="isReplay = $event"> 
                        </replay>
                    </div>
                </div>
            </transition>
        </div>
    </div>
</template>

<script>
    import Replay from './Replay.vue';
    export default{
        props:{messageContact:{}},

        components:{
            Replay,
        },

        data(){
            return{
                isReplay: false
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