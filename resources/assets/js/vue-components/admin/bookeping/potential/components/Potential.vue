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
                            <p class="mb-0">{{ potential.buyer_name }}</p>
                        </div>
                    </div>


                    <!--=========================================================================================
                        S H O W    L I N K
                        =========================================================================================-->
                    <div class="col">
                        <p class="small text-uppercase mb-0"><strong>Email</strong></p>
                        <div class="detail">
                            <p class="mb-0 max-lines">{{ potential.email }}</p>
                        </div>
                    </div>


                    <!--=========================================================================================
                        S H O W    C I T Y
                        =========================================================================================-->
                    <div class="col">
                        <p class="small text-uppercase mb-0"><strong>City</strong></p>
                        <div class="detail max-lines">
                            <p class="mb-0">{{ potential.city }}</p>
                        </div>
                    </div>


                    <!--=========================================================================================
                        S H O W   Q U A N T I T Y
                        =========================================================================================-->
                    <div class="col">
                        <p class="small text-uppercase mb-0"><strong>Quantity</strong></p>
                        <div class="detail max-lines">
                            <p class="mb-0">{{ potential.quantity }}</p>
                        </div>
                    </div>


                    <!--=========================================================================================
                        S H O W   S T A T U S
                        =========================================================================================-->
                    <div class="col">
                        <p class="small text-uppercase mb-0"><strong>Satus</strong></p>
                        <div class="detail max-lines">
                            <button class="btn btn-outline-primary btn-sm" v-if="potential.is_confirmed === 1"> Approve </button>
                            <button @click="updated" class="btn btn-outline-warning btn-sm" v-else=""> Waiting </button>
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
                        <detail v-if="isShowDetail" :detail="potential"
                            @closeDetail="isShowDetail = $event">
                        </detail>
                    </div>

                </div>
            </transition>
        </div>
    </div>
</template>

<script>
    import Detail from './Detail.vue'
    export default{
        props:{potential:{}},

        data(){
            return{
                isShowDetail: false,
            }
        },

        components:{
            Detail
        },

        methods:{
            updated(){

                const self = this;

                if (true) {

                    const updatedPotential = {
                        id: this.potential.id,
                        is_confirmed: !this.potential.is_confirmed,
                    };

                    this.$store.dispatch('update_potential', updatedPotential)                        

                        .then((updatedPotential) => {

                            flash('Potential Inquiry accepted', 'success');
                        })
                        .catch(errors => {

                        });
                }
            },

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