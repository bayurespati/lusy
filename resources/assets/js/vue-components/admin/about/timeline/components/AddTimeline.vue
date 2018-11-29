<template>
    <div class="row pt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="col-md-12 text-center">
                    <h3 class="text-center mb-5">Add New <strong>Timeline</strong></h3>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-md-6 text-center">
                                <input type="text" v-model="title" 
                                @input="$v.title.$touch()"
                                :class="{'form-control-danger': $v.title.$error}"
                                class="form-control full-width" id="name" 
                                placeholder="Title">

                                <transition appear enterActiveClass="fade-in-down" leaveActiveClass="fade-out-up">
                                    <span class="text-danger" v-if="!$v.title.required && $v.title.$dirty">
                                        Title is required
                                    </span>
                                    <span class="text-danger" v-if="!$v.title.minLength">
                                        Title has minimum of {{ $v.title.$params.minLength.min }} character
                                    </span>
                                    <span class="text-danger" v-if="!$v.title.maxLength">
                                        Title has maximum of {{ $v.title.$params.maxLength.max }} character
                                    </span>
                                </transition>
                            </div>

                            <div class="col-md-6 text-center">
                                <datetime type="date" v-model="date" value-zone="local"
                                :class="{'form-control-danger': $v.date.$error}"
                                class="full-width" placeholder="Date"></datetime>

                                <transition appear enterActiveClass="fade-in-down" leaveActiveClass="fade-out-up">
                                    <span class="text-danger" v-if="!$v.date.required && $v.date.$dirty">
                                        Date is required
                                    </span>
                                </transition>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-12 text-center">
                                <div class="form-group text-left mb-3">
                                    <textarea rows="4"
                                    v-model="description"
                                    class="form-control"
                                    :class="{'form-control-danger': $v.description.$error}"
                                    placeholder="Description">
                                    </textarea>
                                </div>

                                <transition enterActiveClass="fade-in" leaveActiveClass="fade-out" mode="out-in">
                                    <span key="description-required" class="text-danger" v-if="!$v.description.required && $v.description.$dirty">
                                        Description is required
                                    </span>
                                </transition>
                            </div>
                        </div>

                        <div class="col-sm-12 d-flex justify-content-center mt-3">
                            <button class="btn btn-danger" type="button" role="button" @click="closeAdd"> 
                                Cancel
                            </button>

                            <button type="button" role="button" class="btn btn-success ml-2" @click="uploadImage" :disabled="isRequesting">
                                <template v-if="isRequesting">Adding..</template>
                                <template v-else>Add</template>
                            </button>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</template>

<script>
    import {required, minLength, maxLength} from 'vuelidate/lib/validators';
    import 'vue-datetime/dist/vue-datetime.css';
    import {Datetime} from 'vue-datetime';
    Vue.use(Datetime)

    import {mapGetters} from 'vuex';

    export default{
        props:{
            dataUser : {}
        },

        data: function () {
            return{
                isRequesting : false,
                title:'',
                date:'',
                description:'',
            }
        },

        components:{
            Datetime
        },

        validations: {
            title: {
                required,
                minLength: minLength(3),
                maxLength: maxLength(50)
            },
            date:{
                required
            },
            description:{
                required
            }
        },

        computed:{
            formIsFilled(){
                return this.description != '' 
                    && this.date != ''
                    && this.title != '' && this.title.length >= 3 && this.title.length <= 50;
             },
        },

        methods:{
            uploadImage(){

                const self  = this;
                
                if(this.formIsFilled && !self.isRequesting){

                    this.isRequesting = true;

                    const timelineData = {
                        desc : this.description,
                        title : this.title,
                        dateReal : this.date.substring(0,10),
                    };

                    this.$store.dispatch('store_new_timeline', timelineData)
                        .then((response) => {
                            flash('Timeline Added','success');

                            self.isRequesting = false;

                            self.closeAdd();
                        })
                        .catch((errors) => {
                            vselfm.isRequesting = false;

                            Object.keys(errors).forEach(field=> {
                                errors[field].forEach(message=> {
                                    flash(message, 'danger', 5000);
                                })
                            });
                        });
                }else{
                    this.dirtyAllInputs();
                }
            },

            closeAdd(){
               this.$emit('closeAddTimeline',false);
            },

            dirtyAllInputs(){
                this.$v.title.$touch();
                this.$v.date.$touch();
                this.$v.description.$touch();
            },
        }
    };
</script>

<style type="text/css">
    .vdatetime-input {
        width: 100%;
        padding: .375rem .75rem;
        line-height: 1.5;
        font-size: 1rem;
        color: #495057;
        border-radius: .25rem;
        border: 1px solid #ced4da;
    }

    .form-control-danger input {
        border-color: #dc3545 !important;
    }

    .form-control-danger input:focus {
        border-color: #dc3545 !important;
        box-shadow: 0 0 0 0.2rem rgba(220,53,69,.25) !important;
    }

    ::-webkit-input-placeholder {
        text-align: center;
    }

    :-moz-placeholder { /* Firefox 18- */
        text-align: center;  
    }

    ::-moz-placeholder {  /* Firefox 19+ */
        text-align: center;  
    }

    :-ms-input-placeholder {  
        text-align: center; 
    }

    input {
        text-align: center;
    }
</style>

<style scoped>
    .card {
        display: inline-block;
        width: 100%;
        padding: 36px 20px 26px 20px;
    }
</style>