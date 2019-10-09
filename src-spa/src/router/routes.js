import LoginLayout from '../layouts/LoginLayout'
import MasterLayout from '../layouts/MasterLayout'
import Login from '../pages/Login'
import Error404 from '../pages/Error404'
import Register from '../pages/Register'
import ResetPassword from '../pages/ResetPassword'
import VerifyEmail from '../pages/VerifyEmail'
import NewPassword from '../pages/NewPassword'

import Home from '../pages/dashboard/Home'
import Profile from '../pages/dashboard/profile/Profile'
import Settings from '../pages/dashboard/Settings'

import ChangePassword from '../pages/dashboard/profile/ChangePassword'
import ChangeInfo from '../pages/dashboard/profile/ChangeInfo'

const routes = [
  {
    path: '/login',
    component: LoginLayout,
    children: [
      {
        path: '',
        component: Login
      }
    ]
  },
  {
    path: '/register',
    component: LoginLayout,
    children: [
      {
        path: '',
        component: Register
      }
    ]
  },
  {
    path: '/reset-password',
    component: LoginLayout,
    children: [
      {
        path: '',
        component: ResetPassword
      }
    ]
  },
  {
    path: '/verify-email',
    component: LoginLayout,
    children: [
      {
        path: '',
        component: VerifyEmail
      }
    ]
  },
  {
    path: '/new-password',
    component: LoginLayout,
    children: [
      {
        path: '',
        component: NewPassword
      }
    ]
  },
  {
    path: '/',
    component: MasterLayout,
    children: [
      {
        path: '',
        name: 'home',
        component: Home
      },
      {
        path: '/profile',
        name: 'profile',
        component: Profile
      },
      {
        path: '/settings',
        name: 'settings',
        component: Settings
      },
      {
        path: '/profile/change-password',
        name: 'changePassword',
        component: ChangePassword
      },
      {
        path: '/profile/change-info',
        name: 'changeInfo',
        component: ChangeInfo
      }
    ],
    meta: {
      requiresAuth: true
    }
  }
]

// Always leave this as last one
if (process.env.MODE !== 'ssr') {
  routes.push({
    path: '*',
    component: Error404
  })
}

export default routes
