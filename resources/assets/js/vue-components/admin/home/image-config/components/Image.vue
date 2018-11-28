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
                    <div class="col-md-5 d-flex align-items-center">
                        <img :src=imageConfig.image_path alt="image">
                    </div>


                    <!--=========================================================================================
                        S H O W    T I T L E
                        =========================================================================================-->
                    <div class="col-md-6 d-flex align-items-center justify-content-center">
                        <span>
                            <p class="small text-uppercase text-center mb-0"><strong>Page</strong></p>

                            <div class="detail text-center">
                                <p class="mb-0">{{ imageConfig.page_name }}</p>
                            </div>
                        </span>
                    </div>


                    <!--=========================================================================================
                        B U T T O N   A C T I O N
                        =========================================================================================-->
                    <div class="col-md-1 d-flex align-items-center justify-content-end">
                        <button type="button" 
                                class="btn btn-sm btn-warning"
                                @click="isEditingImage = !isEditingImage">Edit</button>
                    </div>


                    <!--=========================================================================================
                        E D I T
                        =========================================================================================-->
                        <div class="col-md-12">
                            <edit-image v-if="isEditingImage" :imageConfig="imageConfig"
                                        @editionFormIsClosed="isEditingImage = $event">
                            </edit-image>
                        </div>
                </div>
            </transition>
        </div>
    </div>
</template>

<script>
    import EditImage from './EditImage.vue';
    export default{
        props: {imageConfig: {}},

        components:{
            EditImage
        },

        data() {
            return {
                isEditingImage: false,
            }
        },
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

    .cut-content {
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
    }
</style>