<template>
    <transition enterActiveClass="fade-in"
                leaveActiveClass="fade-out"
                mode="out-in">
        <div class="col-md-3 p-2" style="text-align: center;">
            <div class="frame">
                

                <!--=========================================================================================
                    S H O W    T H U M B N A I L
                    =========================================================================================-->
                <p class="small text-uppercase mb-0" style="font-weight: bold;">#{{imageNumber+1}} Image</p>
                <img class="frame" :src=imageSlider.thumbnail alt="thumbnail">

                <!--=========================================================================================
                    B U T T O N   E D I T
                    =========================================================================================-->
                <div class="col align-items-center mt-2 mb-2">
                    <button type="button" 
                            class="btn btn-sm btn-danger"
                            @click="deleteThiImage">
                        Delete
                    </button>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
    export default{
        props: {
            imageSlider: {},
            imageNumber: {
                type: Number
            }
        },

        data() {
            return {
                isDeleteImage: false,
                isRequesting: false
            }
        },

        methods:{
            deleteThiImage() {
                const self = this;

                if(!this.isRequesting){
                    this.$store.dispatch('destroy_image', {
                        imageId: this.imageSlider.id
                    })
                    .then(() => {

                        flash('Foto berhasil dihapus', 'danger');

                        self.isRequesting = false;
                    })
                }
            }
        }
    };
</script>
<style scoped>
    .frame {
        border: 1px solid lightgrey !important;
    }
</style>