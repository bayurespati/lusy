<template>
  <div class="container">
    <delete-member :show-modal="showModal"
    :member="member"
    @set-show-modal-to-false="hideModal">
    </delete-member>

    <h3>Member List</h3>
    <p class="mb-3">
      Here is where you can see list of <strong>members</strong>
      <transition enterActiveClass="fade-in"leaveActiveClass="fade-out"mode="out-in">
        <span v-if="searchBy.length >= 1" style="color:#8f8d8d"> find by 
          <strong style="color: #4e4c4c"> "{{ searchBy }}" </strong> 
        </span>
      </transition>
    </p>

    <transition enterActiveClass="fade-in"leaveActiveClass="fade-out"mode="out-in">
      <template v-if="!isAddMember">
        <div class="row">
          <div class="col-6">
            <button @click="isAddMember = !isAddMember" class="btn btn-primary">Add Member</button>
          </div>
          
          <div class="col-6">
            <input type="text" placeholder="Find" class="form-control mr-3" @input="search">
          </div>
        </div>
      </template>
      <template v-else>
        <add-member @closeAddMember="isAddMember = $event"></add-member>
      </template>
    </transition>

    <div class="row mt-4">
      <div class="col-12 btn-group btn-group-toggle" data-toggle="buttons">
        <label class="btn btn-secondary btn-full-width active" @click="changeValue('true')">
          <input type="radio" name="options-member"
                 id="option1" autocomplete="off"> Active Members
        </label>
        <label class="btn btn-secondary btn-full-width" @click="changeValue('false')">
          <input type="radio" name="options-member"
                 id="option2" autocomplete="off"> Inactive Members
        </label>
      </div>
    </div>

    <div class="row mt-3">
      <div class="col-12">
        <select class="form-control" id="sel1" v-model="type">
          <option disabled="">Change the order based on..</option>
          <option value="subscription">Subscription Payment</option>
          <option value="gender">Gender</option>
          <option value="join_date">Join Date</option>
          <option value="rank">Current Rank</option>
          <option value="date_of_birth">Place & Date of Birth</option>
          <option value="address">Address</option>
          <option value="telephone">Telephone</option>
          <option value="mobile">Mobile Phone</option>
          <option value="fax">Fax</option>
          <option value="email">Email</option>
        </select>
      </div>
    </div>
    
    <transition enterActiveClass="fade-in" leaveActiveClass="fade-out" mode="in-out">
    <div class="row mt-3" v-if="isSubscription">
      <div class="col-12 form-group">
        <select class="form-control" id="sel1"  v-model="yearSubs">
          <option value="" disabled="">Choose year..</option>
          <option :value="year.year" v-for="year in showYeas"> {{ year.year }}</option>
        </select>
      </div>
  </div>
    </transition>
  
    <div class="row">
      <div class="col-md-12">
        <transition-group name="slide">
          <member v-for="member in showMember"
          :member="member" :type="type" :yearSubs="yearSubs"
          :key="member.id" @showDeactivateModal="showDeactivateModal">
          </member>
        </transition-group>
      </div>
    </div>

  
    <div class="row">
      <div class="col-md-12">
        <transition-group name="slide">
          <teacher v-for="teacher in teachers"
          :teacher="teacher" :status="active" :type="type" :yearSubs="yearSubs" :searchBy="searchBy"
          :key="teacher.id" @showDeactivateModal="showDeactivateModal">
          </teacher>
        </transition-group>
      </div>
    </div>
  </div>
</template>

<script>
  import Teacher from './Teacher.vue';
  import AddMember from './AddMember.vue';
  import Member from './Member.vue';
  import DeleteMember from './DeleteMember.vue';
  import {mapGetters} from 'vuex';

  export default {

    data(){
      return{
        searchBy: '',
        isAddMember : false,
        active: true,
        type: 'email',
        yearSubs: '',
        showModal: false,
        member: {} 
      }
    },

    components:{
      Member,
      AddMember,
      Teacher,
      DeleteMember,
    },

    computed:{
        ...mapGetters({
            teachers : 'getTeachers',
            members : 'getStudentNoTeacher',
            subscriptions : 'getSubscription'
        }),

        showYeas(){
          let tempYeas = _.uniqBy(this.subscriptions,'year');
          return _.sortBy(tempYeas,'year');
        },

        showMember(){
          const tempType = this.type === 'subscription' ? 'email' : this.type;

          let tempMember =  _.sortBy(_.filter(this.members,['is_active', this.active ]), [tempType]);

          let re = new RegExp(this.searchBy, 'i');

          let memberBySearch =  tempMember.filter(member => {
              return re.test(member.name)
                  || re.test(member.address)
                  || re.test(member.email)
                  || re.test(member.fax)
                  || re.test(member.mobile)
                  || re.test(member.telephone)
                  || re.test(member.place_of_birth)
                  || re.test(member.date_of_birth);
          });

          return memberBySearch;
        },

        isSubscription(){
          return this.type == 'subscription';
        }
    },

    methods:{
      changeValue(value){
        this.active = !this.active;
      },

      hideModal(){
        this.showModal = false;
        this.member = {};
      },

      showDeactivateModal(newMember){
        this.showModal = true;
        this.member = newMember;
      },

      search(event) {
        this.searchBy = event.target.value;
      }
    }
  };
</script>

<style scoped>
  select {
    text-align: center;
    text-align-last: center;
    font-weight: bold;
    /* webkit*/
  }

  .btn-full-width {
    display: inline-block;
    width: 100%;
  }

  .slide-enter {
      opacity: 0;
  }

  .slide-enter-active {
      animation: slide-in 0.6s ease;
      transition: opacity 0.6s;
  }

  .slide-leave {
  }

  .slide-leave-active {
      animation: slide-out 0.6s ease forwards;
      transition: opacity 0.6s;
      opacity: 0;
      position: absolute;
      width: 100%;
  }

  .slide-move {
      transition: transform 0.6s;
  }

  @keyframes slide-in {
      from {
          transform: translateY(-20px);
      }
      to {
          background-color: white;
          transform: translateY(0px);
      }
  }

  @keyframes slide-out {
      from {
          transform: translateY(0);
      }
      to {
          transform: translateY(-20px);
      }
  }
</style>