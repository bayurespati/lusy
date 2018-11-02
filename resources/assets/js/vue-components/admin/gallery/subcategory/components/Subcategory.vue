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
                    <div class="col">
                        <p class="small text-uppercase mb-0"><strong>Nama</strong></p>
                        <div class="detail">
                            <p class="mb-0">{{ subcategory.title }}</p>
                        </div>
                    </div>


                    <!--=========================================================================================
                        B U T T O N   A C T I O N
                        =========================================================================================-->
                    <div class="col align-items-center justify-content-around">
                        <button type="button" 
                                class="btn btn-sm btn-warning"
                                @click="isEditingSubCategory = !isEditingSubCategory">EDIT</button>

                        <button type="button" 
                                class="btn btn-sm btn-danger"
                                @click="deleteTheSubCategory">DELETE</button>
                    </div>


                    <!--=========================================================================================
                        E D I T
                        =========================================================================================-->
                    <div class="col-md-12">
                        <edit-subcategory v-if="isEditingSubCategory" :subcategory="subcategory"
                            @editionFormIsClosed="isEditingSubCategory = $event">
                        </edit-subcategory>
                    </div>

                </div>
            </transition>
        </div>
    </div>
</template>

<script>
    import EditSubcategory from './EditSubcategory.vue';
    export default{
        props: {subcategory: {}},

        components:{
            EditSubcategory
        },

        data() {
            return {
                isEditingSubCategory: false,
            }
        },

        methods:{

            deleteTheSubCategory() {
                const self = this;

                this.$store.dispatch('destroy_subcategory', {
                    subcategoryId: self.subcategory.id
                })
                .then(() => {
                    self.isRequesting = false;

                    flash('Sub Category berhasil dihapus', 'danger')
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