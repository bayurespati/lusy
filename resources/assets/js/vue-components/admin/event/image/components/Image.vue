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
                    <div class="col-md-3">
                        <img :src=imageItem.image_path alt="image">
                    </div>


                    <!--=========================================================================================
                        S H O W    T I T L E
                        =========================================================================================-->
                    <div class="col-md-3 d-flex align-items-center">
                        <span>
                            <p class="small text-uppercase"><strong>Nama</strong></p>
                            <div class="detail">
                                <p class="mb-0">{{ imageItem.title }}</p>
                            </div>
                        </span>
                    </div>


                    <!--=========================================================================================
                        I S    P O S T E R
                        =========================================================================================-->
                    <div class="col-md-3 d-flex align-items-center justify-content-center">
                        <div class="col-12 text-center">
                            <p class="small text-uppercase">
                                <strong>Status Poster</strong>
                            </p>
                            <div class="detail">
                                <button @click="editImage" 
                                        class="btn btn-sm btn btn-success" 
                                        v-if="imageItem.is_poster">Aktif</button>
                                <button @click="show"
                                        class="btn btn-sm btn btn-danger" 
                                        v-else="">Tidak Aktif</button>
                            </div>
                        </div>
                    </div>


                    <!--=========================================================================================
                        B U T T O N   A C T I O N
                        =========================================================================================-->
                    <div class="col-md-3 d-flex align-items-center justify-content-end">
                        <button type="button" 
                                class="btn btn-sm btn-warning"
                                @click="isEditingImage = !isEditingImage">Ubah</button>               
                        <button type="button" 
                                class="btn btn-sm btn-danger ml-2"
                                @click="deleteTheImage">Hapus</button>
                    </div>


                    <!--=========================================================================================
                        E D I T
                        =========================================================================================-->
                    <div class="col-md-12">
                        <edit-image v-if="isEditingImage" :imageItem="imageItem"
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
    import {mapGetters} from 'vuex';
    export default{
        props: {imageItem: {}},

        components:{
            EditImage
        },

        data() {
            return {
                isEditingImage: false,
            }
        },

        computed:{
            ...mapGetters({
                imageList : 'getImageList'
            })
        },

        methods:{

            deleteTheImage() {
                const self = this;

                this.$store.dispatch('destroy_image', {
                    imageId: self.imageItem.id
                })
                .then(() => {
                    self.isRequesting = false;

                    flash('Image berhasil dihapus', 'danger')
                })
            },


            show(){

                let a = _.findIndex(this.imageList, ['is_poster', 1]);
                let b = _.findIndex(this.imageList, ['is_poster', true]);

                if(a === -1 && b === -1){
                    this.editImage();
                }
            },

            editImage(){

                const self = this;

                if (true) {

                    this.isRequesting = true;

                    const updatedImage = {
                        id: this.imageItem.id,
                        title: this.imageItem.title,
                        description: this.imageItem.description,
                        image: this.imageItem.image_path,
                        is_poster: !this.imageItem.is_poster
                    };

                    this.$store.dispatch('update_image', updatedImage)

                        .then((updatedImage) => {

                            flash('Image item Berhasil diperbaharui', 'success');

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

<style>
    .croppie-container {
        height: unset !important;
    }
</style>

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
