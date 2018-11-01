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
                    <div class="boxImage">
                        <img :src=galleryImage.image_path alt="image">
                    </div>


                    <!--=========================================================================================
                        S H O W    T I T L E
                        =========================================================================================-->
                    <div class="col col-xs-12">
                        <p class="small text-uppercase mb-0"><strong>Nama</strong></p>
                        <div class="detail">
                            <p class="mb-0">{{ galleryImage.title }}</p>
                        </div>
                    </div>


                    <!--=========================================================================================
                        D A T E
                        =========================================================================================-->
                    <div class="col col-xs-12">
                        <p class="small text-uppercase mb-0"><strong>Date</strong></p>
                        <div class="detail">
                            <p class="mb-0">{{ galleryImage.date }}</p>
                        </div>
                    </div>


                    <!--=========================================================================================
                        L O C A T I O N
                        =========================================================================================-->
                    <div class="col col-xs-12">
                        <p class="small text-uppercase mb-0"><strong>Location</strong></p>
                        <div class="detail">
                            <p class="mb-0">{{ galleryImage.location }}</p>
                        </div>
                    </div>


                    <!--=========================================================================================
                        C R E A T O R
                        =========================================================================================-->
                    <div class="col col-xs-12">
                        <p class="small text-uppercase mb-0"><strong>Creator</strong></p>
                        <div class="detail">
                            <p class="mb-0">{{ galleryImage.creator }}</p>
                        </div>
                    </div>


                    <!--=========================================================================================
                        B U T T O N   A C T I O N
                        =========================================================================================-->
                    <div class="col-md-2 d-flex align-items-center justify-content-around">
                        <button type="button" 
                                class="btn btn-sm btn-warning"
                                @click="isEditingGallery = !isEditingGallery">EDIT</button>               
                        <button type="button" 
                                class="btn btn-sm btn-danger"
                                @click="deleteTheGallery">DELETE</button>
                    </div>


                    <!--=========================================================================================
                        E D I T
                        =========================================================================================-->
                    <div class="col-md-12">
                        <edit-gallery v-if="isEditingGallery" :galleryImage="galleryImage"
                            @editionFormIsClosed="isEditingGallery = $event">
                        </edit-gallery>
                    </div>

                </div>
            </transition>
        </div>
    </div>
</template>

<script>
    import EditGallery from './EditGallery.vue';

    export default{
        props: {galleryImage: {}},

        components:{
            EditGallery
        },

        data() {
            return {
                isEditingGallery: false,
            }
        },

        methods:{

            deleteTheGallery() {
                const self = this;

                this.$store.dispatch('destroy_gallery', {
                    galleryId: self.galleryImage.id
                })
                .then(() => {
                    self.isRequesting = false;

                    flash('Gallery berhasil dihapus', 'danger')
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