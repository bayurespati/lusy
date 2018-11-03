<template>

    <transition enterActiveClass="fade-in-down"
                leaveActiveClass="fade-out-up"
                mode="out-in">

        <div class="panel-default panel mt-5" id="edit_event">
            <div class="panel-body">
                <div class="row pl-0 pr-0 m-0 pt-4 pb-4 bg-grey">


                    <!--=========================================================================================
                        N A M A
                        =========================================================================================-->
                    <div class="col-sm-12 row form-group">
                        <div class="col-sm-3 col-xs-12 d-flex align-items-center justify-content-end">
                            <label for="title"
                                   class="form-control-label panel-font-small m-0">
                                Title
                            </label>
                        </div>
                        <div class="col-sm-9 col-xs-12">
                            <input id="title"
                                   type="text"
                                   class="form-control form-control-sm"
                                   @keyup.enter="editEvent"
                                   v-model="title">
                        </div>
                    </div>


                    <!--=========================================================================================
                        S T A R T    D A T E
                        =========================================================================================-->
                    <div class="col-sm-12 row form-group">
                        <div class="col-sm-3 col-xs-12 d-flex align-items-center justify-content-end">
                            <label for="start_date"
                                   class="form-control-label panel-font-small m-0">
                                Start Date
                            </label>
                        </div>
                        <div class="col-sm-9 col-xs-12">
                            <datetime v-model="start_date" value-zone="local"></datetime>
                        </div>
                    </div>


                    <!--=========================================================================================
                        S T A R T    D A T E
                        =========================================================================================-->
                    <div class="col-sm-12 row form-group">
                        <div class="col-sm-3 col-xs-12 d-flex align-items-center justify-content-end">
                            <label for="end_date"
                                   class="form-control-label panel-font-small m-0">
                                End Date
                            </label>
                        </div>
                        <div class="col-sm-9 col-xs-12">
                            <datetime v-model="end_date" value-zone="local"></datetime>
                        </div>
                    </div>


                    <!--=========================================================================================
                        L O C A T I O N
                        =========================================================================================-->
                    <div class="col-sm-12 row form-group">
                        <div class="col-sm-3 col-xs-12 d-flex align-items-center justify-content-end">
                            <label for="location"
                                   class="form-control-label panel-font-small m-0">
                                Location
                            </label>
                        </div>
                        <div class="col-sm-9 col-xs-12">
                            <input id="location"
                                   type="text"
                                   class="form-control form-control-sm"
                                   @keyup.enter="editEvent"
                                   v-model="location">
                        </div>
                    </div>


                    <!--=========================================================================================
                        A D D R E S S
                        =========================================================================================-->
                    <div class="col-sm-12 row form-group">
                        <div class="col-sm-3 col-xs-12 d-flex align-items-center justify-content-end">
                            <label for="addres"
                                   class="form-control-label panel-font-small m-0">
                                Address
                            </label>
                        </div>
                        <div class="col-sm-9 col-xs-12">
                            <input id="addres"
                                   type="text"
                                   class="form-control form-control-sm"
                                   @keyup.enter="editEvent"
                                   v-model="addres">
                        </div>
                    </div>


                    <!--=========================================================================================
                        A D D R E S S
                        =========================================================================================-->
                    <div class="col-sm-12 row form-group">
                        <div class="col-sm-3 col-xs-12 d-flex align-items-center justify-content-end">
                            <label for="creator"
                                   class="form-control-label panel-font-small m-0">
                                Content
                            </label>
                        </div>
                        <div class="col-sm-9 col-xs-12">
                            <input id="creator"
                                   type="text"
                                   class="form-control form-control-sm"
                                   @keyup.enter="editEvent"
                                   v-model="creator">
                        </div>
                    </div>


                    <!--=========================================================================================
                        O R G A N I S E R
                        =========================================================================================-->
                    <div class="col-sm-12 row form-group">
                        <div class="col-sm-3 col-xs-12 d-flex align-items-center justify-content-end">
                            <label for="creator"
                                   class="form-control-label panel-font-small m-0">
                                Organiser
                            </label>
                        </div>
                        <div class="col-sm-9 col-xs-12">
                            <input id="creator"
                                   type="text"
                                   class="form-control form-control-sm"
                                   @keyup.enter="editEvent"
                                   v-model="organiser">
                        </div>
                    </div>


                    <!--=========================================================================================
                        S U B    C A T E G O R Y
                        =========================================================================================-->
                    <div class="col-sm-12 row form-group">
                        <div class="col-sm-3 col-xs-12 d-flex align-items-center justify-content-end">
                            <label for="subcategory"
                                   class="form-control-label panel-font-small m-0">
                                Sub category
                            </label>
                        </div>
                        <div class="col-sm-9 col-xs-12">
                            <select class="form-control" id="subcategory" v-model="sub_category_id"> 
                                <option v-for="subcategory in subcategories" 
                                        :value=subcategory.id> {{ subcategory.title }}
                                </option>
                            </select>
                        </div>
                    </div>


                    <!--=========================================================================================
                        A C T I O N   B U T T O N
                        =========================================================================================-->
                    <div class="col-sm-4 offset-3 d-flex justify-content-around mt-3">
                        <div class="col-sm-6">
                            <button type="button" 
                                class="full-width btn btn-secondary btn-block btn-sm"
                                @click="closeEditForm">Batal</button>
                        </div>

                        <div class="col-sm-6">
                            <button @click="editEvent"
                                    class="full-width btn btn-success btn-block btn-sm">
                                    Simpan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
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
                isRequesting: false,
                title: this.event.title,
                start_date: this.event.start_date,
                end_date: this.event.end_date,
                location: this.event.location,
                address: this.event.address,
                content: this.event.content,
                organiser: this.event.organiser,
                sub_category_id: this.event.sub_category_id
            }
        },

        computed: {
            ...mapGetters({
                categories: 'getCategories'
            }),

            eventIsEdited(){
                return this.event.title !== this.title 
                    || this.event.date !== this.date.substring(0,10)
                    || this.event.location !== this.location
                    || this.event.creator !== this.creator
                    || this.event.sub_category_id !== this.sub_category_id;
            },

            subcategories(){
                for(let a = 0; a < this.categories.length; a++){
                    for(let b = 0; b < this.categories[a].subcategories.length; b++){
                        if(this.categories[a].subcategories[b].id === this.event.sub_category_id ){
                            return this.categories[a].subcategories;
                        }
                    }
                }
            }
        },

        methods: {

            editEvent(){

                const self = this;

                if (this.eventIsEdited) {

                    this.isRequesting = true;

                    const updatedEvent = {
                        id: this.event.id,
                        title: this.title,
                        date: this.date.substring(0,10),
                        location: this.location,
                        creator: this.creator,
                        sub_category_id: this.sub_category_id,
                    };

                    this.$store.dispatch('update_galllery', updatedEvent)

                        .then((updatedEvent) => {

                            flash('Event Berhasil diperbaharui', 'success');

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
        }
    };
</script>

<style scoped>
    .pl-15-px {
        padding-left: 15px !important;
    }
</style>