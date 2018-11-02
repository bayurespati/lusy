<template> 
	<div class="row pt-5">
		<div class="col-md-12">
			<div class="card text-center">
				<h4 class="title font-weight-bold mb-4">Tambah Subkategori</h4>
				<div class="form-group text-left mb-3">
				    <select class="form-control mb-2" 
				    		id="category" 
				    		v-model="input.category_id">
				    	<option>Pilih Kategori</option>
					    <option v-for="category in categories" :value=category.id>{{ category.title}}</option>
				    </select>

					<input type="text" v-model="input.title" class="form-control" placeholder="Nama Subkategori" id="title">
				</div>

				<button type="button" @click="addSubCategory" class="btn btn-sm btn-success">Tambah</button>
				<button type="button" @click="closeAddSubCatergory" class="btn btn-sm btn-warning">Cancel</button>
			</div>
		</div>	
	</div>
</template>
<script>
	import {mapGetters} from 'vuex';
	export default{
		data(){
			return{
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


		methods:{
			addSubCategory(){
				
				if(this.input.title.length > 3 
					&& this.input.category_id !== '' 
					&&  this.input.category_id !== 'Pilih Kategori')
				{

					this.$store.dispatch('store_new_subcategory', this.input)
                        .then(() => {

                            flash('Sub category gallery berhasil ditambahkan','success');

                            this.input.title = '';
                            this.input.category_id = 'Pilih Kategori';
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