<template>
    <div class="card mt-3">
        <div class="card-block">

            <transition enterActiveClass="fade-in"
                        leaveActiveClass="fade-out"
                        mode="out-in">
                    <div class="row">

                    <!--=========================================================================================
                        I M A G E
                        =========================================================================================-->
                    <div class="col-md-2">
                        <img :src=getImage(shopItem) alt="image">
                    </div>


                    <!--=========================================================================================
                        S H O W    T I T L E
                        =========================================================================================-->
                    <div class="col-md-2 d-flex align-items-center">
                        <span>
                            <p class="small text-uppercase mb-0"><strong>Nama</strong></p>

                            <div class="detail">
                                <p class="mb-0">{{ shopItem.title }}</p>
                            </div>
                        </span>
                    </div>


                    <!--=========================================================================================
                        P R I C E
                        =========================================================================================-->
                    <div class="col-md-2 d-flex align-items-center">
                        <span>
                            <p class="small text-uppercase mb-0"><strong>Pirce</strong></p>
                            
                            <div class="detail">
                                <p class="mb-0">{{ shopItem.price }}</p>
                            </div>
                        </span>
                    </div>


                    <!--=========================================================================================
                        S T O C K
                        =========================================================================================-->
                    <div class="col-md-2 d-flex align-items-center">
                        <span>
                            <p class="small text-uppercase mb-0"><strong>Stock</strong></p>
                            
                            <div class="detail">
                                <p class="mb-0">{{ shopItem.stock }}</p>
                            </div>
                        </span>
                    </div>


                    <!--=========================================================================================
                        B U T T O N   A C T I O N
                        =========================================================================================-->
                    <div class="col-md-2 d-flex align-items-center justify-content-around">
                        <button type="button" 
                                v-if="this.shopItem.is_showcase == 0"
                                class="btn btn-sm btn-danger"
                                @click="editShop">Tampilkan</button>
                        <button type="button" 
                                v-else
                                class="btn btn-sm btn-success"
                                @click="editShop">Sembunyikan</button>               
                    </div>
                </div>
            </transition>
        </div>
    </div>
</template>

<script>
    export default{
        props: {shopItem: {}},

        data() {
            return {
                isEditingShop: false,
                isRequesting: false
            }
        },

        methods:{

            editShop(){

                const self = this;

                if (!this.isRequesting) {

                    this.isRequesting = true;

                    const updatedShop = {
                        id: this.shopItem.id,
                        is_showcase: !this.shopItem.is_showcase,
                    };

                    this.$store.dispatch('update_shop', updatedShop)

                        .then((updatedShop) => {

                            flash('Shop showcase Berhasil diperbaharui', 'success');

                            self.isRequesting = false;

                        })
                        .catch(errors => {
                            self.isRequesting = false;
                        });
                }
            },

            getImage($param){

                return $param.poster[0] === undefined ? '/img/welcome-1.jpg' : $param.poster[0].image_path;
            }

        }
    };
</script>

<style scoped>
    .card {
        border: 1px solid transparent !important;
    }

    img{
        max-width: 100%;
        max-height: 125px;
        border: 1px solid lightgrey;
    }

    .card-block{
        padding: 1em !important;
    }
    
    .detail {
        line-height: 30px !important;
        vertical-align: middle !important;
        padding: 0 !important;
    }
</style>