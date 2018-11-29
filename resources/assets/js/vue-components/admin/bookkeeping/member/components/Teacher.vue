<template>
    <div>
        <div class="card mt-3" style="background-color: pink">
            <div class="card-block">
                <transition enterActiveClass="fade-in" leaveActiveClass="fade-out" mode="out-in">
                    <div class="row">

                        <div class="col-4 d-flex justify-content-start align-items-center">
                            <div>
                                <p class="small text-uppercase mb-0">
                                    <strong>Name</strong>
                                </p>
                            
                                <div class="detail">
                                    <p class="mb-0">{{ teacher.name }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-4 d-flex justify-content-start align-items-center">
                            <div>
                                <p class="small text-uppercase mb-0">
                                    <strong>Total Studen</strong>
                                </p>
                            
                                <div class="detail text-center">
                                    <p class="mb-0">{{ totalStudent }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-3 d-flex justify-content-end align-items-center">
                            <button type="button" class="btn btn-sm btn-success ml-2"
                                    @click="isShow = !isShow">Show Student</button>
                        </div>
                    </div>
                </transition>
            </div>
        </div>
        <transition-group name="slide" mode="out-in">
          <member v-for="member in showMember"
                  :member="member" v-if="isShow"
                  :teacherId="teacher.id"
                  :key="member.id">
          </member>
        </transition-group>
    </div>
</template>
<script>
    import Member from './Member.vue';
    export default{
        props:{teacher:{}, status:''},

        data(){
            return{
                isRequesting: false,
                isShow: true,
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
              return _.filter(this.teacher.student,['is_active', this.status ])
            },
        },

        methods:{
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