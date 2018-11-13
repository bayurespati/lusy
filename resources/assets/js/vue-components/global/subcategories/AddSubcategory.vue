<template> 
	<div class="row pt-5">
		<div class="col-md-12">
			<div class="card text-center">
				<h4 class="title font-weight-bold mb-4">Add Subcategory</h4>
				<div class="form-group text-left mb-3">
				    <select class="form-control mb-2" 
				    		id="category" 
				    		v-model="input.category_id">
				    	<option>Choose Category</option>
					    <option v-for="category in categories" :value=category.id>{{ category.title }}</option>
				    </select>

					<input type="text" 
						   v-model="input.title" class="form-control" 
						   placeholder="Subcategory Name" 
						   id="title">
				</div>

				<button type="button" @click="addSubCategory" class="btn btn-sm btn-success">Add</button>
				<button type="button" @click="closeAddSubCatergory" class="btn btn-sm btn-danger">Cancel</button>
			</div>
		</div>	
	</div>
</template>
<script>
	import {mapGetters} from 'vuex';
	export default{
		data(){
			return{
				isRequesting: false,
				input:{
					title: '',
					category_id:'Pilih Kategori',
				}
			}
		},

		computed:{
	        ...mapGetters({
	            categories: 'getCategories',
	        })
	    },

	    computed:{
	    	isFormFilled(){
	    		return this.input.title.length > 3 
					&& this.input.category_id !== '' 
					&& this.input.category_id !== 'Pilih Kategori';
	    	}
	    },

		methods:{
			addSubCategory(){

				let self = this;
				
				if(self.isFormFilled && !self.isRequesting){

					self.isRequesting = true;

					this.$store.dispatch('store_new_subcategory', this.input)
                        .then(() => {

                            flash('Sub category added','success');

                            self.isRequesting = false;

                            this.input.title = '';

                            this.input.category_id = 'Pilih Kategori';
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
</style>