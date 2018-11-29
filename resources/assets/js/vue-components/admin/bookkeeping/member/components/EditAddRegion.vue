<template>
	<div class="panel-default panel mt-3 pt-4 bg-grey" id="edit_member">
		<div class="panel-body">
			<h3 class="text-center mb-3">Edit <strong>{{ member.name }}</strong> Class Regions</h3>

			<div class="row pl-0 pr-0 m-0 pt-4 pb-4">

				<div class="col-md-12 d-flex">
					<div class="col-md-12">
						<select class="form-control" id="calss-region" v-model="region">
							<option value='' disabled="">Choose Class Region</option>
							<option v-for="region in regions" :value=region>{{ region.name }}</option>
						</select>
					</div>
				</div>

				<div class="col-md-12 d-flex justify-content-center">
					<transition-group enterActiveClass="fade-in" leaveActiveClass="fade-out" mode="out-in">
						<div :key="'class-region-' + index" v-for="(list, index) in member.region" style="display: inline-block">
							<p class="mr-3 mb-0 d-flex align-items-center">{{ list.name }}
								<span @click="delete_region(list)"
								class="badge badge-danger ml-1" 
								style="cursor: pointer">
									X
								</span> 
							</p>
						</div>
					</transition-group>
				</div>

				<div class="col-md-12 d-flex justify-content-center mt-2">
					<button type="button" @click="add_region"
					:disabled="hasChoosen"
					class="btn btn-success btn-sm">
						Add Region
					</button>
				</div>

				<div class="col-md-12 d-flex justify-content-center mt-2">
					<transition enterActiveClass="fade-in" leaveActiveClass="fade-out" mode="out-in">
						<span class="text-danger" v-if="hasChoosen">Already chosen</span>
					</transition>
				</div>
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
				region: '',
				isRequesting: false,
				classRegion: this.member.region,
			}
		},

		computed:{
			...mapGetters({
				regions: 'getRegions',
			}),

			hasChoosen(){
				const isFind = _.find(this.member.region,['id', this.region.id]);

				return isFind == undefined ? false : true;
			},
		},

		methods:{
			add_region(){

				const self = this;

				if(!self.isRequesting && !self.hasChoosen && this.region != ''){

					const tempRegion = self.region;
					self.region = '';
						
					this.$store.dispatch('add_region',{
						name: tempRegion.name,
						region_id : tempRegion.id,
						member_id : self.member.id
					}).then(() => {
						flash('Class ragion '+ tempRegion.name +' has been added.', 'success');

						self.isRequesting = false;

					}).catch(() => {

						self.isRequesting = false;

					})

				}
			},

			delete_region(region){

				const self = this;

				if(!self.isRequesting){

					self.isRequesting = true;

					this.$store.dispatch('destroy_region',{
						region_id : region.id,
						member_id : this.member.id
					}).then(() => {
						flash('Class region '+ region.name +' has been deleted.', 'danger');

						self.isRequesting = false;

					}).catch(() => {

						self.isRequesting = false;

					})

				}

			}
		}
	};
</script>