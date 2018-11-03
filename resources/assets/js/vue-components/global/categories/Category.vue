<template>
    <div class="card mt-3">
        <div class="card-block">

            <transition enterActiveClass="fade-in"
                        leaveActiveClass="fade-out"
                        mode="out-in">
                <div class="row col d-flex justify-content-between m-0">


                    <!--=========================================================================================
                        S H O W    T I T L E
                        =========================================================================================-->
                    <div>
                        <p class="small text-uppercase mb-0"><strong>Nama</strong></p>
                        <div class="detail">
                            <p class="mb-0">{{ category.title }}</p>
                        </div>
                    </div>


                    <!--=========================================================================================
                        B U T T O N   A C T I O N
                        =========================================================================================-->
                    <div class="d-flex align-items-center justify-content-around">
                        <button type="button" 
                                class="btn btn-sm btn-warning"
                                @click="isEditingCategory = !isEditingCategory">Ubah</button>

                        <button type="button" 
                                class="btn btn-sm btn-danger ml-2"
                                @click="deleteTheCategory">Hapus</button>
                    </div>


                    <!--=========================================================================================
                        E D I T
                        =========================================================================================-->
                    <div class="col-md-12">
                        <edit-category v-if="isEditingCategory" :category="category"
                            @editionFormIsClosed="isEditingCategory = $event">
                        </edit-category>
                    </div>

                </div>
            </transition>
        </div>
    </div>
</template>

<script>
    import EditCategory from './EditCategory.vue';
    export default{
        props: {category: {}},

        components:{
            EditCategory
        },

        data() {
            return {
                isEditingCategory: false,
            }
        },

        methods:{

            deleteTheCategory() {
                const self = this;
                this.$store.dispatch('destroy_category', {
                    categoryId: this.category.id
                })
                .then(() => {
                    self.isRequesting = false;

                    flash('Category berhasil dihapus', 'danger')
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