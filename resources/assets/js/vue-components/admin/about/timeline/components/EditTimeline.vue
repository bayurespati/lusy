<template>
    <transition enterActiveClass="fade-in-down"
                leaveActiveClass="fade-out-up"
                mode="out-in">
        <div class="panel-default panel mt-3 pt-4 bg-grey" id="edit_timeline">
            <div class="panel-body">
                <h3 class="text-center">Edit <strong>{{ timeline.title }}</strong></h3>

                <div class="row pl-0 pr-0 m-0 pt-4 pb-4">
                    <div class="col-sm-12">
                        <div class="col-sm-12 d-flex form-group">
                            <div class="col-sm-6 col-xs-12 text-center">
                                <label for="title"class="form-control-label panel-font-small m-0 font-weight-bold">
                                    Title
                                </label>
                                
                                <input id="title" type="text"
                                class="form-control form-control-sm"
                                @input="$v.title.$touch()"
                                :class="{'form-control-danger': $v.title.$error}"
                                @keyup.enter="editTimeline"
                                :placeholder="timeline.title" 
                                v-model="title">

                                <transition enterActiveClass="fade-in" leaveActiveClass="fade-out" mode="out-in">
                                    <span key="title-required" class="text-danger" 
                                    v-if="!$v.title.required && $v.title.$dirty">
                                        Title is required
                                    </span>
                                    <span key="title-minimum" class="text-danger" 
                                    v-if="!$v.title.minLength">
                                        Title has a minimum of {{ $v.title.$params.minLength.min }} characters
                                    </span>
                                    <span key="title-maximum" class="text-danger" v-if="!$v.title.maxLength">
                                        Title has a maximum of {{ $v.title.$params.maxLength.max }} characters
                                    </span>
                                </transition>
                            </div>

                            <div class="col-sm-6 col-xs-12 text-center">
                                <label for="date"class="form-control-label panel-font-small m-0 font-weight-bold">
                                    Date
                                </label>

                                <datetime v-model="date" :class="{'form-control-danger': $v.date.$error}" value-zone="local"></datetime>
                                
                                <transition enterActiveClass="fade-in" leaveActiveClass="fade-out" mode="out-in">
                                    <span key="date-required" class="text-danger" v-if="!$v.date.required && $v.date.$dirty">
                                        Date is required
                                    </span>
                                </transition>
                            </div>
                        </div>

                        <div class="col-sm-12 d-flex form-group">
                            <div class="col-sm-12 text-center">
                                <label for="timeline-description" class="form-control-label panel-font-small font-weight-bold m-0">
                                    Description
                                </label>

                                <textarea class="form-control form-control-sm normal-placeholder" 
                                id="timeline-description" rows="10" v-model="description" 
                                :placeholder="timeline.description"></textarea>

                                <transition enterActiveClass="fade-in" leaveActiveClass="fade-out" mode="out-in">
                                    <span key="description-required" class="text-danger" v-if="!$v.description.required && $v.description.$dirty">
                                        Description is required
                                    </span>
                                </transition>
                            </div>
                        </div>

                        <div class="col-sm-12 d-flex justify-content-center mt-3 pl-2">
                            <button type="button" class="btn btn-secondary btn-sm"@click="closeEditForm">
                                Cancel
                            </button>

                            <button @click="editTimeline" class="btn btn-success btn-sm ml-2" :disabled="isRequesting">
                                <template v-if="isRequesting">Saving..</template>
                                <template v-else>Save</template>
                            </button>
                        </div>
                    </div>    
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
    import {required, minLength, maxLength} from 'vuelidate/lib/validators';
    import {mapGetters} from 'vuex';

    export default{
        props: {
            timeline: {
                type: [Object],
                default() {
                    return {}
                }
            },
        },

        data(){
            return {
                isRequesting: false,
                title: this.timeline.title,
                date: this.timeline.dateReal,
                description: this.timeline.desc,
            }
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
            },
        },

        computed: {
            timelineIsEdited(){
                return this.timeline.title !== this.title 
                    || this.timeline.desc !== this.description
                    || this.timeline.dateReal !== this.date.substring(0,10);
            },

            formIsFilled(){
                return this.title != '' && this.title.length >= 3 && this.title.length <= 50
                    && this.date != ''
                    && this.description != '';
             },
        },

        methods: {
            editTimeline(){

                const self = this;

                if (this.timelineIsEdited && this.formIsFilled && !self.isRequesting) {

                    this.isRequesting = true;

                    const updatedTimeline = {
                        id: this.timeline.id,
                        title: this.title,
                        dateReal: this.date.substring(0,10),
                        desc: this.description,
                    };

                    this.$store.dispatch('update_timeline', updatedTimeline)

                        .then((updatedTimeline) => {

                            flash('Image updated', 'success');

                            self.isRequesting = false;

                            self.closeEditForm();
                        })
                        .catch(errors => {
                            self.isRequesting = false;
                        });
                }else{
                    this.dirtyAllInputs();
                }
            },

            closeEditForm() {
                this.$emit('editionFormIsClosed', false);
            },

            dirtyAllInputs(){
                this.$v.title.$touch();
                this.$v.date.$touch();
                this.$v.description.$touch();
            },
        },
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
    .bg-grey {
        background: #fafafa;
    }

    .panel-font-small {
        font-size: 0.9rem;
    }
</style>