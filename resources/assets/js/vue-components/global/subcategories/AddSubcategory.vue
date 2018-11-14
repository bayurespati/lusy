<template> 
	<div class="row pt-5">
		<div class="col-md-12">
			<div class="card text-center">
				<h4 class="title mb-4">Add New <strong>Subcategory</strong></h4>
				<div class="form-group text-center mb-3">
				    <select class="form-control" 
				    id="category" 
				    v-model="input.category_id"
				    @input="$v.input.category_id.$touch()"
					:class="{'form-control-danger': $v.input.category_id.$error}">
				    	<option value=''>Choose Category</option>
					    <option v-for="category in categories" :value=category.id>{{ category.title }}</option>
				    </select>

				    <!--======================================================================================
				    	V A L I D A T I O N     E R R O R   M E S S A G E S
				    	======================================================================================-->
				    <transition enterActiveClass="fade-in" leaveActiveClass="fade-out" mode="out-in">
				    	<span class="text-danger" style="display: inline-block" 
				    	v-if="!$v.input.category_id.required && $v.input.category_id.$dirty">
				    		Category is required
                        </span>
                    </transition>

					<input type="text" 
					v-model="input.title" class="form-control mt-2" 
					@input="$v.input.title.$touch()"
					:class="{'form-control-danger': $v.input.title.$error}"
					placeholder="Subcategory Name" 
					id="title">

					<!--======================================================================================
						V A L I D A T I O N     E R R O R   M E S S A G E S
						======================================================================================-->
					<transition enterActiveClass="fade-in" leaveActiveClass="fade-out" mode="out-in">
						<span key="title-required" class="text-danger" 
						v-if="!$v.input.title.required && $v.input.title.$dirty">
							Subcategory Name is required
						</span>
						<span key="title-minimum" class="text-danger" 
						v-else-if="!$v.input.title.minLength">
							Subcategory Name has a minimum of {{ $v.input.title.$params.minLength.min }} characters
						</span>
						<span  key="title-maximum" class="text-danger" 
						v-else-if="!$v.input.title.maxLength">
							Subcategory Name has a maximum of {{ $v.input.title.$params.maxLength.max }} characters
						</span>
					</transition>
				</div>

				<button type="button" @click="closeAddSubCatergory" class="btn btn-sm btn-danger">Cancel</button>
				<button type="button" @click="addSubCategory" class="btn btn-sm btn-success" :disabled="isRequesting">
					<template v-if="isRequesting">Adding..</template>
					<template v-else>Add</template>
				</button>
			</div>
		</div>	
	</div>
</template>
<script>
	import {required, minLength, maxLength} from 'vuelidate/lib/validators';
	import {mapGetters} from 'vuex';

	export default{
		data(){
			return{
				isRequesting: false,
				input:{
					title: '',
					category_id:'',
				}
			}
		},

		validations: {
			input: {
				category_id: {
					required
				},
				title: {
					required,
					minLength: minLength(3),
					maxLength: maxLength(20),
				}
			}
		},

	    computed:{
	    	...mapGetters({
	            categories: 'getCategories',
	        }),

	    	isFormFilled(){
	    		return this.input.title.length > 3 
	    		&& this.input.title.length < 20
	    		&& this.input.category_id !== '' 
	    		&& this.input.category_id !== '';
	    	}
	    },

		methods:{
			addSubCategory(){

				const self = this;
				
				if(self.isFormFilled && !self.isRequesting){

					self.isRequesting = true;

					self.$store.dispatch('store_new_subcategory', this.input)
                        .then(() => {

                            flash('Sub category added','success');

                            self.isRequesting = false;

                            self.input.category_id = '';
                            self.input.title = '';

                            self.$v.$reset();
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
					this.$v.input.category_id.$touch();
                	this.$v.input.title.$touch();
				}
			},

			closeAddSubCatergory(){
	           this.$emit('closeAddSubCategory',false);
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

	select {
  		text-align: center;
  		text-align-last: center;
  		/* webkit*/
	}

	option {
  		text-align: left;
	}
</style>