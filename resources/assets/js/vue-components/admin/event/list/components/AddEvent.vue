<template> 
	<div class="row">
		<div class="col-md-12">
			<div class="card text-center">
				<div class="col-md-12">
					<h4 class="title mb-5">Add New <strong>Event</strong></h4>
				</div>

				<div class="col-md-12 d-flex">
					<div class="col-md-6">
						<div class="form-group text-center mb-3">
							<input type="text" 
							v-model="input.title"
							@input="$v.input.title.$touch()"
							class="form-control" id="title-event" 
							:class="{'form-control-danger': $v.input.title.$error}"
							placeholder="Title">

							<!--======================================================================================
                            	V A L I D A T I O N     E R R O R   M E S S A G E S
                            	======================================================================================-->
                    		<transition enterActiveClass="fade-in" leaveActiveClass="fade-out" mode="out-in">
                            	<span key="title-required" class="text-danger" 
                            	v-if="!$v.input.title.required && $v.input.title.$dirty">
                            		Title is required
                        		</span>
                            	<span key="title-minimum" class="text-danger" 
                            	v-else-if="!$v.input.title.minLength">
                            		Title has a minimum of {{ $v.input.title.$params.minLength.min }} characters
                            	</span>
                            	<span key="key-maximum" class="text-danger" 
                            	v-else-if="!$v.input.title.maxLength">
                            		Title has a maximum of {{ $v.input.title.$params.maxLength.max }} characters
                        		</span>
                    		</transition>	
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group text-center mb-3">
							<input type="text" 
							v-model="input.organiser"
							class="form-control" id="organiser"
							placeholder="Organiser">
						</div>
					</div>
				</div>

				<div class="col-md-12 d-flex">
					<div class="col-md-6">
						<div class="form-group text-center mb-3">
							<datetime type="date" value-zone="local" 
							id="start_date" v-model="input.start_date" 
							@input="$v.input.start_date.$touch()"
							:class="{'form-control-danger': $v.input.start_date.$error}"
							placeholder="Start Date">
							</datetime>

							<!--======================================================================================
                            	V A L I D A T I O N     E R R O R   M E S S A G E S
                            	======================================================================================-->
                    		<transition enterActiveClass="fade-in" leaveActiveClass="fade-out" mode="out-in">
                            	<span key="start-required" class="text-danger" 
                            	v-if="!$v.input.start_date.required && $v.input.start_date.$dirty">
                            		Start Date is required
                        		</span>
                    		</transition>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group text-center mb-3">
							<datetime type="date" id="end_date" 
							value-zone="local"
							v-model="input.end_date"
							@input="$v.input.end_date.$touch()"
							placeholder="End Date">
							</datetime>
						</div>
					</div>
				</div>

				<div class="col-md-12 d-flex">
					<div class="col-md-6">
						<div class="form-group text-center mb-3">
							<input type="text" 
							v-model="input.location"
							@input="$v.input.location.$touch()"
							:class="{'form-control-danger': $v.input.location.$error}"
							class="form-control" id="location" 
							placeholder="Location">

							<!--======================================================================================
                            	V A L I D A T I O N     E R R O R   M E S S A G E S
                            	======================================================================================-->
                    		<transition enterActiveClass="fade-in" leaveActiveClass="fade-out" mode="out-in">
                            	<span key="location-required" class="text-danger" 
                            	v-if="!$v.input.location.required && $v.input.location.$dirty">
                            		Location is required
                        		</span>
                            	<span key="location-minimum" class="text-danger" 
                            	v-else-if="!$v.input.location.minLength">
                            		Location has a minimum of {{ $v.input.location.$params.minLength.min }} characters
                            	</span>
                            	<span key="location-maximum" class="text-danger" 
                            	v-else-if="!$v.input.location.maxLength">
                            		Location has a maximum of {{ $v.input.location.$params.maxLength.max }} characters
                        		</span>
                    		</transition>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group text-center mb-3">
							<input type="text" 
							v-model="input.address" 
							@input="$v.input.address.$touch()"
							:class="{'form-control-danger': $v.input.address.$error}"
							class="form-control" id="address"
							placeholder="Address">

							<!--======================================================================================
                            	V A L I D A T I O N     E R R O R   M E S S A G E S
                            	======================================================================================-->
                    		<transition enterActiveClass="fade-in" leaveActiveClass="fade-out" mode="out-in">
                            	<span key="address-required" class="text-danger" 
                            	v-if="!$v.input.address.required && $v.input.address.$dirty">
                            		Address is required
                        		</span>
                            	<span key="address-minimum" class="text-danger" 
                            	v-else-if="!$v.input.address.minLength">
                            		Address has a minimum of {{ $v.input.address.$params.minLength.min }} characters
                            	</span>
                            	<span key="address-maximum" class="text-danger" 
                            	v-else-if="!$v.input.address.maxLength">
                            		Address has a maximum of {{ $v.input.address.$params.maxLength.max }} characters
                        		</span>
                    		</transition>	
						</div>
					</div>
				</div>

				<div class="col-md-12 d-flex">
					<div class="col-sm-12">
						<div class="form-group">
							<select class="form-control" id="category" 
							@input="$v.input.category_id.$touch()"
							:class="{'form-control-danger': $v.input.category_id.$error}"
							v-model="input.category_id">
								<option value="">Choose Category</option>
								<option v-for="category in categories" 
										:value=category.id>{{ category.title }}
								</option>
							</select>

							<!--======================================================================================
                            	V A L I D A T I O N     E R R O R   M E S S A G E S
                            	======================================================================================-->
                    		<transition enterActiveClass="fade-in" leaveActiveClass="fade-out" mode="out-in">
                            	<span class="text-danger" v-if="!$v.input.category_id.required && $v.input.category_id.$dirty">
                            		Category is required
                        		</span>
                    		</transition>
						</div>
					</div>
				</div>

				<div class="col-md-12 d-flex">
					<div class="col-md-12">
						<div class="form-group text-left mb-3">
							<textarea rows="4"
							v-model="input.content"
							class="form-control" 
							placeholder="Content">
							</textarea>
						</div>
					</div>
				</div>

				<div class="col-md-12 d-flex justify-content-center">
					<button type="button" @click="closeAddEvent" class="btn btn-sm btn-warning">
						Cancel
					</button>
					<button type="button" @click="addEvent" class="btn btn-sm btn-success ml-1" :disabled="isRequesting">
						<template v-if="isRequesting">Adding..</template>
						<template v-else>Add</template>
					</button>
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
				input:{
					title: '',
					organiser: '',
					start_date: '',
					end_date: '',
					location: '',
					address: '',
					content: '',
					category_id: '',
				}
			}
		},

		mounted() {
			this.$v.$reset();
		},

		validations: {
            input: {
                title: {
                    required,
                    minLength: minLength(3),
                    maxLength: maxLength(100)
                },
                start_date: {
                    required,
                },
                end_date: {
                	required,
                },
                location:{
                	required,
                	minLength: minLength(3),
                	maxLength: maxLength(50)
                },
                address: {
                	required,
                	minLength: minLength(3),
                	maxLength: maxLength(100),
                },
                category_id: {
                	required
                },
            }
        },

		components:{
			Datetime
		},

		computed:{
			...mapGetters({
				categories: 'getCategories',
			}),

			formAddFilled(){
				return this.input.title != ''
					&& this.input.title.length >= 3
					&& this.input.title.length <= 100
					&& this.input.location != ''
					&& this.input.location.length >= 3
					&& this.input.location.length <= 50
					&& this.input.address != ''
					&& this.input.address.length >= 3
					&& this.input.address.length <= 100
					&& this.input.start_date != ''
					&& this.input.end_date != ''
					&& this.input.category_id != '';
			},

			start_date(){
				return this.input.start_date;
			}
		},

		methods:{
			addEvent(){

				let self = this;
				
				if(self.formAddFilled && !self.isRequesting){

					self.isRequesting = true;

					const eventName = this.input.title;

					this.$store.dispatch('store_new_event', this.input)
                        .then(() => {
                            flash(eventName + ' is successfully added','success');
                            this.input.title = '';

                            self.isRequesting = false;

                            self.setData();

                            self.closeAddEvent();
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

				this.input.title = '';
				this.input.organiser = '';
				this.input.start_date = '';
				this.input.end_date = '';
				this.input.location = '';
				this.input.address = '';
				this.input.organiser = '';
				this.input.content = '';

			},

			dirtyAllInputs(){
                this.$v.input.title.$touch();
                this.$v.input.category_id.$touch();
                this.$v.input.start_date.$touch();
                this.$v.input.location.$touch();
                this.$v.input.address.$touch();
			},

			closeAddEvent(){
	           this.$emit('closeAddEvent',false);
	        }
		},

		watch:{
            start_date(){
            	this.input.end_date = this.input.start_date;
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
</style>