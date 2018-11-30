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

                        <p>You'll be deleting a member named <strong>{{ member.name }}</strong> </p>

                        <p>Type "DELETE" to continue on this action</p>

                        <input type="text"
                               class="form-control form-control-sm"
                               v-model="confirmation">


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
                                    :disabled="!inputConfirmed || isRequesting"
                                    @click="deleteMember">
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

            member: {
                type: Object,
                default: function () {
                    return {};
                }
            }

        },

        data(){
            return {
                confirmation: '',
                isRequesting: false,
                buttonEnabled: true
            };
        },

        computed: {

            hideOrShowModal(){
                return this.showModal ? 'modal-show' : '';
            },

            inputConfirmed(){
                return this.confirmation === 'DELETE';
            }

        },

        methods: {

            cancel(){
                if(!this.isRequesting){
                    this.confirmation = '';
                    this.$emit('set-show-modal-to-false');
                }
            },

            deleteMember(){
                const self = this;

                if(!self.isRequesting){

                    self.isRequesting = true;

                    this.$store.dispatch('destroy_member',self.member.id)
                        .then(() => {

                            flash('Member has been deleted', 'danger');

                            self.isRequesting = false
                            this.cancel();
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