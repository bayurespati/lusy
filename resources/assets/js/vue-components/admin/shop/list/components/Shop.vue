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
                            <p class="mb-0">{{ shop.title }}</p>
                        </div>
                    </div>


                    <!--=========================================================================================
                         S T O C K
                        =========================================================================================-->
                    <div class="col col-xs-12">
                        <p class="small text-uppercase mb-0"><strong>Stock</strong></p>
                        <div class="detail">
                            <p class="mb-0">{{ shop.stock }}</p>
                        </div>
                    </div>


                    <!--=========================================================================================
                        P R I C E
                        =========================================================================================-->
                    <div class="col col-xs-12">
                        <p class="small text-uppercase mb-0"><strong>Price</strong></p>
                        <div class="detail">
                            <p class="mb-0">{{ shop.price }}</p>
                        </div>
                    </div>


                    <!--=========================================================================================
                        B U T T O N   A C T I O N
                        =========================================================================================-->
                    <div class="col-md-4 d-flex align-items-center justify-content-around">
                        <button type="button" 
                                class="btn btn-sm btn-warning"
                                @click="isEditingShop = !isEditingShop">EDIT</button>               
                        <button type="button" 
                                class="btn btn-sm btn-danger"
                                @click="deleteTheShop">DELETE</button>
                        <button type="button" 
                                class="btn btn-sm btn-danger"
                                @click="goTo">Image List</button>
                    </div>


                    <!--=========================================================================================
                        E D I T
                        =========================================================================================-->
                    <div class="col-md-12">
                        <edit-shop v-if="isEditingShop" :shop="shop"
                            @editionFormIsClosed="isEditingShop = $event">
                        </edit-shop>
                    </div>

                </div>
            </transition>
        </div>
    </div>
</template>

<script>
    import EditShop from './EditShop.vue';
    export default{
        props: {shop: {}},

        components:{
            EditShop
        },

        data() {
            return {
                isEditingShop: false,
            }
        },

        methods:{

            deleteTheShop() {
                const self = this;

                this.$store.dispatch('destroy_item', {
                    itemId: self.shop.id
                })
                .then(() => {
                    self.isRequesting = false;

                    flash('Shop item berhasil dihapus', 'danger')
                })
            },

            goTo(url){
                window.location.href = 'image/' + this.shop.id;
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
        line-height: 30px !important;
        vertical-align: middle !important;
        padding: 0 !important;
    }

    .f-24 {
        font-size: 24px !important;
    }
</style>
