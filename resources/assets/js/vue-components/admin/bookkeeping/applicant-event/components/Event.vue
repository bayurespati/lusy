<template>
    <div class="card mt-3">

        <div class="card-block">

            <transition enterActiveClass="fade-in"
                        leaveActiveClass="fade-out"
                        mode="out-in">
                <div class="row">
                    <div class="col-3 d-flex align-items-center justify-content-start">
                        <div class="col-12">
                            <p class="small text-uppercase mb-0"><strong>Nama</strong></p>
                        
                            <div class="detail">
                                <p class="mb-0">{{ event.title }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-3 d-flex align-items-center justify-content-center">
                        <div class="col-12">
                            <p class="small text-uppercase mb-0 text-center"><strong>Lokasi</strong></p>
                            
                            <div class="detail">
                                <p class="mb-0 text-center">{{ event.location }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-2 d-flex align-items-center justify-content-center">
                        <div class="col-12">
                            <p class="small text-uppercase mb-0 text-center"><strong>Waktu Mulai</strong></p>
                            
                            <div class="detail">
                                <p class="mb-0 text-center">{{ event.start_date }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex align-items-center justify-content-center" 
                    :class="event.applicants.length > 0 ? 'col-2' : 'col-4'">
                        <div class="col-12">
                            <p class="small text-uppercase mb-0 text-center"><strong>Pendaftar</strong></p>
                        
                            <div class="detail">
                                <p class="mb-0 text-center">{{ event.applicants.length }}</p>
                            </div>
                        </div>
                    </div>

                    <div v-if="event.applicants.length > 0"
                    class="col-2 d-flex align-items-center justify-content-end">
                        <a :href="'/admin/bookkeeping/applicant-event/list/' + event.id">
                            <button type="button" 
                            class="btn btn-sm btn-primary">
                                <i class="fa fa-list"></i> Applicant List
                            </button>
                        </a>
                    </div>
                </div>
            </transition>
        </div>
    </div>
</template>

<script>
    export default{
        props:{event:{}},

        components:{
            
        },

        data(){
            return{
                isApprove: false
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

    .detail p {
        line-height: 20px !important;
        font-size: 14px;
    }

    .f-24 {
        font-size: 24px !important;
    }

    .bgSalmon {
        background: salmon;
    }
</style>