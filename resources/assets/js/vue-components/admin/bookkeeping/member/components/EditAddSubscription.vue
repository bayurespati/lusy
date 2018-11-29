<template>
	<div class="row pl-0 pr-0 m-0 pt-4 pb-4">
		<div class="col-md-12 d-flex">
			<div class="col-md-5">
				<p> Subscription </p>
			</div>
			<div class="col-md-5">
				<div class="form-group text-center mb-3">
					<input type="number" 
						   @input="$v.year.$touch()"
						   :class="{'form-control-danger': $v.year.$error}"
						   placeholder="input years" v-model="year">
				</div>
				<!--======================================================================================
                    V A L I D A T I O N     E R R O R   M E S S A G E S
                    ======================================================================================-->
            		<transition enterActiveClass="fade-in" leaveActiveClass="fade-out" mode="out-in">
                    	<span key="year-minimum" class="text-danger" v-if="!$v.year.minLength">
                    		Year must has of {{ $v.year.$params.minLength.min }} characters
                    	</span>
                    	<span key="year-maximum" class="text-danger" v-if="!$v.year.maxLength">
                    		Year must has of {{ $v.year.$params.maxLength.max }} characters
                		</span>
            		</transition>
			</div>
			<div class="col-md-2">
				<button class="btn btn-success btn-sm" @click="add_subscription()">Add</button>
			</div>
		</div>
		<div class="col-md-12 d-flex">
			<div v-for="(list, index) in member.subscription">
				<p>{{ list.year }}
					<span @click="delete_subscription(list)" 
						  class="badge badge-danger" style="cursor: pointer">X</span> 
				</p>
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