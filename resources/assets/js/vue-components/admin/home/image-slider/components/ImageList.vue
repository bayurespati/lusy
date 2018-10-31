<template>
    <div class="card col-md-3">
        <div class="card-block">
            <transition enterActiveClass="fade-in"
                        leaveActiveClass="fade-out"
                        mode="out-in">
                <div class="row">


                    <!--=========================================================================================
                        S H O W    T H U M B N A I L
                        =========================================================================================-->
                    <div class="col">
                        <p class="small text-uppercase mb-0"><strong>Image</strong></p>
                        <div class="detail">
                            <img :src=imageSlider.thumbnail alt="thumbnail">
                        </div>
                    </div>

                    <!--=========================================================================================
                        B U T T O N   E D I T
                        =========================================================================================-->
                    <div class="col align-items-center mt-1">
                        <button type="button" 
                                class="btn btn-sm btn-danger"
                                @click="deleteThiImage">Delete</button>
                    </div>
                </div>
            </transition>
        </div>
    </div>
</template>

<script>
    export default{
        props: {imageSlider: {}},

        data() {
            return {
                isDeleteImage: false,
            }
        },

        methods:{
            deleteThiImage() {
                const self = this;
                this.$store.dispatch('destroy_image', {
                    imageId: this.imageSlider.id
                })
                .then(() => {
                    self.isRequesting = false;

                    flash('Foto berhasil dihapus', 'danger')
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
</style>