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

                    <div class="col-3 d-flex justify-content-start align-items-center">
                        <div>
                            <p class="small text-uppercase mb-0">
                                <strong>Phone</strong>
                            </p>
                        
                            <div class="detail text-center">
                                <p class="mb-0">{{ member.telephone }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-3 d-flex justify-content-start align-items-center">
                        <div>
                            <p class="small text-uppercase mb-0">
                                <strong>Email</strong>
                            </p>
                        
                            <div class="detail">
                                <p class="mb-0 text-center">{{ member.email }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-3 d-flex justify-content-end align-items-center">
                        
                        <transition enterActiveClass="fade-in"leaveActiveClass="fade-out"mode="out-in"> 
                        <button type="button" v-if="input.is_active"
                                class="btn btn-sm btn-success ml-2"
                                @click="editStatus()">Aktif</button>
    
                        <button type="button" v-else
                                class="btn btn-sm btn-danger ml-2"
                                @click="editStatus()">Non Aktif</button>
                        </transition>

                        <button type="button" 
                                class="btn btn-sm btn-warning ml-2"
                                @click="isEdit = !isEdit">Edit</button>

                        <button type="button" 
                                class="btn btn-sm btn-danger ml-2"
                                @click="deleteMember()">delete</button>

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
                isRequesting: false,
                isEdit: false,
                input:{
                    name: this.member.name,
                    gender: this.member.gender,
                    place_of_birth: this.member.place_of_birth,
                    date_of_birth: this.member.date_of_birth,
                    join_date: this.member.join_date,
                    email: this.member.email,
                    telephone: this.member.telephone,
                    mobile: this.member.mobile,
                    fax: this.member.fax,
                    teacher_id: this.member.teacher_id,
                    gender: this.member.gender,
                    id: this.member.id,
                    is_active: this.member.is_active
                }
            }
        },

        components:{
            EditMember
        },

        methods:{
            editStatus(){
                const self = this;

                if(!self.isRequesting){

                    const isBool = this.member.is_active == 0  ? true : false;

                    this.input.is_active = isBool;

                    self.isRequesting = true;

                    const status = isBool 
                                   ? {status: 'active', color: 'success'} 
                                   : {status: 'not active', color: 'danger'}

                    this.$store.dispatch('update_member',self.input)
                    .then(() =>{
                        flash('Member '+self.input.name+' is '+status.status, status.color);
                        self.isRequesting = false;
                    })
                }
            },

            deleteMember(){

                const self = this;

                if(!self.isRequesting){

                    self.isRequesting = true;

                    this.$store.dispatch('destroy_member',self.member.id)
                        .then(() => {

                            flash('Member has been deleted', 'danger');

                            self.isRequesting = false
                        })
                }

            }
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