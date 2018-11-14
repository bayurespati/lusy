<!-- S A M A I N   R O U T E N Y A ,   R O U T E N Y A   G A   R U N U T -->
<template>
	<nav id="sidebar">
	    <div class="sidebar-header">
	        <a href="/"><h3>Lusy Wahyudi</h3></a>
	    </div>

	    <ul class="list-unstyled components">
	        <li v-for="menu in menus">
	            <a 	:href="'#' + menu.id" 
	            	data-toggle="collapse" 
	            	:aria-expanded="{ 'true' : menuName === menu.id }"
	            	:class= "{ 'active-forced': menuName === menu.id }"
	            	class="dropdown-toggle">
		        	{{ menu.name }}
		        	<span class="notification-dot fa fa-circle ml-2"
		        	v-if="(potentialTotal > 0 || messageTotal > 0 || applicantTotal > 0) &&
		        	menu.id === 'bookkeeping'">
		        	</span>
	        	</a>
	            <ul :id="menu.id" 
	            	class="collapse list-unstyled" 
	            	:class= "{ 'show': menuName === menu.id }">
	                <li v-for="submenu in menu.subMenu">
	                    <a :href="submenu.link"
	                       :class= "{ 'active-forced': subMenuName === submenu.link }" 
	                       style="position: relative;"> {{ submenu.name }}

	                       <div class="notification-dot-left" 
	                    	v-if="applicantTotal > 0 && submenu.link === '/admin/bookkeeping/applicant-event'">
	                    		<span>
	                    			{{ applicantTotal }}
	                    		</span>
	                    	</div>

	                    	<div class="notification-dot-left" 
	                    	v-else-if="potentialTotal > 0 && submenu.link === '/admin/bookkeeping/potential'">
	                    		<span>
	                    			{{ potentialTotal }}
	                    		</span>
	                    	</div>

	                    	<div class="notification-dot-left" 
	                    	v-else-if="messageTotal > 0 && 
	                    	submenu.link === '/admin/bookkeeping/message'">
	                    		<span>
	                    			{{ messageTotal }}
	                    		</span>
	                    	</div>

	                    	<div class="notification-dot-left" 
	                    	v-else-if="memberTotal > 0 && 
	                    	submenu.link === '/admin/bookkeeping/applicant-member'">
	                    		<span>
	                    			{{ memberTotal }}
	                    		</span>
	                    	</div>
	                    </a>
	                </li>
	            </ul>
	        </li>
		</ul>
	</nav>
