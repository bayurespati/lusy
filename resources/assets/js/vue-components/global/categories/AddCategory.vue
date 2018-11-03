<template> 
	<div class="row pt-5">
		<div class="col-md-12">
			<div class="card text-center">
				<h4 class="title font-weight-bold mb-4">Tambah Kategori</h4>
				<div class="form-group text-left mb-3">
					<input type="text" v-model="input.title" class="form-control" id="title" placeholder="Nama Kategori">
				</div>
				<button type="button" @click="addCategory" class="btn btn-sm btn-success">Tambah</button>
				<button type="button" @click="closeAddCatergory" class="btn btn-sm btn-danger ml-1">Batal</button>
			</div>	
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