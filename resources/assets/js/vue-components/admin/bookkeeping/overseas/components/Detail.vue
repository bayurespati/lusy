<template>

    <transition enterActiveClass="fade-in-down"leaveActiveClass="fade-out-up"mode="out-in">
        <div class="panel-default panel mt-3 pt-4 bg-grey" id="edit_sosmed">
            <div class="panel-body">
                <h3 class="text-center font-weight-bold">Detail</h3>

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
                            {{ detail.buyer_name }}
                        </div>
                    </div>


                    <!--=========================================================================================
                        G E N D E R
                        =========================================================================================-->
                    <div class="col-sm-12 row form-group">
                        <div class="col-sm-3 d-flex align-items-center justify-content-end">
                            <label for="gender"
                            class="form-control-label font-weight-bold panel-font-small m-0">
                                Gender
                            </label>
                        </div>
                        <div class="col-sm-9">
                            {{ detail.gender === 1 ? 'Men' : 'Women' }}
                        </div>
                    </div>


                    <!--=========================================================================================
                        A D D R E S S
                        =========================================================================================-->
                    <div class="col-sm-12 row form-group">
                        <div class="col-sm-3 d-flex align-items-center justify-content-end">
                            <label for="address"
                                   class="form-control-label font-weight-bold panel-font-small m-0">
                                Address
                            </label>
                        </div>
                        <div class="col-sm-9">
                            {{ detail.address }}
                        </div>
                    </div>


                    <!--=========================================================================================
                        E M A I L
                        =========================================================================================-->
                    <div class="col-sm-12 row form-group">
                        <div class="col-sm-3 d-flex align-items-center justify-content-end">
                            <label for="email"
                                   class="form-control-label font-weight-bold panel-font-small m-0">
                                Email
                            </label>
                        </div>
                        <div class="col-sm-9">
                            {{ detail.email }}
                        </div>
                    </div>


                    <!--=========================================================================================
                        C I T Y
                        =========================================================================================-->
                    <div class="col-sm-12 row form-group">
                        <div class="col-sm-3 d-flex align-items-center justify-content-end">
                            <label for="city"
                                   class="form-control-label font-weight-bold panel-font-small m-0">
                                CITY
                            </label>
                        </div>
                        <div class="col-sm-9">
                            {{ detail.city }}
                        </div>
                    </div>


                    <!--=========================================================================================
                        S T A T E    P R O V I N C E
                        =========================================================================================-->
                    <div class="col-sm-12 row form-group">
                        <div class="col-sm-3 d-flex align-items-center justify-content-end">
                            <label for="state_province"
                                   class="form-control-label font-weight-bold panel-font-small m-0">
                                State Province
                            </label>
                        </div>
                        <div class="col-sm-9">
                            {{ detail.state_province }}
                        </div>
                    </div>


                    <!--=========================================================================================
                        P O S T A L   C O D E
                        =========================================================================================-->
                    <div class="col-sm-12 row form-group">
                        <div class="col-sm-3 d-flex align-items-center justify-content-end">
                            <label for="state_province"
                                   class="form-control-label font-weight-bold panel-font-small m-0">
                                Postal Code
                            </label>
                        </div>
                        <div class="col-sm-9">
                            {{ detail.postal_code }}
                        </div>
                    </div>


                    <!--=========================================================================================
                        N O T E S
                        =========================================================================================-->
                    <div class="col-sm-12 row form-group">
                        <div class="col-sm-3 d-flex align-items-center justify-content-end">
                            <label for="notes"
                                   class="form-control-label font-weight-bold panel-font-small m-0">
                                Notes
                            </label>
                        </div>
                        <div class="col-sm-9">
                            {{ detail.notes }}
                        </div>
                    </div>

                    <!--=========================================================================================
                        Q U A N T I T Y
                        =========================================================================================-->
                    <div class="col-sm-12 row form-group">
                        <div class="col-sm-3 d-flex align-items-center justify-content-end">
                            <label for="quantity"
                                   class="form-control-label font-weight-bold panel-font-small m-0">
                                Quantity
                            </label>
                        </div>
                        <div class="col-sm-9">
                            {{ detail.quantity }}
                        </div>
                    </div>


                    <!--=========================================================================================
                        A C T I O N   B U T T O N
                        =========================================================================================-->
                    <div class="col-sm-4 offset-3 d-flex justify-content-start mt-3 pl-2">
                        <button type="button" 
                        class="btn btn-secondary btn-sm"
                        @click="closeDetail">
                            Close
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

        methods:{
            closeDetail() {
                this.$emit('closeDetail', false);
            },
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