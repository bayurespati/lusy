<template> 
	<div class="row">
		<div class="col-md-12">
			<div class="card text-center">
				<div class="col-md-12">
					<h4 class="title mb-5">Add New <strong>Member</strong></h4>
				</div>

				<div class="col-md-12 d-flex">
					<div class="col-md-6">
						<div class="form-group text-center mb-3">
							<input type="text" 
							v-model="input.name"
							@input="$v.input.name.$touch()"
							class="form-control" id="name-member" 
							:class="{'form-control-danger': $v.input.name.$error}"
							placeholder="Name">

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
					</div>

					<div class="col-md-6">
						<div class="form-group text-center mb-3">
							<input type="radio" name="gender"  
								   value=1 v-model="input.gender"> Male
							<input type="radio" name="gender"  
							       value=0 v-model="input.gender" class="ml-2"> Female
						</div>
					</div>
				</div>

				<div class="col-md-12 d-flex">
					<div class="col-md-6">
						<div class="form-group text-center mb-3">
							<input type="text" 
							v-model="input.place_of_birth"
							@input="$v.input.place_of_birth.$touch()"
							class="form-control" id="place_of_birth"
							:class="{'form-control-danger': $v.input.place_of_birth.$error}"
							placeholder="place of birth">

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
					</div>


					<div class="col-md-6">
						<div class="form-group text-center mb-3">
							<datetime type="date" id="date_of_birth" 
							v-model="input.date_of_birth" 
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
				</div>

				<div class="col-md-12 d-flex">
					<div class="col-md-6">
						<div class="form-group text-center mb-3">
							<input type="text" 
							v-model="input.email"
							@input="$v.input.email.$touch()"
							:class="{'form-control-danger': $v.input.email.$error}"
							class="form-control" id="email" 
							placeholder="Email">

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
					</div>

					<div class="col-md-6">
						<div class="form-group text-center mb-3">
							<input type="text" 
							v-model="input.fax" 
							class="form-control" id="fax"
							placeholder="Fax">
						</div>
					</div>
				</div>

				<div class="col-md-12 d-flex">
					<div class="col-md-6">
						<div class="form-group text-center mb-3">
							<input type="text" 
							v-model="input.telephone"
							@input="$v.input.telephone.$touch()"
							:class="{'form-control-danger': $v.input.telephone.$error}"
							class="form-control" id="telephone" 
							placeholder="Telephone">

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
					</div>

					<div class="col-md-6">
						<div class="form-group text-center mb-3">
							<input type="text" 
							v-model="input.mobile" 
							class="form-control" id="mobile"
							placeholder="Mobile">
						</div>
					</div>
				</div>

				<div class="col-md-12 d-flex">
					<div class="col-md-6">
						<div class="form-group">
							<select class="form-control" id="category" 
							@input="$v.input.class_id.$touch()"
							:class="{'form-control-danger': $v.input.class_id.$error}"
							v-model="input.class_id">
								<option value="" disabled="">Choose Class</option>
								<option v-for="item in classList" 
										:value=item.id>{{ item.title }}
								</option>
							</select>

							<!--======================================================================================
                            	V A L I D A T I O N     E R R O R   M E S S A G E S
                            	======================================================================================-->
                    		<transition enterActiveClass="fade-in" leaveActiveClass="fade-out" mode="out-in">
                            	<span key="class_id-required" class="text-danger" 
                            	v-if="!$v.input.class_id.required && $v.input.class_id.$dirty">
                            		Class is required
                        		</span>
                    		</transition>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group text-center mb-3">
							<datetime type="date" id="join_birth" 
									  v-model="input.join_date"
									  placeholder="Join Date">
							</datetime>
						</div>
					</div>
				</div>
			</div>

			<div class="card text-center">
				<div class="col-md-12"><h4 class="title mb-5">Ranks</h4></div>

				<div class="col-md-12 d-flex">
					<template v-for="(rank, index) in ranks" v-if="index == limit">
						<div class="col-md-4">
							<p> {{rank.title}} </p>
						</div>
						<div class="col-md-4">
							<datetime type="date" v-model="temp_annointed_date"></datetime>
						</div>
						<div class="col-md-2">
							<button class="btn btn-success btn-sm" @click="add_rank(index)">Add</button>
						</div>
					</template>
				</div>
				<transition-group name="slide">
					<div class="col-md-12 d-flex" v-for="(rank, index) in rankData" :key="index">
						<div class="col-md-5">
							<p> {{rank.title}}  </p>
						</div>
						<div class="col-md-5">
							<datetime type="date" v-model="rankData[index].annointed_date"></datetime>
						</div>
						<div class="col-md-2" v-if="index == (limit - 1)">
							<button class="btn btn-danger btn-sm" @click="delete_rank(index)">Delete</button>
						</div>
					</div>
				</transition-group>
			</div>

			<div class="card text-center">
				<div class="col-md-12 d-flex">
					<div class="col-md-5">
						<p> Subscription </p>
					</div>
					<div class="col-md-5">
						<div class="form-group text-center mb-3">
							<input type="number" 
								   @input="$v.year.$touch()"
								   :class="{'form-control-danger': $v.year.$error}"
								   placeholder="input years" v-model="year">
						</div>
						<!--======================================================================================
                            V A L I D A T I O N     E R R O R   M E S S A G E S
                            ======================================================================================-->
                    		<transition enterActiveClass="fade-in" leaveActiveClass="fade-out" mode="out-in">
                            	<span key="year-minimum" class="text-danger" v-if="!$v.year.minLength">
                            		Year must has of {{ $v.year.$params.minLength.min }} characters
                            	</span>
                            	<span key="year-maximum" class="text-danger" v-if="!$v.year.maxLength">
                            		Year must has of {{ $v.year.$params.maxLength.max }} characters
                        		</span>
                    		</transition>
					</div>
					<div class="col-md-2">
						<button class="btn btn-success btn-sm" @click="add_subscription()">Add</button>
					</div>
				</div>
				<div class="col-md-12 d-flex">
					<div v-for="(list, index) in subscription">
						<p>{{ list.year }} 
							<span @click="delete_year(index)" 
								  class="badge badge-danger" style="cursor: pointer">X</span> 
						</p>
					</div>
				</div>
			</div>

			<div class="card text-center">
				<div class="col-md-12">
					<h4 class="title mb-5">Class Region</h4>
				</div>
				<div class="col-md-12 d-flex">
					<div class="col-md-6">
						<select class="form-control" id="calss-region" 
							    v-model="region">
				    	<option value='' disabled="">Choose Class Region</option>
					    <option v-for="region in regions" :value=region>{{ region.name }}</option>
				    </select>
					</div>

					<div class="col-md-6">
						<button type="button" @click="add_region" class="btn btn-success btn-sm">
							Add Region
						</button>
					</div>
				</div>

				<div class="col-md-12 d-flex">
					<div v-for="(list, index) in classRegion">
						<p>{{ list.name }}
							<span @click="delete_region(index)" 
								  class="badge badge-danger" 
								  style="cursor: pointer">X
							</span> 
						</p>
					</div>
				</div>
			</div>

			<div class="card text-center">
				<div class="col-md-12">
					<div class="col-md-12 d-flex justify-content-center">
						<button type="button" @click="closeAddMember" class="btn btn-sm btn-warning">
							Cancel
						</button>
						<button type="button" @click="addMember" 
								class="btn btn-sm btn-success ml-1" :disabled="isRequesting">
							<template v-if="isRequesting">Adding..</template>
							<template v-else>Add Member</template>
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
	import {required, minLength, maxLength} from 'vuelidate/lib/validators';
	import {mapGetters} from 'vuex';
	import 'vue-datetime/dist/vue-datetime.css';
	import {Datetime} from 'vue-datetime';
    Vue.use(Datetime)

	export default{
		data(){
			return{
				isRequesting: false,
				limit: 0,
				rankData:[],
				temp_annointed_date: '',
				subscription:[],
				year: '',
				classRegion:[],
				region: '',
				input:{
					name: '',
					gender: '',
					place_of_birth: '',
					date_of_birth: '',
					join_date: '',
					email: '',
					telephone: '',
					mobile: '',
					fax: '',
					class_id: '',
					gender: '1'
				}
			}
		},

		mounted() {
			this.$v.$reset();
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
                email:{
                	required,
                	minLength: minLength(3),
                	maxLength: maxLength(50)
                },
                telephone:{
                	required,
                },
                class_id:{
                	required
                }
            },
            tempName:{
            	required,
            },
            year:{
            	maxLength: maxLength(4),
            	minLength: minLength(4)
            }
        },

		components:{
			Datetime
		},

		computed:{
			...mapGetters({
				classList: 'getClass',
				ranks: 'getRanks',
				regions: 'getRegions'
			}),

			formAddFilled(){
				return this.input.name != ''
					&& this.input.name.length >= 3
					&& this.input.name.length <= 50
					&& this.input.gender != ''
					&& this.input.place_of_birth != ''
					&& this.input.email != ''
					&& this.input.email.length >= 3
					&& this.input.email.length <= 50
					&& this.input.telephone != ''
					&& this.input.class_id != '';
			}
		},

		methods:{
			add_region(){
				if(this.region != ''){
					this.classRegion.push(this.region);

					const regionIndex = _.findIndex(this.regions,['id', this.region.id]);

					this.regions.splice(regionIndex, 1);

					this.region = '';
				}
			},

			delete_region(index){

				this.regions.push(this.classRegion[index]);

				this.classRegion.splice(index, 1);
			},

			delete_year(index){
				this.subscription.splice(index, 1);
			},

			add_subscription(){
				if(this.year != ''){
					this.subscription.push(this.year);
					this.year = '';
				}
			},

			delete_rank(index){
				this.rankData.splice(index, 1);
				this.limit -= 1;
			},

			add_rank(index){
				if(this.temp_annointed_date != ''){
					this.rankData.push({
						title: this.ranks[index].title,
						rankId: this.ranks[index].id,
						annointed_date: this.temp_annointed_date
					});
					this.limit += 1;

					this.temp_annointed_date = '';
				}
			},

			addMember(){

				let self = this;
				
				if(self.formAddFilled && !self.isRequesting){

					self.isRequesting = true;

					const name = this.input.name;

					const dataMember = {
						personal: this.input,
						ranks: this.rankData,
						subscription: this.subscription,
						region: this.classRegion
					};

					this.$store.dispatch('store_new_member',dataMember)
                        .then(() => {
                            flash(name + ' is successfully added','success');

                            self.isRequesting = false;

                            self.setData();
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

			setData(){
				this.input.name = '';
				this.input.gender = '';
				this.input.place_of_birth = '';
				this.input.date_of_birth = '';
				this.input.join_date = '';
				this.input.email = '';
				this.input.telephone = '';
				this.input.mobile = '';
				this.input.fax = '';
				this.input.class_id = '';
			},

			dirtyAllInputs(){
                this.$v.input.name.$touch();
                this.$v.input.gender.$touch();
                this.$v.input.place_of_birth.$touch();
                this.$v.input.date_of_birth.$touch();
                this.$v.input.email.$touch();
                this.$v.input.telephone.$touch();
                this.$v.input.class_id.$touch();
			},

			closeAddMember(){
	           this.$emit('closeAddMember',false);
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