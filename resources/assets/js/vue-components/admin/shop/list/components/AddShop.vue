<template> 
	<div class="row">
		<div class="col-md-12">
			<div class="card text-center">
				<div class="col-md-12">
					<h4 class="title font-weight-bold mb-5">Tambah Item</h4>
				</div>

				<div class="col-md-12 d-flex">
					<div class="col-md-6">
						<div class="form-group text-left mb-3">
							<input type="text" 
							v-model="input.title" 
							class="form-control" id="name" 
							placeholder="Nama Item">
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group text-left mb-3">
							<input type="text" 
							v-model="input.sub_title" 
							class="form-control" id="sub_name" 
							placeholder="Sub Nama item">
						</div>
					</div>
				</div>

				<div class="col-md-12 d-flex">
					<div class="col-md-6">
						<div class="form-group text-left mb-3">
							<input type="number" 
							v-model="input.price" 
							class="form-control" id="price"
							placeholder="Harga">
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group text-left mb-3">
							<input type="number" 
							v-model="input.stock" 
					       	class="form-control" id="location" 
					       	placeholder="Stok">
						</div>
					</div>
				</div>

				<div class="col-md-12 d-flex">
					<div class="col-md-6">
						<div class="form-group">
							<select class="form-control" id="category" v-model="category">
								<option value="" disabled>Pilih Kategori</option>
								<option v-for="category in categories" :value=category>{{ category.title }}</option>
							</select>
						</div>
					</div>

					<transition enterActiveClass="fade-in-down"
					leaveActiveClass="fade-out-up"
					mode="out-in">
						<div class="col-md-6">
							<div class="form-group" v-if="isMoreOne">
								<select class="form-control" id="subcategory" v-model="input.sub_category_id">
									<option value="" disabled>Pilih Subkategori </option>
									<option v-for="subcategory in subcategories" :value=subcategory.id>{{ subcategory.title }}</option>
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
							placeholder="Deskripsi Item">
							</textarea>
						</div>
					</div>
				</div>

				<div class="col-md-12 d-flex">
					<div class="col-md-12">
						<div class="form-group text-left mb-3">
							<input type="text" 
							v-model="input.store_link" 
							class="form-control" id="organiser"
							placeholder="Link Toko Online">
						</div>
					</div>
				</div>

				<div class="col-md-12 d-flex">
					<div class="col-md-12">
						<div class="form-group text-center mb-3">
							<input type="radio" name="add_is_displayed"  value=1 v-model="input.is_displayed"> Tampilkan
							<input type="radio" name="add_is_displayed"  value=0 v-model="input.is_displayed" class="ml-2"> Sembunyikan
						</div>
					</div>
				</div>

				<div class="col-md-12 d-flex justify-content-center">
					<button type="button" 
					@click="addShop"
					class="btn btn-sm btn-success">
						Tambah
					</button>
					<button type="button" 
					@click="closeAddShop" 
					class="btn btn-sm btn-warning ml-1">
						Cancel
					</button>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
	import {mapGetters} from 'vuex';	

	export default{
		data(){
			return{
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

		components:{
			
		},

		computed:{
			...mapGetters({
				categories: 'getCategories',
			}),

			isFormFilled(){
				return this.input.title.length > 4 
					&& this.input.sub_title.length > 4 
					&& this.input.stock != ''
					&& this.input.description.length > 4
					&& this.input.price != ''
					&& this.input.store_link.length > 4
					&& this.input.category_id != ''
					&& this.input.is_displayed != '';
			},
		},

		methods:{
			addShop(){

				let vm = this;

				if(this.category.subcategories.length >= 1){
					this.is_sub_allow = this.input.sub_category_id != '' ? true : false;
				}else{
					this.is_sub_allow = this.input.sub_category_id == '' ? true : false;
				}

				if(this.isFormFilled && this.is_sub_allow){

					this.$store.dispatch('store_new_shop', this.input)
                        .then(() => {
                            flash('Shop item berhasil ditambahkan','success');
                            this.input.title = '';

                            vm.setData();

                            vm.closeAddShop();
                        })
                        .catch(errors => {
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