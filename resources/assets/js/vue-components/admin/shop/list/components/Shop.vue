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
                    <div class="col-md-4 col-xs-12 d-flex align-items-center">
                        <span>
                            <p class="small text-uppercase mb-0"><strong>Name</strong></p>
                            
                            <div class="detail">
                                <p class="mb-0">{{ shop.title }}</p>
                            </div>
                        </span>
                    </div>


                    <!--=========================================================================================
                        P R I C E
                        =========================================================================================-->
                    <div class="col-md-3 col-xs-12 d-flex align-items-center">
                        <div class="col-12">
                            <p class="small text-uppercase mb-0"><strong>Price</strong></p>
                            
                            <div class="detail">
                                <p class="mb-0">{{ shop.price }}</p>
                            </div>
                        </div>
                    </div>


                    <!--=========================================================================================
                         S T O C K
                        =========================================================================================-->
                    <div class="col-md-2 col-xs-12 d-flex align-items-center justify-content-center">
                        <div class="col-12 text-center">
                            <p class="small text-uppercase mb-0"><strong>Stock</strong></p>
                            
                            <div class="detail">
                                <p class="mb-0">{{ shop.stock }}</p>
                            </div>
                        </div>
                    </div>


                    <!--=========================================================================================
                        B U T T O N   A C T I O N
                        =========================================================================================-->
                    <div class="col-md-3 d-flex align-items-center justify-content-end">
                        <a :href="'list/image/' + shop.id">
                            <button type="button" 
                            class="btn btn-sm btn-primary">
                                <i class="fa fa-image"></i>
                            </button>
                        </a>

                        <button type="button" 
                                class="btn btn-sm btn-warning ml-1"
                                @click="isEditingShop = !isEditingShop">
                            Edit
                        </button>               
                        
                        <button type="button" 
                                class="btn btn-sm btn-danger ml-1"
                                @click="deleteTheShop">
                            Delete
                        </button>
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
                isRequesting: false,
                isEditingShop: false,
            }
        },

        methods:{

            deleteTheShop() {
                const self = this;

                if(!self.isRequesting){

                    self.isRequesting = true;

                    this.$store.dispatch('destroy_item', {
                        itemId: self.shop.id
                    })
                    .then(() => {
                        self.isRequesting = false;

                        flash('Item is successfuly deleted', 'danger')
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
        line-height: 30px !important;
        vertical-align: middle !important;
        padding: 0 !important;
    }

    .f-24 {
        font-size: 24px !important;
    }
</style>
