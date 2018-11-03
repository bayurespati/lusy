<template>
    <div class="card mt-3">
        <div class="card-block">

            <transition enterActiveClass="fade-in"
                        leaveActiveClass="fade-out"
                        mode="out-in">
                <div class="row col d-flex justify-content-between m-0">

                    <!--=========================================================================================
                        I M A G E
                        =========================================================================================-->
                    <div class="boxImage">
                        <img :src=singleClass.image_path alt="image">
                    </div>


                    <!--=========================================================================================
                        S H O W    T I T L E
                        =========================================================================================-->
                    <div class="col-md-3">
                        <p class="small text-uppercase mb-0"><strong>Nama</strong></p>
                        <div class="detail">
                            <p class="mb-0">{{ singleClass.title }}</p>
                        </div>
                    </div>


                    <!--=========================================================================================
                        B U T T O N   A C T I O N
                        =========================================================================================-->
                    <div class="d-flex align-items-center justify-content-around">
                        <button type="button" 
                                class="btn btn-sm btn-warning"
                                @click="isEditingClass = !isEditingClass">Edit</button>

                        <button type="button" 
                                class="btn btn-sm btn-danger ml-2"
                                @click="deleteTheClass">Delete</button>
                    </div>


                    <!--=========================================================================================
                        E D I T
                        =========================================================================================-->
                    <div class="col-md-12">
                        <edit-class v-if="isEditingClass" :singleClass="singleClass"
                            @editionFormIsClosed="isEditingClass = $event">
                        </edit-class>
                    </div>

                </div>
            </transition>
        </div>
    </div>
</template>

<script>
    import EditClass from './EditClass.vue';
    export default{
        props: {singleClass: {}},

        components:{
            EditClass
        },

        data() {
            return {
                isEditingClass: false,
            }
        },

        methods:{

            deleteTheClass() {
                const self = this;
                this.$store.dispatch('destroy_class', {
                    classId: this.singleClass.id
                })
                .then(() => {
                    flash('Class berhasil dihapus', 'danger')
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

    .boxImage{
        width: 100px;
        height: 100px;
    }

    img{
        max-width: 100%;
        height: auto;
    }
</style>