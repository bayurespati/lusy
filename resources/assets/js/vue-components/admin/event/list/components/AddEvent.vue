<template> 
	<div class="row pt-5">
		<div class="col-md-12">
			<div class="card text-center">
				<h4 class="title font-weight-bold mb-4">Tambah Event</h4>

				<div class="form-group text-left mb-3">
					<input type="text" 
						   v-model="input.title" 
						   class="form-control" id="name" 
						   placeholder="Nama Event">
				</div>

				<div class="form-group text-left mb-3">
					<label for="start_date">Start Date</label>
					<datetime type="datetime" value-zone="local" id="start_date" class="form-control" v-model="input.start_date"></datetime>
				</div>

				<div class="form-group text-left mb-3">
					<label for="end_date">End Date</label>
					<datetime type="datetime" id="end_date" class="form-control" v-model="input.end_date"></datetime>
				</div>

				<div class="form-group text-left mb-3">
					<input type="text" 
					       v-model="input.location" 
					       class="form-control" id="location" 
					       placeholder="Location">
				</div>

				<div class="form-group text-left mb-3">
					<input type="text" 
					       v-model="input.address" 
					       class="form-control" id="address"
					       placeholder="Address">
				</div>

				<div class="form-group text-left mb-3">
					<textarea rows="4"
							  v-model="input.content"
							  class="form-control" 
							  placeholder="content"></textarea>
				</div>

				<div class="form-group text-left mb-3">
					<input type="text" 
					       v-model="input.organiser" 
					       class="form-control" id="organiser"
					       placeholder="Organiser">
				</div>


				<div class="form-group">
	                <select class="form-control" id="category" v-model="subcategories">
	                    <option value="">Pilih Category</option>
	                    <option v-for="category in categories" :value=category.subcategories>{{ category.title }}</option>
	                </select>
	            </div>

	            <div class="form-group">
	                <select class="form-control" id="subcategory" v-model="input.sub_category_id">
	                    <option value="">Pilih Sub Category</option>
	                    <option v-for="subcategory in subcategories" :value=subcategory.id>{{ subcategory.title }}</option>
	                </select>
	            </div>

				<button type="button" @click="addEvent" class="btn btn-sm btn-success">Tambah</button>
				<button type="button" @click="closeAddEvent" class="btn btn-sm btn-warning ml-1">Cancel</button>
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
				
				if(this.input.title.length > 3){

					this.$store.dispatch('store_new_event', this.input)
                        .then(() => {
                            flash('Event berhasil ditambahkan','success');
                            this.input.title = '';

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