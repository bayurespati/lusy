<template>
    <transition enterActiveClass="fade-in-down"
                leaveActiveClass="fade-out-up"
                mode="out-in">
        <div class="panel-default panel mt-3 pt-4 bg-grey" id="edit_event">
            <div class="panel-body">
                <h3 class="text-center font-weight-bold mb-3">Edit {{ event.title }}</h3>

                <div class="row pl-0 pr-0 m-0 pt-4 pb-4">
                    <div class="col-sm-12 d-flex form-group">
                        <div class="col-sm-6 col-xs-12 text-center">
                            <label for="title"
                            class="form-control-label panel-font-small m-0">
                                Judul Acara
                            </label>

                            <input id="title"
                            type="text"
                            class="form-control form-control-sm"
                            @keyup.enter="editEvent"
                            :placeholder="event.title" 
                            v-model="title">
                        </div>

                        <div class="col-sm-6 col-xs-12 text-center">
                            <label for="creator"
                            class="form-control-label panel-font-small m-0">
                                Organiser
                            </label>
                            
                            <input id="creator"
                            type="text"
                            class="form-control form-control-sm"
                            @keyup.enter="editEvent"
                            :placeholder="event.organiser"
                            v-model="organiser">
                        </div>
                    </div>

                    <div class="col-sm-12 d-flex form-group">
                        <div class="col-sm-6 col-xs-12 text-center">
                            <label for="start_date"
                            class="form-control-label panel-font-small m-0">
                                Waktu Mulai
                            </label>

                            <datetime type="datetime" value-zone="local" v-model="start_date" :placeholder="event.start_date"></datetime>
                        </div>

                        <div class="col-sm-6 col-xs-12 text-center">
                            <label for="end_date"
                            class="form-control-label panel-font-small m-0">
                                Waktu Selesai
                            </label>
                            
                            <datetime type="datetime" v-model="end_date" value-zone="local" :placeholder="event.end_date"></datetime>
                        </div>
                    </div>

                    <div class="col-sm-12 d-flex form-group">
                        <div class="col-sm-6 col-xs-12 text-center">
                            <label for="location"
                            class="form-control-label panel-font-small m-0">
                                Lokasi
                            </label>

                            <input id="location"
                            type="text"
                            class="form-control form-control-sm"
                            @keyup.enter="editEvent"
                            v-model="location" 
                            :placeholder="event.location">
                        </div>

                        <div class="col-sm-6 col-xs-12 text-center">
                            <label for="addres"
                            class="form-control-label panel-font-small m-0">
                                Alamat
                            </label>

                            <input id="addres"
                            type="text"
                            class="form-control form-control-sm"
                            @keyup.enter="editEvent"
                            v-model="address" 
                            :placeholder="event.address">
                        </div>
                    </div>

                    <div class="col-sm-12 d-flex form-group">
                        <div class="col-sm-6 col-xs-12 text-center">
                            <label for="category"
                            class="form-control-label panel-font-small m-0">
                                Kategori
                            </label>
                            
                            <select class="form-control" id="category" v-model="sub_category_id"> 
                                <option v-for="subcategory in subcategories" 
                                        :value=subcategory.id> {{ subcategory.title }}
                                </option>
                            </select>
                        </div>

                        <div class="col-sm-6 col-xs-12 text-center">
                            <label for="subcategory"
                            class="form-control-label panel-font-small m-0">
                                Subkategori
                            </label>
                            
                            <select class="form-control" id="subcategory" v-model="sub_category_id"> 
                                <option v-for="subcategory in subcategories" 
                                :value=subcategory.id> {{ subcategory.title }}
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-12 d-flex form-group">
                        <div class="col-sm-12 text-center">
                            <label for="event-content"
                            class="form-control-label panel-font-small m-0">
                                Konten Acara
                            </label>

                            <textarea class="form-control form-control-sm normal-placeholder" id="event-content" rows="10" v-model="content" :placeholder="event.content"></textarea>
                        </div>
                    </div>

                    <div class="col-sm-12 d-flex justify-content-center mt-2">
                        <button type="button" 
                        class="btn btn-secondary btn-sm"
                        @click="closeEditForm">
                            Batal
                        </button>

                        <button @click="editEvent"
                        class="btn btn-success btn-sm ml-2">
                            Simpan
                        </button>
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
                start_date: this.event.start_date.replace(" ", "T")+".000+07:00",
                end_date: this.event.end_date.replace(" ", "T")+".000+07:00",
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
                    || this.event.start_date !== this.start_date.substring(0,19).replace("T", " ")
                    || this.event.end_date !== this.end_date.substring(0,19).replace("T", " ")
                    || this.event.location !== this.location
                    || this.event.address !== this.address
                    || this.event.content !== this.content
                    || this.event.organiser !== this.organiser
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

                console.log(this.start_date,this.location);

                const self = this;

                if (this.eventIsEdited) {

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
                    };

                    this.$store.dispatch('update_event', updatedEvent)

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