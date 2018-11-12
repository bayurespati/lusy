<template>
    <div class="card mt-3">
        <div class="card-block">
            <transition enterActiveClass="fade-in"
                        leaveActiveClass="fade-out"
                        mode="out-in">
                <div class="row">

                    <div class="col-3 d-flex justify-content-start align-items-center">
                        <div>
                            <p class="small text-uppercase mb-0">
                                <strong>Nama</strong>
                            </p>
                            
                            <div class="detail">
                                <p class="mb-0">{{ overseas.buyer_name }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-3 d-flex justify-content-center align-items-center">
                        <div>
                            <p class="small text-uppercase mb-0 text-center">
                                <strong>Email</strong>
                            </p>
                            
                            <div class="detail">
                                <p class="mb-0 text-center">{{ overseas.email }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-3 d-flex justify-content-center align-items-center">
                        <div>
                            <p class="small text-uppercase mb-0 text-center">
                                <strong>Kota</strong>
                            </p>
                            
                            <div class="detail text-center">
                                <p class="mb-0">{{ overseas.city }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-1 d-flex justify-content-center align-items-center">
                        <div>
                            <p class="small text-uppercase mb-0 text-center">
                                <strong>Qty</strong>
                            </p>
                            
                            <div class="detail text-center">
                                <p class="mb-0">{{ overseas.quantity }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-2 d-flex align-items-center justify-content-end">
                        <button type="button" 
                        class="btn btn-danger btn-sm"
                        @click="deleteItems">
                            Hapus
                        </button>

                        <button type="button" 
                        class="btn btn-warning btn-sm ml-2"
                        @click="isShowDetail = !isShowDetail">
                            Detail
                        </button>

                    </div>

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
    import Detail from './Detail.vue';
    export default{
        props:{overseas:{}},

        components:{
            Detail,
        },

        data(){
            return{
                isShowDetail: false
            }
        },

        methods:{

            deleteItems(){

                let self = this;

                this.$store.dispatch('destroy_item',{
                    itemId : self.overseas.id
                })
                .then(() => {
                    flash('Inqury berhasil dihapus', 'danger')
                })
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