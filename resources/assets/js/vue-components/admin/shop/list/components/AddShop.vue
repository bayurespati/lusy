<template> 
	<div class="row">
		<div class="col-md-12">
			<div class="card text-center">
				<div class="col-md-12">
					<h4 class="title mb-5">Add New <strong>Shop Item</strong></h4>
				</div>

				<div class="col-md-12 d-flex">
					<div class="col-md-6">
						<div class="form-group text-center mb-3">
							<input type="text" 
							v-model="input.title" 
							:class="{'form-control-danger': $v.input.title.$error}"
							@input="$v.input.title.$touch()"
							class="form-control"
							placeholder="Item Name">

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
                            <span key="title-maximum" class="text-danger" 
                            v-else-if="!$v.input.title.maxLength">
                            	Title has a maximum of {{ $v.input.title.$params.maxLength.max }} characters
                        	</span>
                    	</transition>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group text-center mb-3">
							<input type="text" 
							v-model="input.sub_title"
							class="form-control"
							placeholder="Item Subname">
						</div>
					</div>
				</div>

				<div class="col-md-12 d-flex">
					<div class="col-md-6">
						<div class="form-group text-center mb-3">
							<input type="number" 
							v-model="input.price"
							:class="{'form-control-danger': $v.input.price.$error}"
							@input="$v.input.price.$touch()"
							class="form-control"
							placeholder="Price">

						<!--======================================================================================
                            V A L I D A T I O N     E R R O R   M E S S A G E S
                            ======================================================================================-->
                    	<transition enterActiveClass="fade-in" leaveActiveClass="fade-out" mode="out-in">
                            <span key="price-required" class="text-danger" v-if="!$v.input.price.required && $v.input.price.$dirty">
                            	Price is required
                        	</span>
                    	</transition>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group text-center mb-3">
							<input type="number" 
							v-model="input.stock"
							@input="$v.input.stock.$touch()"
					       	class="form-control"
					       	placeholder="Stock">
						</div>
					</div>
				</div>

				<div class="col-md-12 d-flex">
					<div class="col-md-6">
						<div class="form-group">
							<select class="form-control" id="category"
									@input="$v.category.$touch()"
									:class="{'form-control-danger': $v.category.$error}"
									v-model="category">
								<option value="" disabled>Choose Category</option>
								<option v-for="category in categories" :value=category>{{ category.title }}</option>
							</select>

						<!--======================================================================================
                            V A L I D A T I O N     E R R O R   M E S S A G E S
                            ======================================================================================-->
                    	<transition appear enterActiveClass="fade-in-down" leaveActiveClass="fade-out-up">
                            <span class="text-danger" v-if="!$v.category.required && $v.category.$dirty">
                            	Category is required
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
							class="form-control form-control-sm normal-placeholder" 
							placeholder="Description Item">
							</textarea>

						</div>
					</div>
				</div>

				<div class="col-md-12 d-flex">
					<div class="col-md-12">
						<div class="form-group text-left mb-3">
							<input type="text" 
							v-model="input.store_link"
							@input="$v.input.store_link.$touch()"
							:class="{'form-control-danger': $v.input.store_link.$error}"
							class="form-control" id="organiser"
							placeholder="Link Online Shop">

						<!--======================================================================================
                            V A L I D A T I O N     E R R O R   M E S S A G E S
                            ======================================================================================-->
                    	<transition appear enterActiveClass="fade-in-down" leaveActiveClass="fade-out-up">
                            <span class="text-danger" v-if="!$v.input.store_link.minLength">
                            	Link has a minimum of {{ $v.input.store_link.$params.minLength.min }} characters
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
					<button type="button" @click="closeAddShop" class="btn btn-sm btn-warning">
						Cancel
					</button>
					<button type="button" @click="addShop"class="btn btn-sm btn-success ml-1" :disabled="isRequesting">
						<template v-if="isRequesting">Saving..</template>
						<template v-else>Save</template>
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
                    maxLength: maxLength(100)
                },
                store_link: {
                	minLength: minLength(5),
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
					&& this.input.title.length <= 100
					&& this.input.price != ''
					&& this.input.is_displayed != ''
					&& (this.input.store_link == '' || (this.input.store_link.length >= 5 ))
			},

			is_subCat(){
                if(this.category !== '' && this.subcategories.length >= 1){
                    return this.input.sub_category_id != '';
                }else{
                    return this.input.sub_category_id == '';
                }
            }
		},

		methods:{
			addShop(){

				let self = this;

				if(this.isFormFilled && this.is_subCat && !self.isRequesting){

					self.isRequesting = true;

					this.$store.dispatch('store_new_shop', this.input)
                        .then(() => {
                            flash(self.input.title + ' is successfully added','success');

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
				}else{
					this.diryAllInputs();
				}
			},

			diryAllInputs(){
                this.$v.input.title.$touch();
                this.$v.input.price.$touch();
                this.$v.category.$touch();
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