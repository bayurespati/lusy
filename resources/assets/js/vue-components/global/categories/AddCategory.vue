<template> 
	<div class="row pt-5">
		<div class="col-md-12">
			<div class="card text-center">
				<h4 class="title mb-4">Add New <strong>Category</strong></h4>

				<div class="form-group text-center mb-3">
					<input type="text" 
					v-model="input.title" 
					class="form-control" id="title"
					@input="$v.input.title.$touch()"
					:class="{'form-control-danger': $v.input.title.$error}"
					placeholder="Category Name">

					<!--======================================================================================
						V A L I D A T I O N     E R R O R   M E S S A G E S
						======================================================================================-->
					<transition enterActiveClass="fade-in" leaveActiveClass="fade-out" mode="out-in">
						<span key="name-required" class="text-danger" 
						v-if="!$v.input.title.required && $v.input.title.$dirty">
							Category Name is required
						</span>
						<span key="title-minimum" class="text-danger" 
						v-else-if="!$v.input.title.minLength">
							Category Name has a minimum of {{ $v.input.title.$params.minLength.min }} characters
						</span>
						<span key="key-maximum" class="text-danger" 
						v-else-if="!$v.input.title.maxLength">
							Category Name has a maximum of {{ $v.input.title.$params.maxLength.max }} characters
						</span>
					</transition>
				</div>

				<button type="button" @click="closeAddCatergory" 
				class="btn btn-sm btn-danger">
					Cancel
				</button>

				<button type="button" @click="addCategory" 
				class="btn btn-sm btn-success ml-1" :disabled="input.isRequesting">
					<template v-if="input.isRequesting">Adding..</template>
					<template v-else>Add</template>
				</button>
			</div>	
		</div>
	</div>
</template>
<script>
    import {required, minLength, maxLength} from 'vuelidate/lib/validators';

	export default{
		data(){
			return{
				input:{
					isRequesting: false,
					title: '',
				}
			}
		},

		validations: {
			input: {
				title: {
					required,
					minLength: minLength(3),
					maxLength: maxLength(20),
				},
			}
		},

		methods:{
			addCategory(){

				let self = this;
				
				if(this.input.title.length > 3 
					&& this.input.title.length < 20 
					&& !self.input.isRequesting){

					self.input.isRequesting = true;

					this.$store.dispatch('store_new_category', this.input)
                        .then(() => {

                            flash('Category is successfully added','success');

                            self.input.isRequesting = false;

                            self.input.title = '';

                            self.$v.$reset();
                        })
                        .catch(errors => {

                        	self.input.isRequesting = false;

                            Object.keys(errors).forEach(field=> {
                                errors[field].forEach(message=> {
                                    flash(message, 'danger', 5000);
                                })
                            })

                        });
				}
				else{
                	this.$v.input.title.$touch();
				}
			},

			closeAddCatergory(){
	           this.$emit('closeAddCategory',false);
	        }
		},
	};
</script>

<style scoped type="text/css">
	.card {
		display: inline-block;
		width: 100%;
		padding: 36px 20px 26px 20px;
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
</style>