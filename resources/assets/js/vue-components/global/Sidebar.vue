<!-- S A M A I N   R O U T E N Y A ,   R O U T E N Y A   G A   R U N U T -->
<template>
	<nav id="sidebar">
	    <div class="sidebar-header">
	        <a href="/"><h3>Lusy Wahyudi</h3></a>
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
	                    <a :href="submenu.link"
	                       :class= "{ 'active-forced': subMenuName === submenu.link }">
	                   {{ submenu.name }}</a>
	                </li>
	            </ul>
	        </li>
		</ul>
	</nav>
</template>
<script>
	export default{

		data(){
			return{
				menuName: '',
				subMenuName: '',
				test: true,
				menus:[
					{	
						id: 'home',
						name: 'Home',
						subMenu:[ 
							{ name: 'Sosial Media', link: '/admin/home/sosmed' },
							{ name: 'Image Slider', link: '/admin/home/image-slider' }
						]
					},
					{
						id: 'about',
						name: 'About',
						subMenu:[
							{ name: 'Profile', link: '/admin/about/profile' },
							{ name: 'Clasess', link: '/admin/about/class' },
							{ name: 'Gallery Showcase', link: '/admin/about/showcase' },
						]
					},
					{
						id: 'gallery',
						name: 'Gallery',
						subMenu:[
							{ name:'Category', link: '/admin/gallery/category' },
							{ name:'Sub Category', link: '/admin/gallery/subcategory' },
							{ name:'Photo List', link: '/admin/gallery/list' },
						]
					},
					{
						id: 'event',
						name: 'Event & Activity List',
						subMenu:[
							{ name:'Category', link: '/admin/event/category' },
							{ name:'Sub Category', link: '/admin/event/subcategory' },
							{ name:'Event & Activity List', link: '/admin/event/list' }
						]
					},
					{
						id: 'shop',
						name: 'Shop',
						subMenu:[
							{ name:'Category', link: '/admin/shop/category' },
							{ name:'Sub Category', link: '/admin/shop/subcategory' },
							{ name:'Item List', link: '/admin/shop/list' }
						]
					},
					{	
						id: 'bookkeeping',
						name: 'Bookkeeping',
						subMenu:[
							{ name:'Member', link: '#' },
							{ name:'Overseas Inquiry List', link: '#' },
							{ name:'Applicant List', link: '#' },
							{ name:'Potential Overseas Inquiry List', link: '#' }
						]
					}
				],
			}
		},

		mounted(){
			this.setName();
		},

		methods:{
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
</style>