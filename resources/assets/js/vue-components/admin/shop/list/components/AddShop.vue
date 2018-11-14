<template> 
	<div class="row">
		<div class="col-md-12">
			<div class="card text-center">
				<div class="col-md-12">
					<h4 class="title font-weight-bold mb-5">Add Item</h4>
				</div>

				<div class="col-md-12 d-flex">
					<div class="col-md-6">
						<div class="form-group text-left mb-3">
							<input type="text" 
							v-model="input.title" 
							@input="$v.input.title.$touch()"
							class="form-control"
							placeholder="Item name">

						<!--======================================================================================
                            V A L I D A T I O N     E R R O R   M E S S A G E S
                            ======================================================================================-->
                    	<transition appear enterActiveClass="fade-in-down" leaveActiveClass="fade-out-up">
                            <span class="text-danger" v-if="!$v.input.title.required && $v.input.title.$dirty">
                            	* Item name must be filled
                        	</span>
                            <span class="text-danger" v-if="!$v.input.title.minLength">
                            	* Minimum {{ $v.input.title.$params.minLength.min }} character
                            </span>
                            <span class="text-danger" v-if="!$v.input.title.maxLength">
                            	* Maximum {{ $v.input.title.$params.maxLength.max }} character
                        	</span>
                    	</transition>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group text-left mb-3">
							<input type="text" 
							v-model="input.sub_title"
							@input="$v.input.sub_title.$touch()"
							class="form-control"
							placeholder="Item sub name">

						<!--======================================================================================
                            V A L I D A T I O N     E R R O R   M E S S A G E S
                            ======================================================================================-->
                    	<transition appear enterActiveClass="fade-in-down" leaveActiveClass="fade-out-up">
                            <span class="text-danger" v-if="!$v.input.sub_title.required && $v.input.sub_title.$dirty">
                            	* Sub name item must be filled
                        	</span>
                            <span class="text-danger" v-if="!$v.input.sub_title.minLength">
                            	* Minimum {{ $v.input.sub_title.$params.minLength.min }} character
                            </span>
                            <span class="text-danger" v-if="!$v.input.sub_title.maxLength">
                            	* Maximum {{ $v.input.sub_title.$params.maxLength.max }} character
                        	</span>
                    	</transition>
						</div>
					</div>
				</div>

				<div class="col-md-12 d-flex">
					<div class="col-md-6">
						<div class="form-group text-left mb-3">
							<input type="number" 
							v-model="input.price" 
							@input="$v.input.price.$touch()"
							class="form-control"
							placeholder="Price">

						<!--======================================================================================
                            V A L I D A T I O N     E R R O R   M E S S A G E S
                            ======================================================================================-->
                    	<transition appear enterActiveClass="fade-in-down" leaveActiveClass="fade-out-up">
                            <span class="text-danger" v-if="!$v.input.price.required && $v.input.price.$dirty">
                            	* Price  must be filled
                        	</span>
                    	</transition>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group text-left mb-3">
							<input type="number" 
							v-model="input.stock"
							@input="$v.input.stock.$touch()"
					       	class="form-control"
					       	placeholder="Stock">

					     <!--======================================================================================
                            V A L I D A T I O N     E R R O R   M E S S A G E S
                            ======================================================================================-->
                    	<transition appear enterActiveClass="fade-in-down" leaveActiveClass="fade-out-up">
                            <span class="text-danger" v-if="!$v.input.stock.required && $v.input.stock.$dirty">
                            	* Stock must be filled
                        	</span>
                    	</transition>
						</div>
					</div>
				</div>

				<div class="col-md-12 d-flex">
					<div class="col-md-6">
						<div class="form-group">
							<select class="form-control" id="category"
									@input="$v.category.$touch()"
									v-model="category">
								<option value="" disabled>Choose category</option>
								<option v-for="category in categories" :value=category>{{ category.title }}</option>
							</select>

						<!--======================================================================================
                            V A L I D A T I O N     E R R O R   M E S S A G E S
                            ======================================================================================-->
                    	<transition appear enterActiveClass="fade-in-down" leaveActiveClass="fade-out-up">
                            <span class="text-danger" v-if="!$v.category.required && $v.category.$dirty">
                            	* Category must be filled
                        	</span>
                    	</transition>
						</div>
					</div>

					<transition enterActiveClass="fade-in-down"leaveActiveClass="fade-out-up"mode="out-in">
						<div class="col-md-6" v-if="isMoreOne">
							<div class="form-group">
								<select class="form-control" id="subcategory" v-model="input.sub_category_id">
									<option value="" disabled>Choose Subcategory</option>
									<option v-for="subcategory in subcategories" :value=subcategory.id>
										{{ subcategory.title }}
									</option>
								</select>
							</div>
						</div>
					</transition>
				</div>

				<div class="col-md-12 d-flex">
					<div class="col-md-12">
						<div class="form-group text-left mb-3">
							<textarea rows="4"
							v-model="input.description"
							@input="$v.input.description.$touch()"
							class="form-control form-control-sm normal-placeholder" 
							placeholder="Description Item">
							</textarea>

						<!--======================================================================================
                            V A L I D A T I O N     E R R O R   M E S S A G E S
                            ======================================================================================-->
                    	<transition appear enterActiveClass="fade-in-down" leaveActiveClass="fade-out-up">
                            <span class="text-danger" v-if="!$v.input.description.required && $v.input.description.$dirty">
                            	* Description item must be filled
                        	</span>
                            <span class="text-danger" v-if="!$v.input.description.minLength">
                            	* Minimum {{ $v.input.description.$params.minLength.min }} character
                            </span>
                            <span class="text-danger" v-if="!$v.input.description.maxLength">
                            	* Maximum {{ $v.input.description.$params.maxLength.max }} character
                        	</span>
                    	</transition>

						</div>
					</div>
				</div>

				<div class="col-md-12 d-flex">
					<div class="col-md-12">
						<div class="form-group text-left mb-3">
							<input type="text" 
							v-model="input.store_link"
							@input="$v.input.store_link.$touch()"
							class="form-control" id="organiser"
							placeholder="Link online shop">

						<!--======================================================================================
                            V A L I D A T I O N     E R R O R   M E S S A G E S
                            ======================================================================================-->
                    	<transition appear enterActiveClass="fade-in-down" leaveActiveClass="fade-out-up">
                            <span class="text-danger" v-if="!$v.input.store_link.minLength">
                            	* Minimum {{ $v.input.store_link.$params.minLength.min }} character
                            </span>
                            <span class="text-danger" v-if="!$v.input.store_link.maxLength">
                            	* Maximum {{ $v.input.store_link.$params.maxLength.max }} character
                        	</span>
                    	</transition>

						</div>
					</div>
				</div>

				<div class="col-md-12 d-flex">
					<div class="col-md-12">
						<div class="form-group text-center mb-3">
							<input type="radio" name="add_is_displayed"  
								   value=1 v-model="input.is_displayed"> Show
							<input type="radio" name="add_is_displayed"  
							       value=0 v-model="input.is_displayed" class="ml-2"> Hide
						</div>
					</div>
				</div>

				<div class="col-md-12 d-flex justify-content-center">
					<button type="button" @click="addShop"class="btn btn-sm btn-success">
						Save
					</button>
					<button type="button" @click="closeAddShop" class="btn btn-sm btn-warning ml-1">
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

	export default{
		data(){
			return{
				isRequesting: false,
				isMoreOne: true,
				category: '',
				subcategories: '',
				is_sub_allow: true,
				input:{
					title: '',
					sub_title: '',
					stock: '',
					description: '',
					price: '',
					store_link: '',
					sub_category_id: '',
					category_id: '',
					is_displayed: 1
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
                sub_title:{
                	required,
                    minLength: minLength(3),
                    maxLength: maxLength(20)
                },
                store_link: {
                	minLength: minLength(5),
                	maxLength: maxLength(20),
                },
                description: {
                	required,
                	minLength: minLength(3),
                	maxLength: maxLength(100)
                },
                stock: {
                    required,
                },
                price:{
                	required,
                },
			},
			category:{
                	required
            }
        },

		computed:{
			...mapGetters({
				categories: 'getCategories',
			}),

			isFormFilled(){
				return this.input.title != ''
					&& this.input.title.length >= 3
					&& this.input.title.length <= 20
					&& this.input.sub_title != ''
					&& this.input.sub_title.length >= 3
					&& this.input.sub_title.length <= 20
					&& this.input.description != ''
					&& this.input.description.length >= 3
					&& this.input.description.length <= 100
					&& this.input.stock != ''
					&& this.input.price != ''
					&& this.input.is_displayed != ''
					&& (this.input.store_link == '' || (this.input.store_link.length >= 5 && this.input.store_link.length <= 20) )
			},
		},

		methods:{
			addShop(){

				let self = this;

				if(this.category.subcategories.length >= 1){
					this.is_sub_allow = this.input.sub_category_id != '' ? true : false;
				}else{
					this.is_sub_allow = this.input.sub_category_id == '' ? true : false;
				}

				if(this.isFormFilled && this.is_sub_allow && !self.isRequesting){

					self.isRequesting = true;

					this.$store.dispatch('store_new_shop', this.input)
                        .then(() => {
                            flash('Shop item added','success');
                            this.input.title = '';

                            self.setData();

                            self.isRequesting = false;

                            self.closeAddShop();
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
				this.subcategories = '';
				this.input.organiser = '';

			},

			closeAddShop(){
	           this.$emit('closeAddShop',false);
	        }
		},

		watch:{
            subcategories(){
                this.input.sub_category_id = "";
            },

            category(){
            	this.subcategories = this.category.subcategories;
            	this.input.category_id = this.category.id
            	this.isMoreOne = this.subcategories.length > 0 ? true : false;
            }
        },
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
</style>

<style scoped type="text/css">
	.card {
		display: inline-block;
		width: 100%;
		padding: 36px 20px 26px 20px;
	}
</style>