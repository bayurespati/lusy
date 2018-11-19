<template>
    <div class="card mt-3">

        <div class="card-block">

            <transition enterActiveClass="fade-in"
                        leaveActiveClass="fade-out"
                        mode="out-in">
                <div class="row">

                    <div class="col-3 d-flex align-items-center justify-content-star">
                        <div>
                            <p class="small text-uppercase mb-0">
                                <strong>Name</strong>
                            </p>
                        
                            <div class="detail">
                                <p class="mb-0">{{ item.name }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-3 d-flex justify-content-center align-items-center">
                        <div>
                            <p class="small text-uppercase mb-0 text-center">
                                <strong>Email</strong>
                            </p>
                        
                            <div class="detail">
                                <p class="mb-0 text-center">{{ item.email }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-2 d-flex justify-content-center align-items-center">
                        <div>
                            <p class="small text-uppercase mb-0 text-center">
                                <strong>Phone number</strong>
                            </p>
                        
                            <div class="detail">
                                <p class="mb-0 text-center">{{ item.phone }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center align-items-center"
                    :class="item.is_approve == 0 ? 'col-2' : 'col-4'">
                        <div>
                            <p class="small text-uppercase mb-0 text-center">
                                <strong>Status</strong>
                            </p>
                            
                            <div class="detail">
                                <p class="mb-0 text-center">{{ item.is_approve == 1 || item.is_approve == true ? 'Approve' : 'Waiting' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-2 d-flex align-items-center justify-content-end" 
                         v-if="item.is_approve == 0 || item.is_approve == false">
                        <button type="button" 
                        class="btn btn-success btn-sm" 
                        @click="editItem">
                            Approve
                        </button>
                        <button type="button" 
                        class="btn btn-danger btn-sm ml-2" 
                        @click="deleteItem">
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

                    const isBool = this.item.is_approve == 0 ? true : false;

                    const updatedItem = {
                        id: this.item.id,
                        is_approve: isBool
                    };

                    this.$store.dispatch('update_item', updatedItem)

                        .then((updatedItem) => {

                            flash('Applicant approved', 'success');

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