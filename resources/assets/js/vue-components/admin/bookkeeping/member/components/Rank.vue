<template>
	<div class="col-sm-12 d-flex form-group">
		<div class="col-md-3 col-sm-5 d-flex justify-content-center align-items-center">
			<p class="m-0"> {{ rank.title }} </p>
		</div>
		<div class="col-md-8 col-sm-5">
			<datetime type="date" v-model="annointed_date" value-zone="local"></datetime>
		</div>
		
		<div class="col-md-1 col-sm-2 d-flex justify-content-center align-items-center">
			<template v-if="isEdit">
				<button class="btn btn-success btn-sm" @click="editRank">Save</button>
				<button class="btn btn-secondary btn-sm ml-2" @click="cancel">Cancel</button>
			</template>
			<button class="btn btn-danger btn-sm ml-2" 
					v-if="isLastIndex" @click="deleteRank">Delete</button>
		</div>
	</div>
</template>

<script>
	export default{
		props:{
			member:{},
			rank:{},
		},

		data(){
			return{
				isRequesting: false,
				annointed_date: this.rank.pivot.annointed_date
			}
		},

		computed:{
			isEdit(){
				return this.annointed_date.substring(0,10) != this.rank.pivot.annointed_date;
			},

			isLastIndex(){
				return this.member.rank[this.member.rank.length - 1].id == this.rank.id;
			}
		},

		methods:{

			cancel(){
				this.annointed_date = this.rank.pivot.annointed_date
			},

			editRank(){
				const self = this;

				if(!self.isRequesting){

					self.isRequesting = true

					this.$store.dispatch('edit_rank',{
						rank_id: self.rank.id,
						member_id: self.member.id,
						annointed_date: this.annointed_date.substring(0,10),
					})
					.then(() =>{
						self.isRequesting = false;

						flash('Ranks updated', 'danger')
					})
				}
			},

            deleteRank() {
     			this.$emit('showDeleteModal', this.rank);
            },
        }
	};
</script>