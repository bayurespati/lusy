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
                    <div class="col-xs-12 col-md-2">
                        <p class="small text-uppercase mb-0"><strong>Name</strong></p>
                        <div class="detail">
                            <p class="mb-0">{{ sosmed.title }}</p>
                        </div>
                    </div>


                    <!--=========================================================================================
                        S H O W    L I N K
                        =========================================================================================-->
                    <div class="col-xs-12 col-md-6">
                        <p class="small text-uppercase mb-0"><strong>Link</strong></p>
                        <div class="detail">
                            <p class="mb-0 max-lines">
                                {{ sosmed.link === "" || sosmed.link === null ? 'None' : sosmed.link }}
                            </p>
                        </div>
                    </div>


                    <!--=========================================================================================
                        S H O W    S T A T U S
                        =========================================================================================-->
                    <div class="col-xs-12 col-md-2">
                        <p class="small text-uppercase mb-0"><strong>Status</strong></p>
                        <div class="detail max-lines">
                            <p class="mb-0">{{ sosmed.is_active == false ? 'Not Active' : 'Active' }}</p>
                        </div>
                    </div>


                    <!--=========================================================================================
                        B U T T O N   E D I T
                        =========================================================================================-->
                    <div class="col-xs-12 col-md-2 d-flex align-items-center justify-content-end">
                        <button type="button" 
                                class="btn btn-sm btn-warning"
                                @click="isEditingSosmed = !isEditingSosmed">Ubah</button>
                    </div>


                    <!--=========================================================================================
                        E D I T
                        =========================================================================================-->
                    <div class="col-md-12">
                        <edit-sosmed v-if="isEditingSosmed" :sosmed="sosmed"
                            @editionFormIsClosed="isEditingSosmed = $event">
                        </edit-sosmed>
                    </div>
                </div>
            </transition>
        </div>
    </div>
</template>

<script>
    import EditSosmed from './EditSosmed.vue';
    export default{
        props: {sosmed: {}},

        components:{
            EditSosmed
        },

        data() {
            return {
                isEditingSosmed: false,
            }
        },
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