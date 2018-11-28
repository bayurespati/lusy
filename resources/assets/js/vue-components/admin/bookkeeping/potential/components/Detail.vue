<template>

    <transition enterActiveClass="fade-in-down"leaveActiveClass="fade-out-up"mode="out-in">
        <div class="panel-default panel mt-3 pt-4 bg-grey" id="edit_sosmed">
            <div class="panel-body">
                <h3 class="text-center font-weight-bold">Detail {{ detail.buyer_name }}</h3>

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
                                {{ detail.buyer_name }}
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
                                {{ detail.gender == 1 ? 'Male' : 'Female' }}
                            </div>
                        </div>

                        <div class="col-sm-12 row form-group">
                            <div class="col-sm-4 d-flex align-items-center justify-content-end">
                                <label for="address"
                                class="form-control-label font-weight-bold panel-font-small m-0">
                                    Address
                                </label>
                            </div>
                        
                            <div class="col-sm-8">
                                {{ detail.address }}
                            </div>
                        </div>

                        <div class="col-sm-12 row form-group">
                            <div class="col-sm-4 d-flex align-items-center justify-content-end">
                                <label for="email"
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
                                    Shop Item
                                </label>
                            </div>
                        
                            <div class="col-sm-8">
                                {{ detail.shop.title }}
                            </div>
                        </div>

                    </div>

                    <div class="col-6">
                        <div class="col-sm-12 row form-group">
                            <div class="col-sm-4 d-flex align-items-center justify-content-end">
                                <label for="city"
                                class="form-control-label font-weight-bold panel-font-small m-0">
                                    City
                                </label>
                            </div>
                        
                            <div class="col-sm-8">
                                {{ detail.city }}
                            </div>
                        </div>

                        <div class="col-sm-12 row form-group">
                            <div class="col-sm-4 d-flex align-items-center justify-content-end">
                                <label for="state_province"
                                class="form-control-label font-weight-bold panel-font-small m-0">
                                    State/Province
                                </label>
                            </div>
                        
                            <div class="col-sm-8">
                                {{ detail.state_province }}
                            </div>
                        </div>

                        <div class="col-sm-12 row form-group">
                            <div class="col-sm-4 d-flex align-items-center justify-content-end">
                                <label for="state_province"
                                class="form-control-label font-weight-bold panel-font-small m-0">
                                    Postal Code
                                </label>
                            </div>
                        
                            <div class="col-sm-8">
                                {{ detail.postal_code }}
                            </div>
                        </div>

                        <div class="col-sm-12 row form-group">
                            <div class="col-sm-4 d-flex align-items-center justify-content-end">
                                <label for="quantity"
                                class="form-control-label font-weight-bold panel-font-small m-0">
                                    Quantity
                                </label>
                            </div>
                        
                            <div class="col-sm-8">
                                {{ detail.quantity }}
                            </div>
                        </div>

                        <div class="col-sm-12 row form-group">
                            <div class="col-sm-4 d-flex align-items-center justify-content-end">
                                <label for="notes"
                                class="form-control-label font-weight-bold panel-font-small m-0">
                                    Notes
                                </label>
                            </div>
                        
                            <div class="col-sm-8">
                                {{ detail.notes }}
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
                            Approve
                        </button>
                        <button type="button" 
                        class="btn btn-danger btn-sm ml-2"
                        @click="deletePotential">
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
                isRequsting: false,
            }
        },

        methods:{
            updated(){

                const self = this;

                if (!self.isRequsting) {

                    this.isRequsting = true;

                    const isBool = this.detail.is_confirmed == 0 ? true : false;

                    const updatedPotential = {
                        id: this.detail.id,
                        is_confirmed: isBool,
                    };

                    this.$store.dispatch('update_potential', updatedPotential)                        

                        .then((updatedPotential) => {

                            self.isRequsting = false;

                            flash('Potential Inquiry accepted', 'success');
                        })
                        .catch(errors => {

                            self.isRequsting = false;

                        });
                }
            },

            deletePotential() {
                const self = this;

                if(!self.isRequsting){

                    self.isRequsting = true;

                    this.$store.dispatch('destroy_item', {
                        itemId: self.detail.id
                    })
                    .then(() => {

                        self.isRequsting = false;

                        flash('Potential Inquiry rejected', 'danger')
                    })
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