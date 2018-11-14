<template> 
	<div class="row">
		<div class="col-md-12">
			<div class="card text-center">
				<div class="col-md-12">
					<h4 class="title font-weight-bold mb-5">Add Event</h4>
				</div>

				<div class="col-md-12 d-flex">
					<div class="col-md-6">
						<div class="form-group text-left mb-3">
							<input type="text" 
							v-model="input.title"
							@input="$v.input.title.$touch()"
							class="form-control" id="title-event" 
							placeholder="Title">

						<!--======================================================================================
                            V A L I D A T I O N     E R R O R   M E S S A G E S
                            ======================================================================================-->
                    	<transition appear enterActiveClass="fade-in-down" leaveActiveClass="fade-out-up">
                            <span class="text-danger" v-if="!$v.input.title.required && $v.input.title.$dirty">
                            	* Title must be filled
                        	</span>
                            <span class="text-danger" v-if="!$v.input.title.minLength">
                            	* Minimal {{ $v.input.title.$params.minLength.min }} character
                            </span>
                            <span class="text-danger" v-if="!$v.input.title.maxLength">
                            	* Maksimal {{ $v.input.title.$params.maxLength.max }} character
                        	</span>
                    	</transition>	
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group text-left mb-3">
							<input type="text" 
							v-model="input.organiser"
							@input="$v.input.organiser.$touch()"
							class="form-control" id="organiser"
							placeholder="Organiser">

						<!--======================================================================================
                            V A L I D A T I O N     E R R O R   M E S S A G E S
                            ======================================================================================-->
                    	<transition enterActiveClass="fade-in" leaveActiveClass="fade-out" mode="out-in">
                            <span class="text-danger" v-if="!$v.input.organiser.required && $v.input.organiser.$dirty">
                            	* Organiser must be filled
                        	</span>
                            <span class="text-danger" v-if="!$v.input.organiser.minLength">
                            	* Minimal {{ $v.input.organiser.$params.minLength.min }} character
                            </span>
                            <span class="text-danger" v-if="!$v.input.organiser.maxLength">
                            	* Maksimal {{ $v.input.organiser.$params.maxLength.max }} character
                        	</span>
                    	</transition>
						</div>
					</div>
				</div>

				<div class="col-md-12 d-flex">
					<div class="col-md-6">
						<div class="form-group text-left mb-3">
							<datetime type="datetime" value-zone="local" 
									  id="start_date" v-model="input.start_date" 
									  placeholder="Start Date"></datetime>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group text-left mb-3">
							<datetime type="datetime" id="end_date" 
									  v-model="input.end_date" 
									  placeholder="End Date"></datetime>
						</div>
					</div>
				</div>

				<div class="col-md-12 d-flex">
					<div class="col-md-6">
						<div class="form-group text-left mb-3">
							<input type="text" 
							v-model="input.location"
							@input="$v.input.location.$touch()"
							class="form-control" id="location" 
							placeholder="Location">

						<!--======================================================================================
                            V A L I D A T I O N     E R R O R   M E S S A G E S
                            ======================================================================================-->
                    	<transition enterActiveClass="fade-in" leaveActiveClass="fade-out" mode="out-in">
                            <span class="text-danger" v-if="!$v.input.location.required && $v.input.location.$dirty">
                            	* Location must be filled
                        	</span>
                            <span class="text-danger" v-if="!$v.input.location.minLength">
                            	* Minimal {{ $v.input.location.$params.minLength.min }} character
                            </span>
                            <span class="text-danger" v-if="!$v.input.location.maxLength">
                            	* Maksimal {{ $v.input.location.$params.maxLength.max }} character
                        	</span>
                    	</transition>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group text-left mb-3">
							<input type="text" 
							v-model="input.address" 
							@input="$v.input.address.$touch()"
							class="form-control" id="address"
							placeholder="Address">

						<!--======================================================================================
                            V A L I D A T I O N     E R R O R   M E S S A G E S
                            ======================================================================================-->
                    	<transition enterActiveClass="fade-in" leaveActiveClass="fade-out" mode="out-in">
                            <span class="text-danger" v-if="!$v.input.address.required && $v.input.address.$dirty">
                            	* Address must be filled
                        	</span>
                            <span class="text-danger" v-if="!$v.input.address.minLength">
                            	* Minimal {{ $v.input.address.$params.minLength.min }} character
                            </span>
                            <span class="text-danger" v-if="!$v.input.address.maxLength">
                            	* Maksimal {{ $v.input.address.$params.maxLength.max }} character
                        	</span>
                    	</transition>	
						</div>
					</div>
				</div>

				<div class="col-md-12 d-flex">
					<div class="col-md-6">
						<div class="form-group">
							<select class="form-control" id="category"v-model="subcategories">
								<option value="">Choose Category</option>
								<option v-for="category in categories" 
										:value=category.subcategories>{{ category.title }}
								</option>
							</select>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<select class="form-control" id="subcategory"
									@input="$v.input.sub_category_id.$touch()"
									v-model="input.sub_category_id">
								<option value="">Choose Subcategory</option>
								<option v-for="subcategory in subcategories" 
										:value=subcategory.id>{{ subcategory.title }}
								</option>
							</select>

						<!--======================================================================================
                            V A L I D A T I O N     E R R O R   M E S S A G E S
                            ======================================================================================-->
                    	<transition enterActiveClass="fade-in" leaveActiveClass="fade-out" mode="out-in">
                            <span class="text-danger" 
                            	  v-if="!$v.input.sub_category_id.required && $v.input.sub_category_id.$dirty">
                            	* Sub category must be filled
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
					<button type="button" @click="addEvent" class="btn btn-sm btn-success">
						Add
					</button>
					<button type="button" @click="closeAddEvent" class="btn btn-sm btn-warning ml-1">
						Cancel
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
				subcategories: '',
				input:{
					title: '',
					organiser: '',
					start_date: '',
					end_date: '',
					location: '',
					address: '',
					content: '',
					sub_category_id: '',
				}
			}
		},

		validations: {
            input: {
                title: {
                    required,
                    minLength: minLength(3),
                    maxLength: maxLength(20)
                },
                organiser:{
                	required,
                    minLength: minLength(3),
                    maxLength: maxLength(20)
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
                	maxLength: maxLength(20)
                },
                address: {
                	required,
                	minLength: minLength(3),
                	maxLength: maxLength(50),
                },
                sub_category_id:{
                	required
                }
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
					&& this.input.title.length <= 20
					&& this.input.organiser != ''
					&& this.input.organiser.length >= 3 
					&& this.input.organiser.length <= 20
					&& this.input.location != ''
					&& this.input.location.length >= 3
					&& this.input.location.length <= 20
					&& this.input.address != ''
					&& this.input.address.length >= 3
					&& this.input.address.length <= 50
					&& this.input.start_date != ''
					&& this.input.end_date != ''
					&& this.input.sub_category_id != '';
			}
		},

		methods:{
			addEvent(){

				let self = this;
				
				if(self.formAddFilled && !self.isRequesting){

					self.isRequesting = true;

					this.$store.dispatch('store_new_event', this.input)
                        .then(() => {
                            flash('Event Added','success');
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
			},

			setData(){

				this.input.title = '';
				this.input.start_date = '';
				this.input.end_date = '';
				this.input.location = '';
				this.input.address = '';
				this.input.content = '';
				this.input.organiser = '';
				this.subcategories = "";
				this.input.organiser = '';

			},

			closeAddEvent(){
	           this.$emit('closeAddEvent',false);
	        }
		},

		watch:{
            subcategories(){
                this.input.sub_category_id = "";
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