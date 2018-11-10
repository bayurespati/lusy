<template>

    <transition enterActiveClass="fade-in-down"leaveActiveClass="fade-out-up"mode="out-in">
        <div class="panel-default panel mt-3 pt-4 bg-grey" id="edit_sosmed">
            <div class="panel-body">
                <div class="row pl-0 pr-0 m-0 pt-4 pb-4">


                    <!--=========================================================================================
                        N A M E
                        =========================================================================================-->
                    <div class="col-sm-12 row form-group">
                        <div class="col-sm-3 col-xs-12 d-flex align-items-center justify-content-end">
                            <label for="nama"
                                   class="form-control-label font-weight-bold panel-font-small m-0">
                                Name
                            </label>
                        </div>
                        <div class="col-sm-9 col-xs-12">
                            {{ messageContact.name }}
                        </div>
                    </div>


                    <!--=========================================================================================
                        E M A I L
                        =========================================================================================-->
                    <div class="col-sm-12 row form-group">
                        <div class="col-sm-3 col-xs-12 d-flex align-items-center justify-content-end">
                            <label for="nama"
                                   class="form-control-label font-weight-bold panel-font-small m-0">
                                Email
                            </label>
                        </div>
                        <div class="col-sm-9 col-xs-12">
                            {{ messageContact.email }}
                        </div>
                    </div>


                    <!--=========================================================================================
                        M E S S A G E
                        =========================================================================================-->
                    <div class="col-sm-12 row form-group">
                        <div class="col-sm-3 d-flex align-items-center justify-content-end">
                            <label for="gender"
                            class="form-control-label font-weight-bold panel-font-small m-0">
                                Message
                            </label>
                        </div>
                        <div class="col-sm-9">
                            {{ messageContact.message }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel-body">
                <h3 class="text-center font-weight-bold">Replay</h3>
                <div class="row pl-0 pr-0 m-0 pt-4 pb-4">

                    <!--=========================================================================================
                        S U B J E C T
                        =========================================================================================-->
                    <div class="col-sm-12 row form-group">
                        <div class="col-sm-3 d-flex align-items-center justify-content-end">
                            <label for="gender"
                            class="form-control-label font-weight-bold panel-font-small m-0">
                                Subject
                            </label>
                        </div>
                        <div class="col-sm-9">
                            <input  class="form-control form-control-sm" 
                                    @keyup.enter="sendMessage" type="text"
                                    v-model="subject"></textarea>
                        </div>
                    </div>


                    <!--=========================================================================================
                        R E P L A Y    M E S S A G E
                        =========================================================================================-->
                    <div class="col-sm-12 row form-group">
                        <div class="col-sm-3 d-flex align-items-center justify-content-end">
                            <label for="gender"
                            class="form-control-label font-weight-bold panel-font-small m-0">
                                Write Message
                            </label>
                        </div>
                        <div class="col-sm-9">
                            <textarea class="form-control form-control-sm" 
                                      @keyup.enter="sendMessage"
                                      v-model="message"></textarea>
                        </div>
                    </div>


                    <!--=========================================================================================
                        A C T I O N   B U T T O N
                        =========================================================================================-->
                    <div class="col-sm-4 offset-3 d-flex justify-content-start mt-3 pl-2">
                        
                        <template v-if="isRequesting">
                            <p>Wait for seending email...</p>
                        </template>

                        <template v-else>
                            <button type="button" class="btn btn-secondary btn-sm"@click="closeReplay">
                                Close
                            </button>

                            <button type="button" class="btn btn-success btn-sm"@click="sendMessage">
                                Send
                            </button>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
    export default{
        props:{messageContact:{}},

        data(){
            return{
                message: '',
                subject: '',
                isRequesting: false
            }
        },

        computed:{
            formField(){
                return this.message != '' && this.message.length > 3
                    && this.subject != '' && this.message.length > 2;
            }
        },

        methods:{

            sendMessage(){

                const self = this;

                if (this.formField) {

                    this.isRequesting = true;

                    const message = {
                        id: this.messageContact.id,
                        message: this.message,
                        subject: this.subject                 
                    };

                    this.$store.dispatch('send_message', message)

                        .then((message) => {

                            flash('Email kepada '+ message.name +' Berhasil dikirim', 'success');

                            self.isRequesting = false;

                            self.closeReplay();
                        })
                        .catch(errors => {

                            self.isRequesting = false;

                        });
                }
            },

            closeReplay() {
                this.$emit('closeReplay', false);
            }
        }
    };
</script>

<style scoped>
    .bg-grey {
        background: #fafafa;
    }

    .panel-font-small {
        font-size: 0.9rem;
    }
</style>