<template>
    <div class="card mt-3">

        <div class="card-block">

            <transition enterActiveClass="fade-in"
                        leaveActiveClass="fade-out"
                        mode="out-in">
                <div class="row">


                    <!--=========================================================================================
                        S H O W    N A M E
                        =========================================================================================-->
                    <div class="col">
                        <p class="small text-uppercase mb-0"><strong>Name</strong></p>
                        <div class="detail">
                            <p class="mb-0">{{ item.name }}</p>
                        </div>
                    </div>


                    <!--=========================================================================================
                        S H O W    E M A I L
                        =========================================================================================-->
                    <div class="col">
                        <p class="small text-uppercase mb-0"><strong>Email</strong></p>
                        <div class="detail">
                            <p class="mb-0 max-lines">{{ item.email }}</p>
                        </div>
                    </div>


                    <!--=========================================================================================
                        S H O W    P H O N E   N U M B E R
                        =========================================================================================-->
                    <div class="col">
                        <p class="small text-uppercase mb-0"><strong>Phone Number</strong></p>
                        <div class="detail max-lines">
                            <p class="mb-0">{{ item.phone }}</p>
                        </div>
                    </div>


                    <!--=========================================================================================
                        S H O W    E M A I L
                        =========================================================================================-->
                    <div class="col">
                        <p class="small text-uppercase mb-0"><strong>Status</strong></p>
                        <div class="detail">
                            <p class="mb-0 max-lines">{{ item.is_approve === 1 || item.is_approve === true ? 'Approve' : 'Waiting..' }}</p>
                        </div>
                    </div>

                    <!--=========================================================================================
                        B U T T O N   E D I T
                        =========================================================================================-->
                    <div class="col align-items-center justify-content-end" v-if="item.is_approve === 0">
                        <button type="button" class="btn btn-success btn-sm" @click="editItem">
                                Approve
                        </button>
                        <button type="button" class="btn btn-danger btn-sm" @click="deleteItem">
                                Reject
                        </button>
                    </div>
                </div>
            </transition>
        </div>
    </div>
</template>

<script>
    export default{
        props:{item:{}},

        data(){
            return{
                isRequesting: false,
            }
        },


        methods:{
            editItem(){

                const self = this;

                if (!this.isRequesting) {

                    this.isRequesting = true;

                    const updatedItem = {
                        id: this.item.id,
                        is_approve: !this.item.is_approve
                    };

                    this.$store.dispatch('update_item', updatedItem)

                        .then((updatedItem) => {

                            flash('Applicant Berhasil disetujui', 'success');

                            self.isRequesting = false;

                        })
                        .catch(errors => {


                            self.isRequesting = false;

                        });
                }
            },

            deleteItem() {
                const self = this;

                this.$store.dispatch('destroy_item', {
                    itemId: self.item.id
                })
                .then(() => {
                    flash('Applicant berhasil ditolak', 'danger')
                })
            },
        }
    };
</script>
<style scoped>
    .card {
        border: 1px solid transparent !important;
    }

    .card-block{
        padding: 1em !important;
    }
    
    .detail {
        line-height: 30px !important;
        vertical-align: middle !important;
        padding: 0 !important;
    }

    .f-24 {
        font-size: 24px !important;
    }

    .bgSalmon {
        background: salmon;
    }

    .max-lines{
      text-overflow: ellipsis;
      max-width: 80ch;
      overflow: hidden;
      white-space: nowrap;
    }
</style>