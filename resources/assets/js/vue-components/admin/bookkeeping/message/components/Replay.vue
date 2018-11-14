<template>

    <transition enterActiveClass="fade-in-down"leaveActiveClass="fade-out-up"mode="out-in">
        <div class="panel-default panel mt-3 pt-4 bg-grey" id="edit_sosmed">
            <div class="panel-body">
                <h3 class="text-center font-weight-bold">
                    Message {{ messageContact.name }}
                </h3>

                <div class="row pl-0 pr-0 m-0 pt-4 pb-4">

                    <div class="col-sm-12 d-flex form-group">
                        <div class="col-sm-2 col-xs-12 text-right">
                            <label for="nama"
                            class="form-control-label font-weight-bold panel-font-small m-0">
                                Name
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
                <h3 class="text-center font-weight-bold">Reply Message</h3>

                <div class="row pl-0 pr-0 m-0 pt-4 pb-4">

                    <div class="col-sm-12 d-flex form-group">
                        <div class="col-sm-2 col-xs-12 d-flex align-items-center justify-content-end">
                            <label for="gender"class="form-control-label font-weight-bold panel-font-small m-0">
                                Subject
                            </label>
                        </div>
                        <div class="col-sm-10 col-xs-12">
                            <input  class="form-control form-control-sm" 
                                    @input="$v.subject.$touch()"
                                    @keyup.enter="sendMessage" type="text"
                                    v-model="subject">

                        <!--======================================================================================
                            V A L I D A T I O N     E R R O R   M E S S A G E S
                            ======================================================================================-->
                            <transition appear enterActiveClass="fade-in-down" leaveActiveClass="fade-out-up">
                                <span class="text-danger" v-if="!$v.subject.required && $v.subject.$dirty">
                                    * Subject item must be filled
                                </span>
                                <span class="text-danger" v-if="!$v.subject.minLength">
                                    * Minimum {{ $v.subject.$params.minLength.min }} character
                                </span>
                                <span class="text-danger" v-if="!$v.subject.maxLength">
                                    * Maximum {{ $v.subject.$params.maxLength.max }} character
                                </span>
                            </transition>
                        </div>
                    </div>

                    <div class="col-sm-12 form-group">
                        <div class="col-sm-12">
                            <textarea class="form-control form-control-sm" rows="10"
                            @input="$v.message.$touch()"
                            @keyup.enter="sendMessage"
                            v-model="message">
                            </textarea>

                        <!--======================================================================================
                            V A L I D A T I O N     E R R O R   M E S S A G E S
                            ======================================================================================-->
                            <transition appear enterActiveClass="fade-in-down" leaveActiveClass="fade-out-up">
                                <span class="text-danger" v-if="!$v.message.required && $v.message.$dirty">
                                    * Message item must be filled
                                </span>
                            </transition>
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
                                Cancel
                            </button>

                            <button type="button" class="btn btn-success btn-sm ml-2"
                            @click="sendMessage">
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
    import {required, minLength, maxLength} from 'vuelidate/lib/validators';
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
                return this.message != '' 
                    && this.message.length >= 3
                    && this.message.length <= 50
                    && this.subject != '' 
            }
        },

        validations: {
            subject: {
                required,
                minLength: minLength(3),
                maxLength: maxLength(50)
            },
            message:{
                required
            }
        },

        methods:{

            sendMessage(){

                const self = this;

                if (this.formField && !self.isRequesting) {

                    this.isRequesting = true;

                    const message = {
                        id: this.messageContact.id,
                        message: this.message,
                        subject: this.subject                 
                    };

                    this.$store.dispatch('send_message', message)

                        .then((message) => {

                            flash('Email to '+ message.name +' was sent', 'success');

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