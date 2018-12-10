<template>
	<div class="col-sm-12">
		<div class="col-md-6 offset-md-3">

			<div class="card mb-2">
				<div class="text-center card-header">
				    Member
				</div>
				<div class="row card-body">
					<div class="col-md-7 d-flex align-items-center justify-content-end">
						<p> Total Member :</p>
					</div>
					<div class="col-md-5 align-items-center justify-content-start">
						<p> {{ totalMember }} </p>
					</div>
					<div class="col-md-7 d-flex align-items-center justify-content-end">
						<p> Member Active :</p>
					</div>
					<div class="col-md-5 align-items-center justify-content-start">
						<p> {{ memberActive }} </p>
					</div>
					<div class="col-md-7 d-flex align-items-center justify-content-end">
						<p> Member Not Active :</p>
					</div>
					<div class="col-md-5 align-items-center justify-content-start">
						<p> {{ memberNotActive }} </p>
					</div>
				</div>
			</div>

			<div class="card mb-2">
				<div class="text-center card-header">
				    Student
				</div>
				<div class="row card-body">
					<div class="col-md-7 d-flex align-items-center justify-content-end">
						<p> Total Student :</p>
					</div>
					<div class="col-md-5 align-items-center justify-content-start">
						<p> {{ (studentActive + studentNotActive) }} </p>
					</div>
					<div class="col-md-7 d-flex align-items-center justify-content-end">
						<p> Student Active :</p>
					</div>
					<div class="col-md-5 align-items-center justify-content-start">
						<p> {{ studentActive }} </p>
					</div>
					<div class="col-md-7 d-flex align-items-center justify-content-end">
						<p> Student Not Active :</p>
					</div>
					<div class="col-md-5 align-items-center justify-content-start">
						<p> {{ studentNotActive }} </p>
					</div>
				</div>
			</div>

			<div class="card">
				<div class="text-center card-header">
				    Teacher
				</div>
				<div class="row card-body">
					<div class="col-md-7 d-flex align-items-center justify-content-end">
						<p> Total Teacher :</p>
					</div>
					<div class="col-md-5 align-items-center justify-content-start">
						<p> {{ (teacherActive + teacherNotActive) }} </p>
					</div>
					<div class="col-md-7 d-flex align-items-center justify-content-end">
						<p> Teacher Active :</p>
					</div>
					<div class="col-md-5 align-items-center justify-content-start">
						<p> {{ teacherActive }} </p>
					</div>
					<div class="col-md-7 d-flex align-items-center justify-content-end">
						<p> Teacher Not Active :</p>
					</div>
					<div class="col-md-5 align-items-center justify-content-start">
						<p> {{ teacherNotActive }} </p>
					</div>
				</div>
			</div>

		</div>
	</div>	
</template>

<script>
	export default{
		data(){
			return{
				members: '',
				memberActive: 0,
				memberNotActive: 0,
				studentActive: 0,
				studentNotActive: 0,
				teacherActive: 0,
				teacherNotActive: 0

			}
		},

		mounted(){
			this.load_members();
		},

		computed:{

			totalMember(){
				return this.members.length;
			},
		},

		methods:{

			load_members(){
 				axios.get('/admin/bookkeeping/data/members')
                	.then(response =>{ 
                		this.members = response.data;

                		this.countAlldata();
                });
			},

			countAlldata(){
				for(let i = 0; i < this.members.length; i++){

					if(this.members[i].is_active){

						this.memberActive += 1;

						if(this.members[i].is_teacher){
							this.teacherActive += 1;
						}else{
							this.studentActive += 1;
						}

					}else{
						this.memberNotActive += 1;

						if(this.members[i].is_teacher){
							this.teacherNotActive += 1;
						}else{
							this.studentNotActive += 1;
						}
					}
				}
			}
		}
	};	
</script>

<style scoped>
	p{
		margin-bottom: 0.5em;
	}
</style>