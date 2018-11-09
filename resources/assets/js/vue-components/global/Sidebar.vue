<template>
	<nav id="sidebar">
	    <div class="sidebar-header">
	        <a href="#"><h3>Lusy Wahyudi</h3></a>
	    </div>

	    <ul class="list-unstyled components" >
	        <li v-for="menu in menus">
	            <a 	:href="'#' + menu.id" 
	            	data-toggle="collapse" 
	            	:aria-expanded="{ 'true' : menuName === menu.id } "
	            	:class= "{ 'active-forced': menuName === menu.id }"
	            	class="dropdown-toggle">
		        	{{ menu.name }}
	        	</a>
	            <ul :id="menu.id" 
	            	class="collapse list-unstyled" 
	            	:class= "{ 'show': menuName === menu.id }">
	                <li v-for="submenu in menu.subMenu">
	                    <a @click="goTo(submenu.link)"
	                       :class= "{ 'active-forced': subMenuName === submenu.link }">
	                   	   {{ submenu.name }} 
	                   	   <span style="color: red" v-if="potentialTotal > 0 && submenu.link === 'bookeeping/potential' ">
	                   	   	{{ 
	                   	   		potentialTotal 
	                   	   	}}
	                   	   </span>
	                   	   <span style="color: red" v-if="messageTotal > 0 && submenu.link === 'bookeeping/message' ">
	                   	   	{{
	                   	   		messageTotal
	                   	   	}}
	                   	   </span>
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
				potentials: '',
				message: '',
				menuName: '',
				subMenuName: '',

				menus:[
					{	
						id: 'home',
						name: 'Home',
						subMenu:[ 
							{ name: 'Sosial Media', link: 'home/sosmed' },
							{ name: 'Image Slider', link: 'home/image-slider' }
						]
					},
					{
						id: 'about',
						name: 'About',
						subMenu:[
							{ name: 'Gallery', link: 'about/gallery' },
							{ name: 'Profile', link: 'about/profile' },
							{ name: 'Clasess', link: 'about/class' }
						]
					},
					{
						id: 'gallery',
						name: 'Gallery',
						subMenu:[
							{ name:'Category', link: 'gallery/category' },
							{ name:'Sub Category', link: 'gallery/subcategory' },
							{ name:'Photo List', link: 'gallery/list' },
						]
					},
					{
						id: "event",
						name: 'Event & Activity List',
						subMenu:[
							{ name:'Category', link: 'event/category' },
							{ name:'Sub Category', link: 'event/subcategory' },
							{ name:'Event & Activity List', link: 'event/list' }
						]
					},
					{
						id: 'shop',
						name: 'Shop',
						subMenu:[
							{ name:'Category', link: 'shop/category' },
							{ name:'Sub Category', link: 'shop/subcategory' },
							{ name:'Item List', link: 'shop/list' }
						]
					},
					{	
						id: 'bookeeping',
						name: 'Bookeeping',
						subMenu:[
							{ name:'Member', link: '#' },
							{ name:'Applicant List', link: '#' },
							{ name:'Overseas Inquiry List', link: 'bookeeping/overseas' },
							{ name:'Potential Overseas Inquiry List', link: 'bookeeping/potential' },
							{ name:'Message', link: 'bookeeping/message' }
						]
					}
				],
			}
		},

		mounted(){
			this.setName();
			this.getPotential();
			this.getMessage();
		},

		computed:{
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
			}
		},

		methods:{
 			getPotential(){
 				axios.get('/admin/bookeeping/data/potential')
                .then(response =>{
                    this.potentials = response.data;
                });
			},

			getMessage(){
				axios.get('/admin/bookeeping/data/message')
                .then(response =>{
                    this.message = response.data;
                });
			},

			setName(){
				let link = window.location.pathname.split('/');

				this.menuName = link[2];
				this.subMenuName = link[2]+'/'+link[3];
			},

			goTo(url){
				window.location.href = '/admin/'+url;
            }
		}
	};
</script>
<style scoped>
	a{
		cursor: pointer;
	}
</style>