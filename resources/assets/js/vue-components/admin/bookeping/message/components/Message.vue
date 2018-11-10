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
                    <div class="col">
                        <p class="small text-uppercase mb-0"><strong>Name</strong></p>
                        <div class="detail">
                            <p class="mb-0">{{ messageContact.name }}</p>
                        </div>
                    </div>


                    <!--=========================================================================================
                        S H O W    L I N K
                        =========================================================================================-->
                    <div class="col">
                        <p class="small text-uppercase mb-0"><strong>Email</strong></p>
                        <div class="detail">
                            <p class="mb-0 max-lines">{{ messageContact.email }}</p>
                        </div>
                    </div>


                    <!--=========================================================================================
                        S H O W    C I T Y
                        =========================================================================================-->
                    <div class="col">
                        <p class="small text-uppercase mb-0"><strong>Phone</strong></p>
                        <div class="detail max-lines">
                            <p class="mb-0">{{ messageContact.phone }}</p>
                        </div>
                    </div>


                    <!--=========================================================================================
                        B U T T O N   E D I T
                        =========================================================================================-->
                    <div class="col align-items-center justify-content-end">
                        <button type="button" 
                                class="btn btn-sm btn-warning"
                                @click="isReplay = !isReplay">Replay</button>
                    </div>


                    <!--=========================================================================================
                        D E T A I L
                        =========================================================================================-->
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