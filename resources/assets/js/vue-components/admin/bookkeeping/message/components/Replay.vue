<template>

    <transition enterActiveClass="fade-in-down"leaveActiveClass="fade-out-up"mode="out-in">
        <div class="panel-default panel mt-3 pt-4 bg-grey" id="edit_sosmed">
            <div class="panel-body">
                <h3 class="text-center font-weight-bold">
                    Pesan {{ messageContact.name }}
                </h3>

                <div class="row pl-0 pr-0 m-0 pt-4 pb-4">

                    <div class="col-sm-12 d-flex form-group">
                        <div class="col-sm-2 col-xs-12 text-right">
                            <label for="nama"
                            class="form-control-label font-weight-bold panel-font-small m-0">
                                Nama
                            </label>
                        </div>
                        <div class="col-sm-10 col-xs-12">
                            {{ messageContact.name }}
                        </div>
                    </div>

                    <div class="col-sm-12 d-flex form-group">
                        <div class="col-sm-2 col-xs-12 text-right">
                            <label for="nama"
                            class="form-control-label font-weight-bold panel-font-small m-0">
                                Email
                            </label>
                        </div>
                        <div class="col-sm-10 col-xs-12">
                            {{ messageContact.email }}
                        </div>
                    </div>

                    <div class="col-sm-12 form-group">
                        <div class="col-sm-12">
                            {{ messageContact.message }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel-body mb-5">
                <div class="offset-1 col-10" 
                style="border-bottom: 1px solid lightgrey;">
                </div>
            </div>

            <div class="panel-body">
                <h3 class="text-center font-weight-bold">Balasan Pesan</h3>

                <div class="row pl-0 pr-0 m-0 pt-4 pb-4">

                    <div class="col-sm-12 d-flex form-group">
                        <div class="col-sm-2 col-xs-12 d-flex align-items-center justify-content-end">
                            <label for="gender"
                            class="form-control-label font-weight-bold panel-font-small m-0">
                                Subject
                            </label>
                        </div>
                        <div class="col-sm-10 col-xs-12">
                            <input  class="form-control form-control-sm" 
                            @keyup.enter="sendMessage" type="text"
                            v-model="subject">
                        </div>
                    </div>

                    <div class="col-sm-12 form-group">
                        <div class="col-sm-12">
                            <textarea class="form-control form-control-sm" 
                            rows="10"
                            @keyup.enter="sendMessage"
                            v-model="message">
                            </textarea>
                        </div>
                    </div>


                    <!--=========================================================================================
                        A C T I O N   B U T T O N
                        =========================================================================================-->
                    <div class="col-sm-12 d-flex justify-content-center mt-3 pl-2">
                        
                        <template v-if="isRequesting">
                            <p>Please wait while your email are sent..</p>
                        </template>

                        <template v-else>
                            <button type="button" class="btn btn-secondary btn-sm"
                            @click="closeReplay">
                                Batal
                            </button>

                            <button type="button" class="btn btn-success btn-sm ml-2"
                            @click="sendMessage">
                                Kirim Pesan
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