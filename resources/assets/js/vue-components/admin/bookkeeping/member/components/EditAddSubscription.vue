<template>
	<div class="panel-default panel mt-3 pt-4 bg-grey" id="edit_member">
		<div class="panel-body">
			<h3 class="text-center mb-3">Edit <strong>{{ member.name }}</strong> Subscription</h3>

			<div class="row pl-0 pr-0 m-0 pt-4 pb-4">
				<div class="col-md-12 d-flex">
					<div class="col-md-12 text-center">
						<input type="number" 
						@input="$v.year.$touch()"
						class="form-control" 
						:class="{'form-control-danger': $v.year.$error || alreadyHasYear }"
						placeholder="Input Years" v-model="year">

						<transition enterActiveClass="fade-in" leaveActiveClass="fade-out" mode="out-in">
							<span key="year-minimum" class="text-danger" v-if="!$v.year.minLength">
								Year must has of {{ $v.year.$params.minLength.min }} characters
							</span>
							<span key="year-maximum" class="text-danger" v-if="!$v.year.maxLength">
								Year must has of {{ $v.year.$params.maxLength.max }} characters
							</span>
							<span key="year-maximum" class="text-danger" v-if="alreadyHasYear">
								Can't input same year
							</span>
						</transition>
					</div>
				</div>

				<div class="col-md-12 row mr-0 ml-0 mt-4 mb-2" v-if="member.subscription.length > 0">

					<transition-group class="col-12 row m-0" 
									  appear enterActiveClass="fade-in" 
									  leaveActiveClass="fade-out" mode="out-in">
						
						<div v-for="(list, index) in showSubscription"
							 class="mr-2 mb-2"
							 :key="'subscription-year-' + index"
							 style="border: 1px #908f96 solid; padding: 2px 6px; color: #6d6c73">
                                   {{ list.year }}
                                    <span @click="delete_subscription(list)" 
									      class="badge badge-danger btn"> X </span>
                        </div>
					</transition-group>
				</div>

				<div class="col-md-12 d-flex justify-content-center mt-2">
					<button type="button" class="btn btn-secondary btn-sm" @click="closeEditForm">
						Close
					</button>

					<button class="btn btn-success btn-sm ml-2" :disabled="isRequesting" @click="add_subscription()">
						Add Subscription Year
					</button>

					<delete-year :show-modal="showModal"
					:year="yearToBeDeleted"
					:memberId="member.id"
					:teacherId="teacherId"
					@set-show-modal-to-false="hideModal">
					</delete-year>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import DeleteYear from './DeleteSubscriptionInEdit.vue';
	import {minLength, maxLength} from 'vuelidate/lib/validators';

	export default{
		components: {
			DeleteYear
		},

		props:{
			member:{},
			teacherId:''
		},

		data(){
			return{
				year:'',
				isRequesting: false,
				yearToBeDeleted: {},
				showModal: false,
			}
		},

		validations:{
			year:{
            	maxLength: maxLength(4),
            	minLength: minLength(4)
            }
		},

		computed:{

			showSubscription(){
				let tempSubscription = this.member.subscription;
				let subscriptions = _.sortBy(tempSubscription,'year');
				return subscriptions;
			},

            alreadyHasYear(){

                if(this.year.length != 4){
                    return false;
                }

                for(let index = 0; index < this.member.subscription.length; index++){
                    if(this.member.subscription[index].year == this.year){
                        return true;
                    }
                }

                return false;
            }
		},

		methods:{
			closeEditForm(){
	           this.$emit('closeEditForm',false);
			},

			add_subscription(){
				const self = this;

				if(!self.isRequesting && !self.alreadyHasYear && this.year.length == 4){	

					self.isRequesting = true;
					let tempYear = this.year;
					this.year = '';

					this.$store.dispatch('add_subscription',{
						teacher_id: this.teacherId,
						member_id: self.member.id,
						year: tempYear
					}).then(()=>{

						flash('Subscription added','success');

						self.isRequesting = false;

						self.year = '';

					}).catch(() => {
						self.isRequesting = false;
					})
				}
			},

			hideModal(){
				this.showModal = false;
				this.yearToBeDeleted = {};
			},

			delete_subscription(newYear){
				this.showModal = true;
				this.yearToBeDeleted = newYear;	
			}
		}
	};
</script>