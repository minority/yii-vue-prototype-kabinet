import Vue from 'vue'
import Router from 'vue-router'
import SitesIndex from '@/components/pages/sites/Index'
import DashboardIndex from '@/components/pages/dashboard/Index'
import AnalyticsIndex from '@/components/pages/analytics/Index'
import FaqIndex from '@/components/pages/faq/Index'
import AddSite from '@/components/pages/sites/AddSite'
import EditSite from '@/components/pages/sites/EditSite'
import NotFound from '@/components/pages/error/NotFound'
import Auth from '@/components/pages/user/Auth'

Vue.use(Router)

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'DashboardIndex',
      component: DashboardIndex
    },
    {
      path: '/sites',
      name: 'SitesIndex',
      component: SitesIndex
    },
    {
      path: '/analytics',
      name: 'AnalyticsIndex',
      component: AnalyticsIndex
    },
    {
      path: '/faq',
      name: 'FaqIndex',
      component: FaqIndex
    },
    {
      path: '/sites/add',
      name: 'AddSite',
      component: AddSite
    },
    {
      path: '/sites/edit/:id',
      props: true,
      name: 'EditSite',
      component: EditSite
    },
    {
      path: '*',
      name: '404',
      component: NotFound
    },
    {
      path: '/auth',
      name: 'Auth',
      component: Auth
    }
  ]
})
