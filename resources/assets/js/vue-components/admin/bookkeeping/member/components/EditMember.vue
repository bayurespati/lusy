<template>
    <transition enterActiveClass="fade-in-down"leaveActiveClass="fade-out-up"mode="out-in">
        <div class="panel-default panel mt-3 pt-4 bg-grey" id="edit_member">
            <div class="panel-body">
                <h3 class="text-center mb-3">Edit <strong>{{ member.title }}</strong></h3>

                <div class="row pl-0 pr-0 m-0 pt-4 pb-4">
                    <div class="col-sm-12 d-flex form-group">
                        <div class="col-sm-6 col-xs-12 text-center">
                            <label for="title" class="form-control-label panel-font-small m-0">
                                Name
                            </label>

                            <input type="text"
							v-model="input.name"
							@input="$v.input.name.$touch()"
							class="form-control" id="name-member" 
							:class="{'form-control-danger': $v.input.name.$error}"
							:placeholder="member.name">

							<!--======================================================================================
                            	V A L I D A T I O N     E R R O R   M E S S A G E S
                            	======================================================================================-->
                    		<transition enterActiveClass="fade-in" leaveActiveClass="fade-out" mode="out-in">
                            	<span key="name-required" class="text-danger" 
                            	v-if="!$v.input.name.required && $v.input.name.$dirty">
                            		Name is required
                        		</span>
                            	<span key="Name-minimum" class="text-danger" 
                            	v-else-if="!$v.input.name.minLength">
                            		Name has a minimum of {{ $v.input.name.$params.minLength.min }} characters
                            	</span>
                            	<span key="key-maximum" class="text-danger" 
                            	v-else-if="!$v.input.name.maxLength">
                            		Name has a maximum of {{ $v.input.name.$params.maxLength.max }} characters
                        		</span>
                    		</transition> 
                        </div>

                        <div class="col-sm-6 col-xs-12 text-center">
                        	<label for="gender" class="form-control-label panel-font-small m-0">
	                            Gender
    	                    </label>

							<input type="radio" :name="'gender' + member.id"
							   	   value=1 v-model="input.gender"> Male
							<input type="radio" :name="'gender' + member.id" 
						       	   value=0 v-model="input.gender" class="ml-2"> Female
                        </div>
                    </div>

                    <div class="col-sm-12 d-flex form-group">
                        <div class="col-sm-6 col-xs-12 text-center">
                            <label for="place_of_birth" class="form-control-label panel-font-small m-0">
                                Place of birth
                            </label>

                            <input type="text" 
							v-model="input.place_of_birth"
							@input="$v.input.place_of_birth.$touch()"
							class="form-control" id="place_of_birth"
							:class="{'form-control-danger': $v.input.place_of_birth.$error}"
							:placeholder="member.place_of_birth">

							<!--======================================================================================
                            	V A L I D A T I O N     E R R O R   M E S S A G E S
                            	======================================================================================-->
                    		<transition enterActiveClass="fade-in" leaveActiveClass="fade-out" mode="out-in">
                            	<span key="place_of_birth-required" class="text-danger" 
                            	v-if="!$v.input.place_of_birth.required && $v.input.place_of_birth.$dirty">
                            		Place of birth is required
                        		</span>
                    		</transition>
                        </div>

                        <div class="col-sm-6 col-xs-12 text-center">
                            <label for="date_of_birth" class="form-control-label panel-font-small m-0">
                                Date of birth
                            </label>
                            
                            <datetime type="date" id="date_of_birth" 
							v-model="input.date_of_birth"
							value-zone="local"
							@input="$v.input.date_of_birth.$touch()"
							:class="{'form-control-danger': $v.input.date_of_birth.$error}"
							placeholder="Date of birth">
							</datetime>

							<!--======================================================================================
                            	V A L I D A T I O N     E R R O R   M E S S A G E S
                            	======================================================================================-->
                    		<transition enterActiveClass="fade-in" leaveActiveClass="fade-out" mode="out-in">
                            	<span key="end-required" class="text-danger" 
                            	v-if="!$v.input.date_of_birth.required && $v.input.date_of_birth.$dirty">
                            		Date of birth is required
                        		</span>
                    		</transition> 
                        </div>
                    </div>

                    <div class="col-sm-12 d-flex form-group">
                        <div class="col-sm-6 col-xs-12 text-center">
                            <label for="email-member" class="form-control-label panel-font-small m-0">
                                Email
                            </label>

                            <input type="text" 
							v-model="input.email"
							@input="$v.input.email.$touch()"
							:class="{'form-control-danger': $v.input.email.$error}"
							class="form-control" id="email-member" 
							:placeholder="member.email">

							<!--======================================================================================
                            	V A L I D A T I O N     E R R O R   M E S S A G E S
                            	======================================================================================-->
                    		<transition enterActiveClass="fade-in" leaveActiveClass="fade-out" mode="out-in">
                            	<span key="email-required" class="text-danger" 
                            	v-if="!$v.input.email.required && $v.input.email.$dirty">
                            		Email is required
                        		</span>
                            	<span key="email-minimum" class="text-danger" 
                            	v-else-if="!$v.input.email.minLength">
                            		Email has a minimum of {{ $v.input.email.$params.minLength.min }} characters
                            	</span>
                            	<span key="email-maximum" class="text-danger" 
                            	v-else-if="!$v.input.email.maxLength">
                            		Email has a maximum of {{ $v.input.email.$params.maxLength.max }} characters
                        		</span>
                    		</transition>
                        </div>

                        <div class="col-sm-6 col-xs-12 text-center">
                            <label for="fax-member" class="form-control-label panel-font-small m-0">
                                Fax
                            </label>

                            <input type="text" 
							v-model="input.fax" 
							class="form-control" id="fax"
							:placeholder="member.fax">
                        </div>
                    </div>

                    <div class="col-sm-12 d-flex form-group">
                        <div class="col-sm-6 col-xs-12 text-center">
                            <label for="telephone" class="form-control-label panel-font-small m-0">
                                Telephone
                            </label>
                            
                            <input type="text" 
							v-model="input.telephone"
							@input="$v.input.telephone.$touch()"
							:class="{'form-control-danger': $v.input.telephone.$error}"
							class="form-control" id="telephone" 
							:placeholder="member.telephone">

							<!--======================================================================================
                            	V A L I D A T I O N     E R R O R   M E S S A G E S
                            	======================================================================================-->
                    		<transition enterActiveClass="fade-in" leaveActiveClass="fade-out" mode="out-in">
                            	<span key="telephone-required" class="text-danger" 
                            	v-if="!$v.input.telephone.required && $v.input.telephone.$dirty">
                            		Telephone is required
                        		</span>
                    		</transition>
                        </div>

                        <div class="col-sm-6 col-xs-12 text-center">
                            <label for="mobile" class="form-control-label panel-font-small m-0">
                                Mobile
                            </label>
                            
                            <input type="text" 
							v-model="input.mobile" 
							class="form-control" id="mobile"
							:placeholder="member.mobile">
                        </div>
                    </div>

                    <div class="col-sm-12 d-flex form-group">
                        <div class="col-sm-6 col-xs-12 text-center">
                            <label for="teacher-member" class="form-control-label panel-font-small m-0">
                                Teacher
                            </label>
                            
                            <select class="form-control" id="teacher-member"
                                    v-model="input.teacher_id">
								<option value="Choose teacher" disabled>Choose teacher</option>
                                <option value="null">Teacher not chosen</option>
								<option v-for="item in showTeacher" 
										:value=item.id>{{ item.name }}
								</option>
							</select>
                        </div>

                        <div class="col-sm-6 col-xs-12 text-center">
                            <label for="join_date" class="form-control-label panel-font-small m-0">
                                Join Date
                            </label>
                            
                            <datetime type="date" id="join_birth" 
									  v-model="input.join_date"
									  value-zone="local"
									  placeholder="Join Date">
							</datetime>
                        </div>
                    </div>

                    <div class="col-sm-12 d-flex form-group">
                        <div class="col-sm-12 col-xs-12 text-center">
                            <label for="address" class="form-control-label panel-font-small m-0">
                                Address
                            </label>
                            
                            <input type="text" 
                            v-model="input.address"
                            @input="$v.input.address.$touch()"
                            :class="{'form-control-danger': $v.input.address.$error}"
                            class="form-control" id="address" 
                            :placeholder="member.address">

                            <!--======================================================================================
                                V A L I D A T I O N     E R R O R   M E S S A G E S
                                ======================================================================================-->
                            <transition enterActiveClass="fade-in" leaveActiveClass="fade-out" mode="out-in">
                                <span key="address-required" class="text-danger" 
                                v-if="!$v.input.address.required && $v.input.address.$dirty">
                                    Address is required
                                </span>
                            </transition>
                        </div>
                    </div>
    

                    <div class="col-sm-12 d-flex form-group">
                        <div class="col-sm-6 col-xs-12 text-center">

                            <input type="radio" :name="'is_teacher' + member.id"
                                   value=0 v-model="input.is_teacher"> Student
                            <input type="radio" :name="'is_teacher' + member.id" 
                                   value=1 v-model="input.is_teacher" class="ml-2"> Teacher
                        </div>

                        <div class="col-sm-6 col-xs-12 text-center">

                            <input type="radio" :name="'is_active' + member.id"
                                   value=1 v-model="input.is_active"> Active
                            <input type="radio" :name="'is_active' + member.id" 
                                   value=0 v-model="input.is_active" class="ml-2"> Not Active
                        </div>
                    </div>

                    <div class="col-sm-12 d-flex justify-content-center mt-2">
                        <button @click="editMember" :disabled="isRequesting"
                                class="btn btn-success btn-sm ml-2">
                            <template v-if="isRequesting">Saving..</template>
                            <template v-else>Save</template>
                        </button>
                    </div>
                </div>

            	<edit-rank :member="member" :teacherId="teacherId"> </edit-rank>

                <edit-subscription :member="member" :teacherId="teacherId"> </edit-subscription>
                
                <edit-class :member="member" :teacherId="teacherId"> </edit-class> 

                <edit-region :member="member" :teacherId="teacherId"> </edit-region>

                <div class="row pl-0 pr-0 m-0 pt-4 pb-4">
                	<div class="col-sm-12 d-flex justify-content-center mt-2">
                		<button type="button" class="btn btn-secondary btn-sm"
                                @click="closeEditForm">
                            Close
                        </button>
                	</div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
    import EditClass from './EditAddClass.vue';
    import EditRegion from './EditAddRegion.vue';
    import EditSubscription from './EditAddSubscription.vue';
	import EditRank from './EditAddRank.vue';
	import {required, minLength, maxLength} from 'vuelidate/lib/validators';
	import {mapGetters} from 'vuex';	
	import 'vue-datetime/dist/vue-datetime.css';
	import {Datetime} from 'vue-datetime';
    Vue.use(Datetime)

	export default{
		props:{member:{},teacherId:''},

		data(){
			return{
				isRequesting: false,			
				input:{
					name: this.member.name,
					gender: this.member.gender,
					place_of_birth: this.member.place_of_birth,
					date_of_birth: this.member.date_of_birth.substring(0,10),
					join_date: this.member.join_date == undefined ? '' : this.member.join_date.substring(0,10),
					email: this.member.email,
					telephone: this.member.telephone,
					mobile: this.member.mobile == null ? null : this.member.mobile,
					fax: this.member.fax,
					teacher_id: this.member.teacher_id == null ? null : this.member.teacher_id,
                    is_active: this.member.is_active,
                    is_teacher: this.member.is_teacher,
					gender: this.member.gender,
                    address: this.member.address,
					id: this.member.id
				}
			}
		},

		mounted() {
			this.$v.$reset();
		},

		components:{
			Datetime,
			EditRank,
            EditClass,
            EditRegion,
            EditSubscription
		},


		validations: {
            input: {
                name: {
                    required,
                    minLength: minLength(3),
                    maxLength: maxLength(50)
                },
                gender:{
                	required,
                },
                place_of_birth: {
                    required,
                },
                date_of_birth: {
                	required,
                },
                address:{
                    required
                },
                email:{
                	required,
                	minLength: minLength(3),
                	maxLength: maxLength(50)
                },
                telephone:{
                	required,
                }            
            },
		},

		computed:{
			...mapGetters({
				classList: 'getClass',
				ranks: 'getRanks',
                teachers: 'getTeachers'
			}),

			formIsFilled(){
				return this.input.name !== ''
					&& this.input.name.length >= 3
					&& this.input.name.length <= 50
					&& this.input.gender !== ''
                    && this.input.address !== ''
					&& this.input.place_of_birth !== ''
					&& this.input.email !== ''
					&& this.input.email.length >= 3
					&& this.input.email.length <= 50
					&& this.input.telephone !== ''
			},

            showTeacher(){
                const tempTeacher = [];
                const self = this;

                this.teachers.map(function(value){
                    if(value.id != self.member.id){
                        tempTeacher.push({
                            name: value.name,
                            id: value.id
                        })
                    }
                })

                return tempTeacher;
            }
        },

		methods:{

			editMember(){

				let self = this;

				if(self.formIsFilled && !self.isRequesting && this.memberIsedited()){

					self.isRequesting = true;

					const name = this.input.name;

                    if(this.input.teacher_id === 'null'){
                        this.input.teacher_id = '';
                    }

					this.$store.dispatch('update_member',this.input)
                        .then(() => {
                            flash(name + ' is successfully updated','success');

                            self.isRequesting = false;

                        })
                        .catch(errors => {

                        	self.isRequesting = false;

                            Object.keys(errors).forEach(field=> {
                                errors[field].forEach(message=> {
                                    flash(message, 'danger', 5000);
                                })
                            })
                        });
				}
				else {
					this.dirtyAllInputs();
				}
			},

            memberIsedited(){
                return this.input.name != this.member.name 
                    || this.input.gender != this.member.gender
                    || this.input.place_of_birth != this.member.place_of_birth
                    || this.input.email != this.member.email
                    || this.input.fax != this.member.fax
                    || this.input.address != this.member.address
                    || this.input.is_teacher != this.member.is_teacher
                    || this.input.is_active != this.member.is_active
                    || this.input.teacher_id != this.member.teacher_id
                    || this.input.telephone != this.member.telephone
                    || this.input.mobile != this.member.mobile
                    || this.input.date_of_birth.substring(0,10) != this.member.date_of_birth.substring(0,10)
                    || this.isJoinDate();
            },  

            isJoinDate(){
                if(this.input.join_date == ''){
                    return false
                }else{
                    if(this.member.join_date === null || this.member.join_date === undefined){
                        return true
                    }else{
                        return this.input.join_date.substring(0,10) != this.member.join_date.substring(0,10);
                    }
                }
            },

			dirtyAllInputs(){
                this.$v.input.name.$touch();
                this.$v.input.address.$touch();
                this.$v.input.gender.$touch();
                this.$v.input.place_of_birth.$touch();
                this.$v.input.date_of_birth.$touch();
                this.$v.input.email.$touch();
                this.$v.input.telephone.$touch();
			},

			closeEditForm(){
	           this.$emit('closeEditMember',false);
	        }
		},
	};
