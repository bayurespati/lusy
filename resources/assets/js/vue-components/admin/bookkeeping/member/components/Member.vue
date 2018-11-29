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

                    <div class="col-3 d-flex justify-content-start align-items-center" v-if="type == 'date_of_birth' ">
                        <div>
                            <p class="small text-uppercase mb-0">
                                <strong>{{  showData.name1 }}</strong>
                            </p>
                        
                            <div class="detail text-center">
                                <p class="mb-0">{{ showData.value1 }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-3 d-flex justify-content-start align-items-center">
                        <div>
                            <p class="small text-uppercase mb-0">
                                <transition enterActiveClass="fade-in" leaveActiveClass="fade-out" mode="out-in"> 
                                    <strong v-if="!isOff">{{ showData.name }}</strong>
                                </transition>
                            </p>
                        
                            <div class="detail">
                                <transition enterActiveClass="fade-in" leaveActiveClass="fade-out" mode="out-in"> 
                                    <p class="mb-0 text-center" v-if="!isOff">{{ showData.value }}</p>
                                </transition>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-3 d-flex justify-content-end align-items-center">
                        
                        <transition enterActiveClass="fade-in" leaveActiveClass="fade-out" mode="out-in"> 
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
                        <edit-member v-if="isEdit" :member="member" :teacherId="teacherId"
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
        props:{member:{},teacherId:'', type:'', yearSubs:''},

        data(){
            return{
                isOff: false,
                name: '',
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
                    is_active: this.member.is_active,
                    is_teacher: this.member.is_teacher
                }
            }
        },

        components:{
            EditMember
        },

        computed:{
            showData(){
                const self = this;
                this.isOff = true;
                setTimeout(function(){
                    self.isOff = false;
                },200)

                if(this.type === 'email' ){
                    return { name: 'Email', value: this.member.email }
                }else if(this.type === 'fax'){
                    return { name: 'Fax', value: this.member.fax }
                }else if(this.type === 'mobile'){
                    return { name: 'Mobile Phone', value: this.member.mobile }
                }else if(this.type === 'telephone'){
                    return { name: 'Telephone', value: this.member.telephone }
                }else if(this.type === 'join_date'){
                    if(this.member.join_date === null){
                        return { name: 'Join date', value: 'Not yet' }
                    }else{
                        return { name: 'Join date', value: this.member.join_date.substring(0,10) }
                    }
                }else if(this.type === 'gender'){
                    return { name: 'Gender', value: this.member.gender === 1 ? 'Male' : 'Female' }
                }else if(this.type === 'rank'){
                    if(this.member.rank.length === 0){
                        return { name: 'Rank', value: 'Not yet' }
                    }else{
                        return { name: 'Rank', value: this.member.rank[this.member.rank.length - 1].title }
                    }
                }else if(this.type === 'address'){
                    return { name: 'Address', value: this.member.address }
                }else if(this.type === 'date_of_birth'){
                    return { 
                        name: 'Date Of Birth', 
                        value: this.member.date_of_birth.substring(0,10), 
                        name1: 'Place Of Birth',
                        value1: this.member.place_of_birth
                    }
                }else if(this.type === 'subscription'){
                    if(this.yearSubs === ''){
                        return { name: 'Subscription', value: 'Chose Years' }
                    }else{
                        
                        const hasYears =  _.find(this.member.subscription,['year',this.yearSubs]);

                        return { 
                            name: 'Subscription', 
                            value: hasYears === undefined ? 'Not yet paid' : 'Already Paid'
                        }
                    }
                }
            }
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