<template>
	<div class="col-sm-12 d-flex form-group">
		<div class="col-md-5">
			<p> {{ rank.title }} </p>
		</div>
		<div class="col-md-5">
			<datetime type="date" v-model="annointed_date" value-zone="local"></datetime>
		</div>
		
		<div class="col-md-2 d-flex">
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

		computed:{
			isEdit(){
				return this.annointed_date.substring(0,10) != this.rank.annointed_date;
			},

			isLastIndex(){
				return this.member.ranks[this.member.ranks.length - 1].rankId == this.rank.rankId;
			}
		},

		data(){
			return{
				isRequesting: false,
				annointed_date: this.rank.annointed_date
			}
		},

		methods:{

			cancel(){
				this.annointed_date = this.rank.annointed_date
			},

			editRank(){
				const self = this;

				if(!self.isRequesting){

					console.log(this.annointed_date);

					self.isRequesting = true

					this.$store.dispatch('edit_rank',{
						rank_id: self.rank.rankId,
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
                const self = this;

                if(!self.isRequesting){

                    self.isRequesting = true;

                    this.$store.dispatch('destroy_rank', {
                        rank_id: self.rank.rankId,
                        member_id: self.member.id
                    })
                    .then(() => {

                        self.isRequesting = false;

                        flash('Ranks deleted', 'danger');

                        self.changeCurrent();
                    })
                }
            },

            changeCurrent() {

     			this.$emit('changeCurrentIndex',1);
    		}
        }
	};
</script>