</script>

<style type="text/css">
	.vdatetime-input {
        width: 100%;
        padding: .375rem .75rem;
        line-height: 1.5;
        font-size: 1rem;
        color: #495057;
        border-radius: .25rem;
        border: 1px solid #ced4da;
    }

    ::-webkit-input-placeholder {
   		text-align: center;
	}

	:-moz-placeholder { /* Firefox 18- */
   		text-align: center;  
	}

	::-moz-placeholder {  /* Firefox 19+ */
   		text-align: center;  
	}

	:-ms-input-placeholder {  
   		text-align: center; 
	}

	input {
		text-align: center;
	}

	select {
  		text-align: center;
  		text-align-last: center;
  		/* webkit*/
	}

	option {
  		text-align: left;
	}

	.normal-placeholder::-webkit-input-placeholder,
    .normal-placeholder:-moz-placeholder,
    .normal-placeholder::-moz-placeholder,
    .normal-placeholder:-ms-input-placeholder {
        text-align: left !important;
    }

    .form-control-danger input {
    	border-color: #dc3545 !important;
    }

    .form-control-danger input:focus {
    	border-color: #dc3545 !important;
    	box-shadow: 0 0 0 0.2rem rgba(220,53,69,.25) !important;
    }
</style>

<style scoped type="text/css">
	.card {
		flex-direction: unset;
		display: flex;
		flex-wrap: wrap;
		width: 100%;
		padding: 36px 10px 26px 10px;
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