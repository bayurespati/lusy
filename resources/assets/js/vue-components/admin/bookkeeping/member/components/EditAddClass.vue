<template>
	<div class="row pl-0 pr-0 m-0 pt-4 pb-4">
		<div class="col-sm-12 d-flex form-group">
			<h4 class="title mb-5">Class</h4>
		</div>
		<div class="col-md-12 d-flex">
			<div class="col-md-6">
				<select class="form-control" id="calss-list" 
					    v-model="classItem">
		    		<option value='' disabled="">Choose Class</option>
			    	<option v-for="list in classList" :value=list>{{ list.title }}</option>
		    	</select>
		    	<transition enterActiveClass="fade-in" leaveActiveClass="fade-out" mode="out-in">
					<span class="text-danger" v-if="isLastClass">The last class can't be deleted</span>
				</transition>
			</div>

			<div class="col-md-6">
				<button type="button" @click="add_class"
						:disabled="hasChoosen"
						class="btn btn-success btn-sm">
					Add Class
				</button>
				<transition enterActiveClass="fade-in" leaveActiveClass="fade-out" mode="out-in">
					<span class="text-danger" v-if="hasChoosen">Already chosen</span>
				</transition>
			</div>
		</div>

		<div class="col-md-12 d-flex">
			<div v-for="(list, index) in member.class">
				<p>{{ list.title }}
					<span @click="delete_class(list)"
						  class="badge badge-danger" 
						  style="cursor: pointer">X
					</span> 
				</p>
			</div>
		</div>
	</div>
</template>

<script>
	import {mapGetters} from 'vuex';
	export default{
		props:{member:{}},

		data(){
			return{
				isLastClass : false,
				classItem: '',
				isRequesting: false
			}
		},

		computed:{
			...mapGetters({
				classList: 'getClass',
			}),

			hasChoosen(){
				const isFind = _.find(this.member.class,['id', this.classItem.id]);

				return isFind == undefined ? false : true;
			},
		},

		methods:{
			add_class(){

				const self = this;

				if(!self.isRequesting && !self.hasChoosen && this.classItem != ''){

					const tempClass = self.classItem;
					self.classItem = '';
						
					this.$store.dispatch('add_class',{
						title: tempClass.title,
						class_id : tempClass.id,
						member_id : self.member.id
					}).then(() => {
						flash('Class '+ tempClass.title +' has been added.', 'success');

						self.isRequesting = false;

					}).catch(() => {

						self.isRequesting = false;

					})

				}
			},

			delete_class(classItem){

				const self = this;

				if(!self.isRequesting && this.member.class.length > 1){

					self.isRequesting = true;

					this.$store.dispatch('destroy_class',{
						class_id : classItem.id,
						member_id : this.member.id
					}).then(() => {
						flash('Class '+ classItem.title +' has been deleted.', 'danger');

						self.isRequesting = false;

					}).catch(() => {

						self.isRequesting = false;

					})

				}else if(this.member.class.length == 1){
					this.isLastClass = true;

					const self = this;
					setTimeout(function(){
						self.isLastClass = false;
					},2000)
				}
			}
		}
	};
</script>