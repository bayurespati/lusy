<template>
    <transition enterActiveClass="fade-in-down"leaveActiveClass="fade-out-up"mode="out-in">
        <div class="panel-default panel mt-3 pt-4 bg-grey" id="edit_event">
            <div class="panel-body">
                <h3 class="text-center font-weight-bold mb-3">Edit {{ event.title }}</h3>

                <div class="row pl-0 pr-0 m-0 pt-4 pb-4">
                    <div class="col-sm-12 d-flex form-group">
                        <div class="col-sm-6 col-xs-12 text-center">
                            <label for="title"class="form-control-label panel-font-small m-0">
                                Title
                            </label>

                            <input id="title" type="text"
                                   class="form-control form-control-sm"
                                   @keyup.enter="editEvent"
                                   @input="$v.title.$touch()"
                                   :placeholder="event.title" 
                                   v-model="title">

                            <!--======================================================================================
                                V A L I D A T I O N     E R R O R   M E S S A G E S
                                ======================================================================================-->
                            <transition appear enterActiveClass="fade-in-down" leaveActiveClass="fade-out-up">
                                <span class="text-danger text-left" v-if="!$v.title.required && $v.title.$dirty">
                                    * Title must be filled
                                </span>
                                <span class="text-danger text-left" v-if="!$v.title.minLength">
                                    * Minimum {{ $v.title.$params.minLength.min }} character
                                </span>
                                <span class="text-danger text-left" v-if="!$v.title.maxLength">
                                    * Maximum {{ $v.title.$params.maxLength.max }} character
                                </span>
                            </transition> 
                        </div>

                        <div class="col-sm-6 col-xs-12 text-center">
                            <label for="creator"class="form-control-label panel-font-small m-0">
                                Organiser
                            </label>
                            
                            <input id="creator" type="text"
                                   class="form-control form-control-sm"
                                   @keyup.enter="editEvent"
                                   @input="$v.organiser.$touch()"
                                   :placeholder="event.organiser"
                                   v-model="organiser">

                            <!--======================================================================================
                                V A L I D A T I O N     E R R O R   M E S S A G E S
                                ======================================================================================-->
                            <transition appear enterActiveClass="fade-in-down" leaveActiveClass="fade-out-up">
                                <span class="text-danger text-left" v-if="!$v.organiser.required && $v.organiser.$dirty">
                                    * Organiser must be filled
                                </span>
                                <span class="text-danger text-left" v-if="!$v.organiser.minLength">
                                    * Minimum {{ $v.organiser.$params.minLength.min }} character
                                </span>
                                <span class="text-danger text-left" v-if="!$v.organiser.maxLength">
                                    * Maximum {{ $v.organiser.$params.maxLength.max }} character
                                </span>
                            </transition> 
                        </div>
                    </div>

                    <div class="col-sm-12 d-flex form-group">
                        <div class="col-sm-6 col-xs-12 text-center">
                            <label for="start_date"class="form-control-label panel-font-small m-0">
                                Start Date
                            </label>

                            <datetime type="datetime" 
                                      value-zone="local" v-model="start_date" 
                                      :placeholder="event.start_date"></datetime>
                        </div>

                        <div class="col-sm-6 col-xs-12 text-center">
                            <label for="end_date"class="form-control-label panel-font-small m-0">
                                End Date
                            </label>
                            
                            <datetime type="datetime" 
                                      v-model="end_date" value-zone="local" 
                                      :placeholder="event.end_date"></datetime>
                        </div>
                    </div>

                    <div class="col-sm-12 d-flex form-group">
                        <div class="col-sm-6 col-xs-12 text-center">
                            <label for="location"class="form-control-label panel-font-small m-0">
                                Location
                            </label>

                            <input id="location" type="text"
                                   class="form-control form-control-sm"
                                   @keyup.enter="editEvent"
                                   @input="$v.location.$touch()"
                                   v-model="location" 
                                   :placeholder="event.location">

                            <!--======================================================================================
                                V A L I D A T I O N     E R R O R   M E S S A G E S
                                ======================================================================================-->
                            <transition appear enterActiveClass="fade-in-down" leaveActiveClass="fade-out-up">
                                <span class="text-danger text-left" v-if="!$v.location.required && $v.location.$dirty">
                                    * Location must be filled
                                </span>
                                <span class="text-danger text-left" v-if="!$v.location.minLength">
                                    * Minimum {{ $v.location.$params.minLength.min }} character
                                </span>
                                <span class="text-danger text-left" v-if="!$v.location.maxLength">
                                    * Maximum {{ $v.location.$params.maxLength.max }} character
                                </span>
                            </transition> 
                        </div>

                        <div class="col-sm-6 col-xs-12 text-center">
                            <label for="addres" class="form-control-label panel-font-small m-0">
                                Address
                            </label>

                            <input id="addres" type="text"
                                   class="form-control form-control-sm"
                                   @keyup.enter="editEvent"
                                   @input="$v.address.$touch()"
                                   v-model="address" 
                                   :placeholder="event.address">

                            <!--======================================================================================
                                V A L I D A T I O N     E R R O R   M E S S A G E S
                                ======================================================================================-->
                            <transition appear enterActiveClass="fade-in-down" leaveActiveClass="fade-out-up">
                                <span class="text-danger text-left" v-if="!$v.address.required && $v.address.$dirty">
                                    * Address must be filled
                                </span>
                                <span class="text-danger text-left" v-if="!$v.address.minLength">
                                    * Minimum {{ $v.address.$params.minLength.min }} character
                                </span>
                                <span class="text-danger text-left" v-if="!$v.address.maxLength">
                                    * Maximum {{ $v.address.$params.maxLength.max }} character
                                </span>
                            </transition> 
                        </div>
                    </div>

                    <div class="col-sm-12 d-flex form-group">
                        <div class="col-sm-6 col-xs-12 text-center">
                            <label for="category" class="form-control-label panel-font-small m-0">
                                Category
                            </label>
                            
                            <select class="form-control" id="category" v-model="category_id"> 
                                <option v-for="category in categories" 
                                        :value=category.id> {{ category.title }}
                                </option>
                            </select>
                        </div>

                        <div class="col-sm-6 col-xs-12 text-center">
                            <label for="subcategory" class="form-control-label panel-font-small m-0">
                                Subcategory
                            </label>
                            
                            <select class="form-control" id="subcategory" 
                                    v-model="sub_category_id" @input="$v.sub_category_id.$touch()">
                                <option value="">Choose Subcategory</option>
                                <option v-for="subcategory in subcategories" 
                                        :value=subcategory.id> {{ subcategory.title }}
                                </option>
                            </select>
                            <transition appear enterActiveClass="fade-in-down" leaveActiveClass="fade-out-up">
                                <span class="text-danger text-left" v-if="!$v.sub_category_id.required">
                                    * Subcategory must be filled
                                </span>
                            </transition>
                        </div>
                    </div>

                    <div class="col-sm-12 d-flex form-group">
                        <div class="col-sm-12 text-center">
                            <label for="event-content" class="form-control-label panel-font-small m-0">
                                Content
                            </label>

                            <textarea class="form-control form-control-sm normal-placeholder" 
                                      id="event-content" rows="10" v-model="content" 
                                      :placeholder="event.content"></textarea>
                        </div>
                    </div>

                    <div class="col-sm-12 d-flex justify-content-center mt-2">
                        <button type="button" 
                                class="btn btn-secondary btn-sm"
                                @click="closeEditForm">
                            Cancel
                        </button>

                        <button @click="editEvent"
                                class="btn btn-success btn-sm ml-2">
                            Save
                        </button>
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
            event: {
                type: [Object],
                default() {
                    return {}
                }
            }
        },

        data(){
            return {
                subcategories:'',
                category_id: this.event.subcategory.category_id,
                isRequesting: false,
                title: this.event.title,
                start_date: this.event.start_date.replace(" ", "T")+".000+07:00",
                end_date: this.event.end_date.replace(" ", "T")+".000+07:00",
                location: this.event.location,
                address: this.event.address,
                content: this.event.content,
                organiser: this.event.organiser,
                sub_category_id: this.event.sub_category_id
            }
        },

        mounted(){
            this.setSubcategory();
        },

        validations: {
            title: {
                required,
                minLength: minLength(3),
                maxLength: maxLength(20)
            },
            organiser:{
                required,
                minLength: minLength(3),
                maxLength: maxLength(20)
            },
            start_date: {
                required,
            },
            end_date: {
                required,
            },
            location:{
                required,
                minLength: minLength(3),
                maxLength: maxLength(20)
            },
            address: {
                required,
                minLength: minLength(3),
                maxLength: maxLength(50),
            },
            sub_category_id:{
                required
            }
        },

        computed: {
            ...mapGetters({
                categories: 'getCategories'
            }),

            eventIsEdited(){
                return this.event.title !== this.title 
                    || this.event.start_date !== this.start_date.substring(0,19).replace("T", " ")
                    || this.event.end_date !== this.end_date.substring(0,19).replace("T", " ")
                    || this.event.location !== this.location
                    || this.event.address !== this.address
                    || this.event.content !== this.content
                    || this.event.organiser !== this.organiser
                    || this.event.sub_category_id !== this.sub_category_id;
            },

            formAddFilled(){
                return this.title != ''
                    && this.title.length >= 3
                    && this.title.length <= 20
                    && this.organiser != ''
                    && this.organiser.length >= 3 
                    && this.organiser.length <= 20
                    && this.location != ''
                    && this.location.length >= 3
                    && this.location.length <= 20
                    && this.address != ''
                    && this.address.length >= 3
                    && this.address.length <= 50
                    && this.start_date != ''
                    && this.end_date != ''
                    && this.sub_category_id != '';
            }
        },

        methods: {

            setSubcategory(){
                for(let a = 0; a < this.categories.length; a++){
                    for(let b = 0; b < this.categories[a].subcategories.length; b++){
                        if(this.categories[a].subcategories[b].id === this.event.sub_category_id ){
                            this.subcategories =  this.categories[a].subcategories;
                        }
                    }
                }
            },

            editEvent(){

                const self = this;

                if (this.eventIsEdited && this.formAddFilled && !this.isRequesting) {

                    this.isRequesting = true;

                    const updatedEvent = {
                        id: this.event.id,
                        title: this.title,
                        start_date: this.start_date.substring(0,19).replace("T", " "),
                        end_date: this.end_date.substring(0,19).replace("T", " "),
                        location: this.location,
                        address: this.address,
                        content: this.content,
                        organiser: this.organiser,
                        sub_category_id: this.sub_category_id,
                        category_id: this.category_id,
                    };

                    this.$store.dispatch('update_event', updatedEvent)

                        .then((updatedEvent) => {

                            flash('Event updated', 'success');

                            self.isRequesting = false;

                            self.closeEditForm();
                        })
                        .catch(errors => {
                            self.isRequesting = false;
                        });
                }
            },

            closeEditForm() {
                this.$emit('editionFormIsClosed', false);
            }
        },

        watch:{
            category_id(){
                this.sub_category_id = '';

                let index = _.findIndex(this.categories, ['id', this.category_id]);

                this.subcategories = this.categories[index].subcategories;
            }
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

    ::-webkit-input-placeholder,
    :-moz-placeholder, /* Firefox 18- */
    ::-moz-placeholder, /* Firefox 19+ */
    :-ms-input-placeholder {
        text-align: center;
    }

    input {
        text-align: center;
    }

    select {
        text-align: center;
        text-align-last: center;
        /* webkit*/
    }

    option {
        text-align: left;
    }

    .normal-placeholder::-webkit-input-placeholder,
    .normal-placeholder:-moz-placeholder,
    .normal-placeholder::-moz-placeholder,
    .normal-placeholder:-ms-input-placeholder {
        text-align: left !important;
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