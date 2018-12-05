<template>
    <transition enterActiveClass="fade-in-down"leaveActiveClass="fade-out-up"mode="out-in">
    <div>
        <div class="panel-default panel mt-3 pt-4 bg-grey" id="edit_sosmed" v-if="!isEdit">
            <div class="panel-body">
                <h3 class="text-center"><strong>{{ member.name }}</strong> Detail</h3>

                <div class="row pl-0 pr-0 m-0 pt-4 pb-4">

                    <div class="col-6">
                        <div class="col-sm-12 row form-group">
                            <div class="col-sm-4 col-xs-12 d-flex align-items-center justify-content-end">
                                <label class="form-control-label font-weight-bold panel-font-small m-0">
                                    Name
                                </label>
                            </div>
                            
                            <div class="col-sm-8 col-xs-12">
                                {{ member.name }}
                            </div>
                        </div>

                        <div class="col-sm-12 row form-group">
                            <div class="col-sm-4 d-flex align-items-center justify-content-end">
                                <label class="form-control-label font-weight-bold panel-font-small m-0">
                                    Gender
                                </label>
                            </div>
                        
                            <div class="col-sm-8">
                                {{ member.gender == 1 ? 'Men' : 'Women' }}
                            </div>
                        </div>

                        <div class="col-sm-12 row form-group">
                            <div class="col-sm-4 d-flex align-items-center justify-content-end">
                                <label class="form-control-label font-weight-bold panel-font-small m-0">
                                    Place of birth
                                </label>
                            </div>
                        
                            <div class="col-sm-8">
                                {{ member.place_of_birth }}
                            </div>
                        </div>

                        <div class="col-sm-12 row form-group">
                            <div class="col-sm-4 d-flex align-items-center justify-content-end">
                                <label class="form-control-label font-weight-bold panel-font-small m-0">
                                    Date of birth
                                </label>
                            </div>
                        
                            <div class="col-sm-8">
                                {{ member.date_of_birth | date }}
                            </div>
                        </div>

                        <div class="col-sm-12 row form-group">
                            <div class="col-sm-4 d-flex align-items-center justify-content-end">
                                <label class="form-control-label font-weight-bold panel-font-small m-0">
                                    Join Date
                                </label>
                            </div>
                        
                            <div class="col-sm-8" v-if="member.join_date != null">
                                {{ member.join_date | date }}
                            </div>
                            <div class="col-sm-8" v-else>
                                None
                            </div>
                        </div>

                     </div>

                    <div class="col-6">

                        <div class="col-sm-12 row form-group">
                            <div class="col-sm-4 d-flex align-items-center justify-content-end">
                                <label class="form-control-label font-weight-bold panel-font-small m-0">
                                    Type
                                </label>
                            </div>
                        
                            <div class="col-sm-8">
                                {{ member.is_teacher | type }}
                            </div>
                        </div>

                        <div class="col-sm-12 row form-group">
                            <div class="col-sm-4 d-flex align-items-center justify-content-end">
                                <label class="form-control-label font-weight-bold panel-font-small m-0">
                                    Email
                                </label>
                            </div>
                        
                            <div class="col-sm-8">
                                {{ member.email }}
                            </div>
                        </div>

                       <div class="col-sm-12 row form-group">
                            <div class="col-sm-4 d-flex align-items-center justify-content-end">
                                <label class="form-control-label font-weight-bold panel-font-small m-0">
                                    Telephone
                                </label>
                            </div>
                        
                            <div class="col-sm-8">
                                {{ member.telephone }}
                            </div>
                        </div>

                        <div class="col-sm-12 row form-group">
                            <div class="col-sm-4 d-flex align-items-center justify-content-end">
                                <label class="form-control-label font-weight-bold panel-font-small m-0">
                                    Mobile
                                </label>
                            </div>
                        
                            <div class="col-sm-8">
                                {{ member.mobile }}
                            </div>
                        </div>

                        <div class="col-sm-12 row form-group">
                            <div class="col-sm-4 d-flex align-items-center justify-content-end">
                                <label class="form-control-label font-weight-bold panel-font-small m-0">
                                    Fax
                                </label>
                            </div>
                        
                            <div class="col-sm-8">
                                {{ member.fax }}
                            </div>
                        </div>

                    </div>

                    <div class="col-12">
                        
                        <div class="col-sm-12 row form-group">
                            <div class="col-sm-2 d-flex align-items-center justify-content-end">
                                <label class="form-control-label font-weight-bold panel-font-small m-0">
                                    Teacher
                                </label>
                            </div>
                        
                            <div class="col-sm-10 pl-1">
                                {{ teacherName }}
                            </div>
                        </div>
                    </div>

                    <div class="col-12">

                         <div class="col-sm-12 row form-group">
                            <div class="col-sm-2 d-flex align-items-center justify-content-end">
                                <label class="form-control-label font-weight-bold panel-font-small m-0">
                                    Address
                                </label>
                            </div>
                        
                            <div class="col-sm-10 pl-1">
                                {{ member.address }}
                            </div>
                        </div>
                    </div>

                    <div class="col-12">

                        <div class="col-sm-12 row form-group">
                            <div class="col-sm-2 d-flex align-items-center justify-content-end">
                                <label class="form-control-label font-weight-bold panel-font-small m-0">
                                    Class
                                </label>
                            </div>
                        
                            <div class="col-sm-10 d-flex pt-2 pl-1 row m-0" v-if="member.class.length > 0">
                                <div v-for="classList in member.class" class="mr-2 mb-2"
                                style="border: 1px #908f96 solid; padding: 2px 6px; border-radius: 10%; color: #6d6c73">
                                    {{ classList.title }}
                                </div>
                            </div>

                            <div class="col-sm-10 d-flex pl-1" v-else>None</div>
                        </div>
                    </div>

                    <div class="col-12">

                        <div class="col-sm-12 row form-group">
                            <div class="col-sm-12 col-md-2 d-flex align-items-center justify-content-end">
                                <label class="form-control-label font-weight-bold panel-font-small m-0">
                                    Rank
                                </label>
                            </div>
                            
                            <div class="col-sm-10 d-flex pl-1 row m-0" v-if="member.rank.length > 0">
                                <div v-for="rank in member.rank" class="mr-2 pt-2 pb-2 text-center"
                                    style="border-right: 1px #d7d6d6 solid; padding: 0 10px 0 0; width: 100px">
                                    <p style="margin-bottom: -4px; color: #5e5b5b; font-size: 0.9em">
                                        {{ rank.title }}
                                    </p>
                                    <span style="font-size: 12px; color: grey"> 
                                        {{ rank.pivot.annointed_date }} 
                                    </span> 
                                </div>
                            </div>

                            <div class="col-sm-10 d-flex pl-1" v-else>None</div>
                        </div>

                    </div>

                    <div class="col-12">

                        <div class="col-sm-12 row form-group">
                            <div class="col-sm-2 d-flex align-items-center justify-content-end">
                                <label class="form-control-label font-weight-bold panel-font-small m-0">
                                    Subscription
                                </label>
                            </div>
                        
                            <div class="col-sm-10 d-flex pt-2 pl-1 row m-0" v-if="member.subscription.length > 0">
                                <div v-for="subscription in subscriptions" class="mr-2 mb-2"
                                     style="border: 1px #908f96 solid; padding: 2px 6px; border-radius: 10%; color: #6d6c73">
                                    {{ subscription.year }}
                                </div>
                            </div>

                            <div class="col-sm-10 d-flex pl-1" v-else>None</div>
                        </div>

                    </div>

                    <div class="col-12">

                        <div class="col-sm-12 row form-group">
                            <div class="col-sm-2 d-flex align-items-center justify-content-end">
                                <label class="form-control-label font-weight-bold panel-font-small m-0">
                                    Class Region
                                </label>
                            </div>
                        
                            <div class="col-sm-10 d-flex pt-2 pl-1 row m-0" v-if="member.region.length > 0">
                                <div v-for="region in member.region" class="mr-2 mb-2"
                                style="border: 1px #908f96 solid; padding: 2px 6px; color: #6d6c73">
                                    {{ region.city }}, {{ region.address }}
                                </div>
                            </div>

                            <div class="col-sm-10 d-flex pl-1" v-else>None</div>
                        </div>

                    </div>


                    <div class="col-sm-12 d-flex justify-content-center mt-3 pl-2">
                        <button type="button" 
                                class="btn btn-secondary btn-sm"
                                @click="closemember">
                            Close
                        </button>
                        <button type="button" 
                                class="btn btn-success btn-sm ml-2"
                                @click="shoeEdit()">
                            Edit
                        </button>
                        <button type="button" 
                                class="btn btn-danger btn-sm ml-2"
                                @click="deleteMember">
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <edit-member v-if="isEdit" :member="member" :teacherId="teacherId"
            @closeEditMember="isEdit = $event">
            </edit-member>
        </div>
    </div>
    </transition>
</template>

<script>
    import {mapGetters} from 'vuex';
    import EditMember from './EditMember.vue'
    export default{
        props:{member:{},teacherId:'', type:''},

        data(){
            return{
                isRequesting: false,
                isEdit: false,
            }
        },

        components:{
            EditMember,
        },

        computed:{
            ...mapGetters({
                teachers: 'getTeachers'
            }),

            teacherName(){
                if(this.teacherId === undefined){
                    return 'None'
                }
                return _.find(this.teachers,['id', this.teacherId]).name;
            },

            subscriptions(){

                return _.sortBy(this.member.subscription,'year');

            }
        },

        filters: {
            date: function (value) {
                return value.slice(0,10);
            },

            type: function (value){

                return value === 0 ? 'Student' : 'Teacher';
            }
        },

        methods:{

            shoeEdit(){
                this.isEdit = !this.isEdit;
            },

            deleteMember() {
                this.$emit('showDeactivateModal', this.member);

            },

            closemember() {
                this.$emit('closeDetailMember', false);
            }
        }
    };
</script>

<style>
    .bg-grey {
        background: #fafafa;
    }

    .panel-font-small {
        font-size: 0.9rem;
    }
</style>