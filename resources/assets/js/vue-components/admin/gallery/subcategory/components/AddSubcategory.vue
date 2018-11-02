<template> 
	<div class="row">
		<div class="card">
			<form>
				<div class="form-group">
				    <label for="category">Category</label>
				    <select class="form-control" 
				    		id="category" 
				    		v-model="input.category_id">
				    	<option>Plilih Category</option>
					    <option v-for="category in categories" :value=category.id>{{ category.title}}</option>
				    </select>
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Nama</label>
					<input type="text" v-model="input.title" class="form-control" id="titile">
				</div>
			  <button type="button" @click="addSubCategory" class="btn btn-success">TAMBAH</button>
			  <button type="button" @click="closeAddSubCatergory" class="btn btn-warning">CANCEL</button>
			</form>	
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
					category_id:'Plilih Category',
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
					&&  this.input.category_id !== 'Plilih Category')
				{

					this.$store.dispatch('store_new_subcategory', this.input)
                        .then(() => {

                            flash('Sub category gallery berhasil ditambahkan','success');

                            this.input.title = '';
                            this.input.category_id = 'Plilih Category';
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