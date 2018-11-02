<template> 
	<div class="row">
		<div class="card">
			<form>
			  <div class="form-group">
			    <label for="exampleInputEmail1">Title</label>
			    <input type="text" v-model="input.title" class="form-control" id="titile">
			  </div>
			  <button type="button" @click="addCategory" class="btn btn-success">TAMBAH</button>
			  <button type="button" @click="closeAddCatergory" class="btn btn-warning">CANCEL</button>
			</form>	
		</div>	
	</div>
</template>
<script>
	export default{
		data(){
			return{
				input:{
					title: ''
				}
			}
		},

		methods:{
			addCategory(){
				
				if(this.input.title.length > 3){

					this.$store.dispatch('store_new_category', this.input)
                        .then(() => {

                            flash('Category gallery berhasil ditambahkan','success');

                            this.input.title = '';
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

			closeAddCatergory(){
	           this.$emit('closeAddCategory',false);
	        }
		},
	};
</script>