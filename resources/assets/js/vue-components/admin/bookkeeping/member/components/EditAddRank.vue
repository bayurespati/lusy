<template>
	<div class="panel-default panel mt-3 pt-4 bg-grey" id="edit_member">
		<div class="panel-body">
			<h3 class="text-center mb-3">Edit <strong>{{ member.name }}</strong> Ranks</h3>

			<div class="row pl-0 pr-0 m-0 pt-4 pb-4">
				<transition-group class="col-12 p-0" name="slide">	
					<item v-for="(rank, index) in member.rank" :member="member" :key="index" :rank="rank"></item>
				</transition-group>

				<transition-group class="col-12 p-0" name="slide">
					<div :key="'rank-options-' + index" v-for="(rank, index) in ranks" class="col-sm-12 d-flex form-group" v-if="index == currentIndex">
						<div class="col-md-3 col-sm-5 d-flex justify-content-center align-items-center">
							<p class="m-0"> {{rank.title}} </p>
						</div>

						<div class="col-md-8 col-sm-5">
							<datetime type="date" v-model="annointed_date"></datetime>
						</div>

						<div class="col-md-1 col-sm-2 d-flex justify-content-center align-items-center">
							<button class="btn btn-success btn-sm" @click="addRank(index)">Add</button>
						</div>
					</div>
				</transition-group>
			</div>
		</div>
	</div>
</template>

<script>
	import 'vue-datetime/dist/vue-datetime.css';
	import Item from './Rank.vue';
	import {mapGetters} from 'vuex';
	export default{
		props:{member:{}},

		data(){
			return{
				isRequesting: false,
				annointed_date: ''
			}
		},

		components:{
			Item
		},

		computed:{
			...mapGetters({
				ranks: 'getRanks',
			}),

			currentIndex(){
				return this.member.rank.length; 
			}
		},

		methods:{
			
			addRank(index){
				const self = this;
				if(!this.isRequesting && this.annointed_date != ''){

					this.$store.dispatch('add_rank',{
						member_id: this.member.id,
						rank_id: this.ranks[index].id,
						annointed_date: this.annointed_date.substring(0,10),
						title: this.ranks[index].title
					})
					.then(()=>{

						flash('Ranks added','success');

						this.isRequesting = false;

						this.annointed_date = '';
					})
					.catch(()=>{
						this.isRequesting = false;
					})
				}
			}
		}	
	};
</script>

<style scoped type="text/css">
	.card {
		flex-direction: unset;
		display: flex;
		flex-wrap: wrap;
		width: 100%;
		padding: 36px 10px 26px 10px;
	}

	.slide-enter {
	  opacity: 0;
	}

	.slide-enter-active {
	  animation: slide-in 0.6s ease;
	  transition: opacity 0.6s;
	}

	.slide-leave {
	}

	.slide-leave-active {
	  animation: slide-out 0.6s ease forwards;
	  transition: opacity 0.6s;
	  opacity: 0;
	  position: absolute;
	  width: 100%;
	}

	.slide-move {
	  transition: transform 0.6s;
	}

	@keyframes slide-in {
	  from {
	      transform: translateY(-20px);
	  }
	  to {
	      background-color: white;
	      transform: translateY(0px);
	  }
	}

	@keyframes slide-out {
	  from {
	      transform: translateY(0);
	  }
	  to {
	      transform: translateY(-20px);
	  }
	}
</style>