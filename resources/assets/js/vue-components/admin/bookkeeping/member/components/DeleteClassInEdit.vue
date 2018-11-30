<template>


    <!--=========================================================================================
        M A K E   T H E   B A C K G R O U N D   C L I C K A B L E   T O   C L O S E   T H E
        M O D A L
        ==========================================================================================-->
    <div @click="cancel">


        <!--=========================================================================================
            M O D A L   W R A P P E R
            ==========================================================================================-->
        <div class="modal-container modal-full-color modal-full-color-danger modal-effect-9"
             :class="hideOrShowModal">
            <div class="modal-content"
                 @click.stop>


                <!--=========================================================================================
                    M O D A L   H E A D E R
                    ==========================================================================================-->
                <div class="modal-header pb-2">


                    <!--=========================================================================================
                        C L O S E   M O D A L   B U T T O N
                        ==========================================================================================-->
                    <button @click="cancel"
                            aria-hidden="true" class="close modal-close"><span class="fa fa-close" style="font-size: 20px"></span>
                    </button>
                </div>


                <!--=========================================================================================
                    M O D A L   B O D Y
                    ==========================================================================================-->
                <div class="modal-body">


                    <!--=========================================================================================
                        M O D A L   C O N T E N T
                        ==========================================================================================-->
                    <div class="text-center">
                        <span class="modal-main-icon fa fa-warning mb-0" style="font-size: 75px"></span>
                        <h3 class="mb-4">Warning</h3>

                        <p>You'll be deleting a class named <strong>{{ classItem.title }}</strong> </p>


                        <!--=========================================================================================
                            A C T I O N   B U T T O N S
                            ==========================================================================================-->
                        <div class="mt-5">


                            <!--=========================================================================================
                                C L O S E   M O D A L   B U T T O N
                                ==========================================================================================-->
                            <button class="btn btn-sm btn-space btn-secondary modal-close"
                                    @click="cancel">Cancel
                            </button>


                            <!--=========================================================================================
                                C O N T I N U E   D E A C T I V A T I N G   T H E   U S E R
                                ==========================================================================================-->
                            <button class="btn btn-sm btn-space btn-danger modal-close"
                                    :disabled="isRequesting"
                                    @click="deleteClass">
                                Continue
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-overlay"
             :class="hideOrShowModal">
        </div>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex';
    import {mapMutations} from 'vuex';
    import {mapActions} from 'vuex';

    export default {

        mounted: function () {
            document.addEventListener("keydown", (e) => {
                if (this.showModal && e.keyCode == 27) {
                    this.cancel();
                }
            });
        },

        props: {

            showModal: {
                type: Boolean,
                default: false
            },

            classItem: {
                type: Object,
                default: function () {
                    return {};
                }
            },

            memberId: {
                type: Number,
                default: 0
            }

        },

        data(){
            return {
                isRequesting: false,
                buttonEnabled: true
            };
        },

        computed: {

            hideOrShowModal(){
                return this.showModal ? 'modal-show' : '';
            },

        },

        methods: {

            cancel(){
                if(!this.isRequesting){
                    this.$emit('set-show-modal-to-false');
                }
            },

            deleteClass(){

                const self = this;

                if(!self.isRequesting){

                    self.isRequesting = true;

                    this.$store.dispatch('destroy_class',{
                        class_id : this.classItem.id,
                        member_id : this.memberId
                    }).then(() => {
                        flash('Class '+ this.classItem.title +' has been deleted.', 'danger');

                        self.isRequesting = false;
                        self.cancel();
                    }).catch(() => {
                        self.isRequesting = false;
                    })
                }
            },

        }
    };

</script>

<style type="text/css" scoped>
    * {
        color: white;
    }
</style>