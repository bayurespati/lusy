<template>
    <div class="card mt-3">
        <div class="card-block">
            <transition enterActiveClass="fade-in"leaveActiveClass="fade-out"mode="out-in">
                <div class="row">

                    <div class="col-2 d-flex justify-content-start align-items-center">
                        <div>
                            <p class="small text-uppercase mb-0">
                                <strong>Name</strong>
                            </p>
                        
                            <div class="detail">
                                <p class="mb-0">{{ member.name }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-3 d-flex justify-content-center align-items-center">
                        <div>
                            <p class="small text-uppercase mb-0">
                                <strong>Phone</strong>
                            </p>
                        
                            <div class="detail text-center">
                                <p class="mb-0">{{ member.telephone }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-3 d-flex justify-content-center align-items-center">
                        <div>
                            <p class="small text-uppercase mb-0">
                                <strong>Email</strong>
                            </p>
                        
                            <div class="detail">
                                <p class="mb-0 text-center">{{ member.email }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-1 d-flex align-items-center justify-content-end">
                        <button type="button" 
                        class="btn btn-sm btn-warning"
                        @click="isEdit = !isEdit">Edit</button>
                    </div>

                    <div class="col-12">
                        <edit-member v-if="isEdit" :member="member"
                            @closeEditMember="isEdit = $event">
                        </edit-member>
                    </div>
                </div>
            </transition>
        </div>
    </div>
</template>

<script>
    import EditMember from './EditMember.vue'
    export default{
        props:{member:{}},

        data(){
            return{
                isEdit: false,
            }
        },

        components:{
            EditMember
        },
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