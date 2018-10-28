<template>

  <div class="col-md-12">

    <div class="col-md-4 col-xs-2">
      <sidebar-menu :menu="menu" />
    </div>

    <div class="col-md-8 col-xs-10" style="margin-top: 20px">
      <h1>CONTENT HERE</h1>
    </div>

  </div>

</template>

<script>
export default {
  name: 'app',
  data() {
    return {
      menu: [
        {
          href: '#',
          title: 'Home',
          icon: 'fa fa-user'
        },

        {
          title: 'About',
          icon: 'fa fa-user',
          child:[
            {
              href: '#',
              title: 'profile'
            },
            {
              href: '#',
              title: 'Galery'
            },
            {
              href: '#',
              title: 'Classess'
            }
          ]
        },

        {
          title: 'Gallery',
          icon: 'fa fa-file',
          child: [
            {
              href: '#',
              title: 'Category',
            },
            {
              href: '#',
              title: 'Sub-Category',
            },
            {
              href: '#',
              title: 'Photo',
            }
          ]
        },

        {
          title: 'Event & Acticity',
          icon: 'fa fa-file',
          child: [
            {
              href: '#',
              title: 'Category',
            },
            {
              href: '#',
              title: 'Sub-Category',
            },
            {
              href: '#',
              title: 'List'
            }
          ]
        },

        {
          title: 'Shop',
          icon: 'fa fa-file',
          child: [
            {
              href: '#',
              title: 'Category',
            },
            {
              href: '#',
              title: 'Sub-Category',
            },
            {
              href: '#',
              title: 'List',
            }
          ]
        },

        {
          title: 'Bookkeping',
          icon: 'fa fa-file',
          child: [
            {
              href: '#',
              title: 'Member',
            },
            {
              href: '#',
              title: 'Shop Overseas Inquiry',
            },
            {
              href: '#',
              title: 'Applicant List',
            },
            {
              href: '#',
              title: 'Potential Shop Overseas Inquiry Lis',
            }
          ]
        },
      ]
    }
  }
};
</script>

<style>

</style>
