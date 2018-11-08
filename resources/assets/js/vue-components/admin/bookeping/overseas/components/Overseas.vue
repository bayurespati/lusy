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
                            <p class="mb-0">{{ overseas.buyer_name }}</p>
                        </div>
                    </div>


                    <!--=========================================================================================
                        S H O W    L I N K
                        =========================================================================================-->
                    <div class="col">
                        <p class="small text-uppercase mb-0"><strong>Email</strong></p>
                        <div class="detail">
                            <p class="mb-0 max-lines">{{ overseas.email }}</p>
                        </div>
                    </div>


                    <!--=========================================================================================
                        S H O W    C I T Y
                        =========================================================================================-->
                    <div class="col">
                        <p class="small text-uppercase mb-0"><strong>City</strong></p>
                        <div class="detail max-lines">
                            <p class="mb-0">{{ overseas.city }}</p>
                        </div>
                    </div>


                    <!--=========================================================================================
                        S H O W   Q U A N T I T Y
                        =========================================================================================-->
                    <div class="col">
                        <p class="small text-uppercase mb-0"><strong>Quantity</strong></p>
                        <div class="detail max-lines">
                            <p class="mb-0">{{ overseas.quantity }}</p>
                        </div>
                    </div>


                    <!--=========================================================================================
                        S H O W   S T A T U S
                        =========================================================================================-->
                    <div class="col">
                        <p class="small text-uppercase mb-0"><strong>Satus</strong></p>
                        <div class="detail max-lines">
                            <button class="btn btn-outline-primary btn-sm" v-if="overseas.is_confirmed === 1"> Approve </button>
                            <button class="btn btn-outline-warning btn-sm" v-else=""> Waiting </button>
                        </div>
                    </div>


                    <!--=========================================================================================
                        B U T T O N   E D I T
                        =========================================================================================-->
                    <div class="col align-items-center justify-content-end">
                        <button type="button" 
                                class="btn btn-sm btn-warning"
                                @click="isShowDetail = !isShowDetail">Detail</button>
                    </div>


                    <!--=========================================================================================
                        D E T A I L
                        =========================================================================================-->
                    <div class="col-md-12">
                        <detail v-if="isShowDetail" :detail="overseas"
                            @closeDetail="isShowDetail = $event">
                        </detail>
                    </div>
                </div>
            </transition>
        </div>
    </div>
</template>

<script>
    import Detail from '../../potential/components/Detail.vue';
    export default{
        props:{overseas:{}},

        components:{
            Detail,
        },

        data(){
            return{
                isShowDetail: false
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