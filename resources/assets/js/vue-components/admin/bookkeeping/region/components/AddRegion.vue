<template> 
	<div class="row">
		<div class="col-md-12">
			<div class="card text-center">
				<div class="col-md-12">
					<h4 class="title mb-5">Add New Class <strong>Region</strong></h4>
				</div>

				<div class="col-md-12 d-flex">
					<div class="col-md-6">
						<div class="form-group text-center mb-3">
							<input type="text" 
							v-model="input.name"
							@input="$v.input.name.$touch()"
							class="form-control" id="name-region" 
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
                            	<span key="name-minimum" class="text-danger" 
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
							<input type="text" 
							v-model="input.city"
							class="form-control"
							placeholder="City">
						</div>
					</div>
				</div>

				<div class="col-md-12 d-flex">
					<div class="col-md-12">
						<div class="form-group text-left mb-3">
							<input type="text" 
							v-model="input.address"
							class="form-control"
							placeholder="Address">
						</div>
					</div>
				</div>

				<div class="col-md-12 d-flex justify-content-center">
					<button type="button" @click="closeAddRegion" class="btn btn-sm btn-warning">
						Close
					</button>
					<button type="button" @click="addRegion" 
							class="btn btn-sm btn-success ml-1" 
							:disabled="isRequesting">
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
	export default{
		data(){
			return{
				isRequesting: false,
				subcategories: '',
				input:{
					name: '',
					city: '',
					address: ''				
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
            }
        },

		computed:{
			formAddFilled(){
				return this.input.name != ''
					&& this.input.name.length >= 3
					&& this.input.name.length <= 50
			}
		},

		methods:{
			addRegion(){

				let self = this;
				
				if(self.formAddFilled && !self.isRequesting){

					self.isRequesting = true;

					const regionName = this.input.name;

					this.$store.dispatch('store_new_region', this.input)
                        .then(() => {
                            flash(regionName + ' is successfully added','success');
                            this.input.title = '';

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
				this.input.title = '';
				this.input.city = '';
				this.input.address = '';
			},

			dirtyAllInputs(){
                this.$v.input.name.$touch();                
			},

			closeAddRegion(){
	           this.$emit('closeAddRegion',false);
	        }
		}
	};
</script>

<style type="text/css">
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