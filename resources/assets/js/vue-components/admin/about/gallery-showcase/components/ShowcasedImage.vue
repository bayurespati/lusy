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
                        <img :src=galleryImage.image_path alt="image">
                    </div>


                    <!--=========================================================================================
                        S H O W    T I T L E
                        =========================================================================================-->
                    <div class="col-md-2 d-flex align-items-center">
                        <span>
                            <p class="small text-uppercase mb-0"><strong>Name</strong></p>

                            <div class="detail">
                                <p class="mb-0">{{ galleryImage.title }}</p>
                            </div>
                        </span>
                    </div>


                    <!--=========================================================================================
                        D A T E
                        =========================================================================================-->
                    <div class="col-md-2 d-flex align-items-center">
                        <span>
                            <p class="small text-uppercase mb-0"><strong>Date</strong></p>
                            
                            <div class="detail">
                                <p class="mb-0">{{ galleryImage.date }}</p>
                            </div>
                        </span>
                    </div>


                    <!--=========================================================================================
                        L O C A T I O N
                        =========================================================================================-->
                    <div class="col-md-2 d-flex align-items-center">
                        <span>
                            <p class="small text-uppercase mb-0"><strong>Location</strong></p>
                            
                            <div class="detail">
                                <p class="mb-0">{{ galleryImage.location }}</p>
                            </div>
                        </span>
                    </div>


                    <!--=========================================================================================
                        C R E A T O R
                        =========================================================================================-->
                    <div class="col-md-2 d-flex align-items-center">
                        <span>
                            <p class="small text-uppercase mb-0"><strong>Creator</strong></p>
                            
                            <div class="detail">
                                <p class="mb-0">{{ galleryImage.creator }}</p>
                            </div>
                        </span>
                    </div>


                    <!--=========================================================================================
                        B U T T O N   A C T I O N
                        =========================================================================================-->
                    <div class="col-md-2 d-flex align-items-center justify-content-around">
                        <button type="button" 
                                v-if="this.galleryImage.is_showcase == 0"
                                class="btn btn-sm btn-danger"
                                @click="editGallery">Show</button>
                        <button type="button" 
                                v-else
                                class="btn btn-sm btn-success"
                                @click="editGallery">Hide</button>               
                    </div>
                </div>
            </transition>
        </div>
    </div>
</template>

<script>
    export default{
        props: {galleryImage: {}},

        data() {
            return {
                isRequesting: false,
                isEditingGallery: false,
            }
        },

        methods:{

            editGallery(){

                const self = this;

                if (!self.isRequesting) {

                    self.isRequesting = true;

                    const updatedGallery = {
                        id: this.galleryImage.id,
                        is_showcase: !this.galleryImage.is_showcase,
                    };

                    this.$store.dispatch('update_galllery', updatedGallery)

                        .then((updatedGallery) => {

                            flash('Gallery updated', 'success');

                            self.isRequesting = false;

                            self.closeEditForm();
                        })
                        .catch(errors => {
                            self.isRequesting = false;
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