</template>
<script>
	import {mapGetters} from 'vuex';
	export default{

		data(){
			return{
				applicants: '',
				potentials: '',
				member: '',
				message: '',
				menuName: '',
				subMenuName: '',

				menus:[
					{	
						id: 'home',
						name: 'Home',
						subMenu:[ 
							{ name: 'Sosial Media', link: '/admin/home/sosmed' },
							{ name: 'Image Slider', link: '/admin/home/image-slider' },
							{ name: 'Image Config', link: '/admin/home/image-config' }
						]
					},
					{
						id: 'about',
						name: 'About',
						subMenu:[
							{ name: 'Profile', link: '/admin/about/profile' },
							{ name: 'Clasess', link: '/admin/about/class' },
							{ name: 'Gallery Showcase', link: '/admin/about/showcase' },
							{ name: 'Shop Showcase', link: '/admin/about/shop-showcase' },
						]
					},
					{
						id: 'gallery',
						name: 'Gallery',
						subMenu:[
							{ name:'Category', link: '/admin/gallery/category' },
							{ name:'Sub Category', link: '/admin/gallery/subcategory' },
							{ name:'Photos', link: '/admin/gallery/list' },
						]
					},
					{
						id: 'event',
						name: 'Events & Activities',
						subMenu:[
							{ name:'Category', link: '/admin/event/category' },
							{ name:'Sub Category', link: '/admin/event/subcategory' },
							{ name:'Events & Activities', link: '/admin/event/list' }
						]
					},
					{
						id: 'shop',
						name: 'Shop',
						subMenu:[
							{ name:'Category', link: '/admin/shop/category' },
							{ name:'Sub Category', link: '/admin/shop/subcategory' },
							{ name:'Items', link: '/admin/shop/list' }
						]
					},
					{	
						id: 'bookkeeping',
						name: 'Bookkeeping',
						subMenu:[
							{ name:'Member', link: '#' },
							{ name:'Member Applicants', link: '/admin/bookkeeping/applicant-member' },
							{ name:'Event Applicants', link: '/admin/bookkeeping/applicant-event' },
							{ name:'Overseas Inquiries', link: '/admin/bookkeeping/overseas' },
							{ name:'Potential Overseas Inquiries', link: '/admin/bookkeeping/potential' },
							{ name:'Messages', link: '/admin/bookkeeping/message' }
						]
					}
				],
			}
		},

		mounted(){
			this.setName();
			this.getApplicant();
			this.getPotential();
			this.getMessage();
			this.getMember();
		},

		computed:{
			applicantTotal(){
				let totalApplicants = 0;

				if(this.$store.getters.getApplicantItems === undefined){

					for(let i = 0; i < this.applicants.length; i++){
						for(let k = 0; k < this.applicants[i].applicants.length; k++){
							if(this.applicants[i].applicants[k].is_approve === 0){
								totalApplicants++;
							}
						}
					};
				}
				else{
					let appEvent = this.$store.getters.getApplicantEvent;

					for(let i = 0; i < appEvent.length; i++){
						for(let k = 0; k < appEvent.applicants.length; k++){
							if(appEvent.applicants[k].is_approve === 0){
								totalApplicants++;
							}
						}
					};
				}

				return totalApplicants;
			},

			potentialTotal(){
				if(this.$store.getters.getPotentialItems === undefined){
					return this.potentials.length
				}else{
					return this.$store.getters.getPotentialItems.length
				}
			},

			messageTotal(){
				if(this.$store.getters.getMessageItems === undefined){
					return this.message.length
				}else{
					return this.$store.getters.getMessageItems.length;
				}
			},

			memberTotal(){
				if(this.$store.getters.getApplicantMemberItems === undefined){
					return this.member.length;
				}else{
					return this.$store.getters.getApplicantMemberItems.length;
				}
			}
		},

		methods:{

			getApplicant(){
				if(this.$store.getters.getApplicantItems === undefined){
					axios.get('/admin/bookkeeping/data/applicant-event')
	                .then(response =>{
	                    this.applicants = response.data;
	                });
	            }
			},

 			getPotential(){
 				if(this.$store.getters.getPotentialItems === undefined){
 					axios.get('/admin/bookkeeping/data/potential')
                	.then(response =>{
                    	this.potentials = response.data;
                	});
            	}
			},

			getMessage(){
				if(this.$store.getters.getMessageItems === undefined){
					axios.get('/admin/bookkeeping/data/message')
	                .then(response =>{
	                    this.message = response.data;
	                });					
				}
			},

			getMember(){
				if(this.$store.getters.getApplicantMemberItems === undefined){
					axios.get('/admin/bookkeeping/data/applicant-member')
	                .then(response =>{
	                    this.member = response.data;
	                });
				}
			},

			setName(){
				let link = window.location.pathname.split('/');

				this.menuName = link[2];

				this.subMenuName = '/admin/' + link[2] + '/' + link[3];
			},
		},
	};
</script>
<style scoped>
	a{
		cursor: pointer;
	}

	.notification-dot, 
	.notification-dot-left {
		font-size: 10px;
		color: palevioletred;
	}

	.notification-dot-left {
		position: absolute;
		right: 10px;
		top: 5px;
		width: 30px;
		height: 30px;
		border-radius: 50%;
		background: palevioletred;
		padding: 8px 7px 8px 7px;
		color: white;
		white-space: nowrap;
  		overflow: hidden;
  		text-overflow: ellipsis;
  		text-align: center;
  		font-weight: bold;
	}

	#sidebar ul li a {
		padding-right: 50px;
	}
</style>