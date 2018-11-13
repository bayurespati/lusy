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
                        <img :src=singleClass.image_path alt="image">
                    </div>


                    <!--=========================================================================================
                        S H O W    T I T L E
                        =========================================================================================-->
                    <div class="col-md-3 d-flex align-items-center">
                        <span>
                            <p class="small text-uppercase mb-0"><strong>Name</strong></p>

                            <div class="detail">
                                <p class="mb-0">{{ singleClass.title }}</p>
                            </div>
                        </span>
                    </div>



                    <!--=========================================================================================
                        S H O W   C O N T E N T
                        =========================================================================================-->
                    <div class="col-md-4 d-flex align-items-center">
                        <span>
                            <p class="small text-uppercase mb-0"><strong>Content</strong></p>

                            <div class="detail">
                                <p class="mb-0 cut-content">{{ singleClass.content }}</p>
                            </div>
                        </span>
                    </div>



                    <!--=========================================================================================
                        B U T T O N   A C T I O N
                        =========================================================================================-->
                    <div class="col-md-3 d-flex align-items-center justify-content-end">
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
                isRequesting: false,
                isEditingClass: false,
            }
        },

        methods:{

            deleteTheClass() {
                const self = this;

                if(!self.isRequesting){

                    self.isRequesting = true;

                    this.$store.dispatch('destroy_class', {
                        classId: this.singleClass.id
                    })
                    .then(() => {
                        flash('Class berhasil dihapus', 'danger');

                        self.isRequesting = false;
                    })
                }
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

    .cut-content {
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
    }
</style>