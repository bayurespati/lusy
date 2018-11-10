<template> 
	<div class="row">
		<div class="col-md-12">
			<div class="card text-center">
				<div class="col-md-12">
					<h4 class="title font-weight-bold mb-5">Tambah Event</h4>
				</div>

				<div class="col-md-12 d-flex">
					<div class="col-md-6">
						<div class="form-group text-left mb-3">
							<input type="text" 
							v-model="input.title" 
							class="form-control" id="name" 
							placeholder="Judul Acara">
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group text-left mb-3">
							<input type="text" 
							v-model="input.organiser" 
							class="form-control" id="organiser"
							placeholder="Organiser">
						</div>
					</div>
				</div>

				<div class="col-md-12 d-flex">
					<div class="col-md-6">
						<div class="form-group text-left mb-3">
							<datetime type="datetime" value-zone="local" id="start_date" v-model="input.start_date" placeholder="Waktu Mulai"></datetime>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group text-left mb-3">
							<datetime type="datetime" id="end_date" v-model="input.end_date" placeholder="Waktu Selesai"></datetime>
						</div>
					</div>
				</div>

				<div class="col-md-12 d-flex">
					<div class="col-md-6">
						<div class="form-group text-left mb-3">
							<input type="text" 
							v-model="input.location" 
							class="form-control" id="location" 
							placeholder="Lokasi">
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group text-left mb-3">
							<input type="text" 
							v-model="input.address" 
							class="form-control" id="address"
							placeholder="Alamat">
						</div>
					</div>
				</div>

				<div class="col-md-12 d-flex">
					<div class="col-md-6">
						<div class="form-group">
							<select class="form-control" id="category" v-model="subcategories">
								<option value="">Pilih Kategori</option>
								<option v-for="category in categories" :value=category.subcategories>{{ category.title }}</option>
							</select>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<select class="form-control" id="subcategory" v-model="input.sub_category_id">
								<option value="">Pilih Subkategori</option>
								<option v-for="subcategory in subcategories" :value=subcategory.id>{{ subcategory.title }}</option>
							</select>
						</div>
					</div>
				</div>

				<div class="col-md-12 d-flex">
					<div class="col-md-12">
						<div class="form-group text-left mb-3">
							<textarea rows="4"
							v-model="input.content"
							class="form-control" 
							placeholder="Konten Acara">
							</textarea>
						</div>
					</div>
				</div>

				<div class="col-md-12 d-flex justify-content-center">
					<button type="button" @click="addEvent" class="btn btn-sm btn-success">
						Tambah
					</button>
					<button type="button" @click="closeAddEvent" class="btn btn-sm btn-warning ml-1">
						Batal
					</button>
				</div>
			</div>	
		</div>
	</div>
</template>
<script>
	import {mapGetters} from 'vuex';	
	import 'vue-datetime/dist/vue-datetime.css';
	import {Datetime} from 'vue-datetime';
    Vue.use(Datetime)

	export default{
		data(){
			return{
				subcategories: '',
				input:{
					title: '',
					start_date: '',
					end_date: '',
					location: '',
					address: '',
					content: '',
					organiser: '',
					sub_category_id: '',
					organiser:''
				}
			}
		},

		components:{
			Datetime
		},

		computed:{
			...mapGetters({
				categories: 'getCategories',
			}),
		},

		methods:{
			addEvent(){

				let vm = this;
				
				if(this.input.title.length > 3){

					this.$store.dispatch('store_new_event', this.input)
                        .then(() => {
                            flash('Event berhasil ditambahkan','success');
                            this.input.title = '';

                            vm.setData();

                            vm.closeAddEvent();
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

			closeAddEvent(){
	           this.$emit('closeAddEvent',false);
	        }
		},

		watch:{
            subcategories(){
                this.input.sub_category_id = "";
            }
        },
	};
</script>

<style type="text/css">
	.vdatetime-input {
        width: 100%;
        padding: .375rem .75rem;
        line-height: 1.5;
        font-size: 1rem;
        color: #495057;
        border-radius: .25rem;
        border: 1px solid #ced4da;
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

	.normal-placeholder::-webkit-input-placeholder,
    .normal-placeholder:-moz-placeholder,
    .normal-placeholder::-moz-placeholder,
    .normal-placeholder:-ms-input-placeholder {
        text-align: left !important;
    }
</style>

<style scoped type="text/css">
	.card {
		flex-direction: unset;
		display: flex;
		flex-wrap: wrap;
		width: 100%;
		padding: 36px 10px 26px 10px;
	}
</style>