<template>
    <div>
        <div class="card mt-3" style="background-color: #6d7fcc;">
            <div class="card-block">
                <transition enterActiveClass="fade-in" leaveActiveClass="fade-out" mode="out-in">
                    <div class="row">

                        <div class="col-5 d-flex justify-content-start align-items-center">
                            <div>
                                <p class="small text-uppercase mb-0">
                                    <strong>Name</strong>
                                </p>
                            
                                <div class="detail">
                                    <p class="mb-0">{{ teacher.name }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-start align-items-center" :class="totalStudent > 0 ? 'col-5' : 'col-7'">
                            <div>
                                <p class="small text-uppercase mb-0">
                                    <strong>Total Students</strong>
                                </p>
                            
                                <div class="detail text-center">
                                    <p class="mb-0">{{ totalStudent }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-2 d-flex justify-content-end align-items-center" v-if="totalStudent > 0">
                            <button type="button" class="btn btn-sm btn-success ml-2"
                            @click="isShow = !isShow">
                              Show Student
                            </button>
                        </div>
                    </div>
                </transition>
            </div>
        </div>
        <transition-group name="slide" mode="out-in">
          <member v-for="member in showMember"
                  :member="member" v-if="isShow"
                  :teacherId="teacher.id" :type="type" :yearSubs="yearSubs"
                  @showDeactivateModal="showDeactivateModal"
                  :key="member.id">
          </member>
        </transition-group>
    </div>
</template>
<script>
    import Member from './Member.vue';
    export default{
        props:{teacher:{}, status:'' , type:'', yearSubs:''},

        data(){
            return{
                isRequesting: false,
                isShow: false,
            }
        },

        components:{
            Member
        },

        computed:{
            totalStudent(){
                return  this.teacher.student.length;
            },

            showMember(){

              const tempType = this.type === 'subscription' ? 'email' : this.type;

              return _.sortBy(_.filter(this.teacher.student,['is_active', this.status ]), [tempType]);
            },
        },

        methods:{
          showDeactivateModal(member){;
            this.$emit('showDeactivateModal', member);
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

    .card-block p {
      color: white;
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