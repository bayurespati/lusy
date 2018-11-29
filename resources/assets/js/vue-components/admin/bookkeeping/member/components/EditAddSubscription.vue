<template>
	<div class="panel-default panel mt-3 pt-4 bg-grey" id="edit_member">
		<div class="panel-body">
			<h3 class="text-center mb-3">Edit <strong>{{ member.name }}</strong> Subscription</h3>

			<div class="row pl-0 pr-0 m-0 pt-4 pb-4">
				<div class="col-md-12 d-flex">
					<div class="col-md-12">
						<input type="number" 
						@input="$v.year.$touch()"
						class="form-control" 
						:class="{'form-control-danger': $v.year.$error}"
						placeholder="Input Years" v-model="year">

						<transition enterActiveClass="fade-in" leaveActiveClass="fade-out" mode="out-in">
							<span key="year-minimum" class="text-danger" v-if="!$v.year.minLength">
								Year must has of {{ $v.year.$params.minLength.min }} characters
							</span>
							<span key="year-maximum" class="text-danger" v-if="!$v.year.maxLength">
								Year must has of {{ $v.year.$params.maxLength.max }} characters
							</span>
						</transition>
					</div>
				</div>

				<div class="col-md-12 row mr-0 ml-0 mt-4 mb-2" v-if="subscription.length > 0">
					<transition-group class="col-12 row m-0" appear enterActiveClass="fade-in" leaveActiveClass="fade-out" mode="out-in">
						<div :key="'subscription-year-' + index" class="col-md-2 col-sm-6" v-for="(list, index) in member.subscription">
							<p class="m-0 d-flex align-items-center justify-content-center">{{ list.year }}
								<span @click="delete_subscription(list)" 
								class="badge badge-danger ml-1" style="cursor: pointer">
									X
								</span> 
							</p>
						</div>
					</transition-group>
				</div>

				<div class="col-md-12 d-flex justify-content-center mt-2">
					<button class="btn btn-success btn-sm" @click="add_subscription()">Add</button>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import {minLength, maxLength} from 'vuelidate/lib/validators';
	export default{
		props:{
			member:{},
			teacherId:''
		},

		data(){
			return{
				year:'',
				isRequesting: false,
				subscription: this.member.subscription
			}
		},

		validations:{
			year:{
            	maxLength: maxLength(4),
            	minLength: minLength(4)
            }
		},

		methods:{
			add_subscription(){
				const self = this;

				if(!self.isRequesting){	
					self.isRequesting = true;

					this.$store.dispatch('add_subscription',{
						teacher_id: this.teacherId,
						member_id: self.member.id,
						year: this.year
					}).then(()=>{

						flash('Subscription added','success');

						self.isRequesting = false;

						self.year = '';

					}).catch(() => {
						self.isRequesting = false;
					})
				}
			},

			delete_subscription(subscription){
				const self = this;

				if(!self.isRequesting){

					this.isRequesting = true;

					this.$store.dispatch('destroy_subscription',{
							subscription_id: subscription.id,
							member_id: this.member.id,
							teacher_id: this.teacherId,

						})
							.then(() => {

								flash('Subscription deleted', 'danger')

								self.isRequesting = false;
							})
							.catch(() => {
								self.isRequesting = false;
							})

				}
			}
		}
	};
</script>