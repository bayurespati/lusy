<template>

    <transition enterActiveClass="fade-in-down"leaveActiveClass="fade-out-up"mode="out-in">
        <div class="panel-default panel mt-3 pt-4 bg-grey" id="edit_sosmed">
            <div class="panel-body">
                <h3 class="text-center font-weight-bold">Detail {{ detail.name }}</h3>

                <div class="row pl-0 pr-0 m-0 pt-4 pb-4">

                    <div class="col-6">
                        <div class="col-sm-12 row form-group">
                            <div class="col-sm-4 col-xs-12 d-flex align-items-center justify-content-end">
                                <label for="nama"
                                class="form-control-label font-weight-bold panel-font-small m-0">
                                    Name
                                </label>
                            </div>
                            
                            <div class="col-sm-8 col-xs-12">
                                {{ detail.name }}
                            </div>
                        </div>

                        <div class="col-sm-12 row form-group">
                            <div class="col-sm-4 d-flex align-items-center justify-content-end">
                                <label for="gender"
                                class="form-control-label font-weight-bold panel-font-small m-0">
                                    Gender
                                </label>
                            </div>
                        
                            <div class="col-sm-8">
                                {{ detail.gender == 1 ? 'Men' : 'Women' }}
                            </div>
                        </div>

                        <div class="col-sm-12 row form-group">
                            <div class="col-sm-4 d-flex align-items-center justify-content-end">
                                <label for="address"
                                class="form-control-label font-weight-bold panel-font-small m-0">
                                    Place of birth
                                </label>
                            </div>
                        
                            <div class="col-sm-8">
                                {{ detail.place_of_birth }}
                            </div>
                        </div>

                        <div class="col-sm-12 row form-group">
                            <div class="col-sm-4 d-flex align-items-center justify-content-end">
                                <label for="address"
                                class="form-control-label font-weight-bold panel-font-small m-0">
                                    Date of birth
                                </label>
                            </div>
                        
                            <div class="col-sm-8">
                                {{ detail.date_of_birth | date }}
                            </div>
                        </div>

                        <div class="col-sm-12 row form-group">
                            <div class="col-sm-4 d-flex align-items-center justify-content-end">
                                <label for="state_province"
                                class="form-control-label font-weight-bold panel-font-small m-0">
                                    Class
                                </label>
                            </div>
                        
                            <div class="col-sm-8">
                                {{ detail.class_title }}
                            </div>
                        </div>

                     </div>

                    <div class="col-6">

                        <div class="col-sm-12 row form-group">
                            <div class="col-sm-4 d-flex align-items-center justify-content-end">
                                <label for="address"
                                class="form-control-label font-weight-bold panel-font-small m-0">
                                    Email
                                </label>
                            </div>
                        
                            <div class="col-sm-8">
                                {{ detail.email }}
                            </div>
                        </div>

                       <div class="col-sm-12 row form-group">
                            <div class="col-sm-4 d-flex align-items-center justify-content-end">
                                <label for="email"
                                class="form-control-label font-weight-bold panel-font-small m-0">
                                    Telephone
                                </label>
                            </div>
                        
                            <div class="col-sm-8">
                                {{ detail.telephone }}
                            </div>
                        </div>

                        <div class="col-sm-12 row form-group">
                            <div class="col-sm-4 d-flex align-items-center justify-content-end">
                                <label for="city"
                                class="form-control-label font-weight-bold panel-font-small m-0">
                                    Mobile
                                </label>
                            </div>
                        
                            <div class="col-sm-8">
                                {{ detail.mobile }}
                            </div>
                        </div>

                        <div class="col-sm-12 row form-group">
                            <div class="col-sm-4 d-flex align-items-center justify-content-end">
                                <label for="state_province"
                                class="form-control-label font-weight-bold panel-font-small m-0">
                                    Fax
                                </label>
                            </div>
                        
                            <div class="col-sm-8">
                                {{ detail.fax }}
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 d-flex justify-content-center mt-3 pl-2">
                        <button type="button" 
                                class="btn btn-secondary btn-sm"
                                @click="closeDetail">
                            Close
                        </button>
                        <button type="button" 
                                class="btn btn-success btn-sm ml-2"
                                @click="updated">
                            Accept
                        </button>
                        <button type="button" 
                                class="btn btn-danger btn-sm ml-2"
                                @click="deleteMember">
                            Reject
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
    export default{
        props:{detail:{}},

        data(){
            return{
                isRequesting: false,
            }
        },

        filters: {
            date: function (value) {
                return value.slice(0,10);
            }
        },

        methods:{
            updated(){

                const self = this;

                if (!this.isRequesting) {

                    self.isRequesting = true;

                    const updatedMember = {
                        id: this.detail.id,
                        is_approve: !this.detail.is_approve,
                    };

                    this.$store.dispatch('update_member', updatedMember)                        

                        .then((updatedMember) => {

                            flash('Member has been accepted', 'success');

                            self.isRequesting = false;
                        })
                        .catch(errors => {

                            self.isRequesting = false;

                        });
                }
            },

            deleteMember() {

                const self = this;

                if(self.isRequesting = true){

                    self.isRequesting = true;

                    this.$store.dispatch('destroy_item', {
                        class_id: self.detail.class_id,
                        member_id: self.detail.id,
                    })
                    .then(() => {

                        flash('Member has been rejected', 'danger');

                        self.isRequesting = false;

                    })
                    .catch(errors => {

                        self.isRequesting = false;

                    });
                }
            },


            closeDetail() {
                this.$emit('closeDetail', false);
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