import VueRouter from 'vue-router'
import Vue from 'vue'
import Home from '../components/Home'
import ListUser from '../components/Users/ListUser'
import AddUser from '../components/Users/AddUser'
import Login from '../components/Auth/Login'
import NotFound from '../components/404'
import Register from '../components/Auth/Register'
import ResetPassword from '../components/Auth/ResetPassword'
import ForgotPassword from '../components/Auth/ForgotPassword'
import Profile from '../components/Users/Profile'
import { AuthGuard } from '../middleware/auth'
import { GuestGuard } from '../middleware/guest'

Vue.use(VueRouter)

const routes = new VueRouter({
    routes: [
        {
            path: '/',
            name: 'Home',
            component: Home,
            meta: {
                title: 'Home'
            }
        }, {
            path: '/user',
            name: 'ListUser',
            component: ListUser,
            beforeEnter: AuthGuard,
            meta: {
                title: 'All Users'
            }
        }, {
            path: '/users/add',
            name: 'AddUser',
            component: AddUser,
            beforeEnter: AuthGuard,
            meta: {
                title: 'Add New User'
            }
        }, {
            path: '/users/:id',
            name: 'EditUser',
            component: AddUser,
            beforeEnter: AuthGuard,
            meta: {
                title: 'Edit User'
            }
        }, {
            path: '/profile',
            name: 'Profile',
            component: Profile,
            beforeEnter: AuthGuard,
            meta: {
                title: 'User Profile'
            }
        }, {
            path: '/login',
            name: 'Login',
            component: Login,
            beforeEnter: GuestGuard,
            meta: {
                title: 'Login'
            }
        }, {
            path: '/register',
            name: 'Register',
            component: Register,
            beforeEnter: GuestGuard,
            meta: {
                title: 'Register'
            }
        }, {
            path: '/forgot',
            name: 'ForgotPassword',
            component: ForgotPassword,
            beforeEnter: GuestGuard,
            meta: {
                title: 'Forgot Password'
            }
        }, {
            path: '/reset/:token',
            name: 'ResetPassword',
            component: ResetPassword,
            beforeEnter: GuestGuard,
            meta: {
                title: 'Reset Password'
            }
        }, {
            path: '*',
            name: 'NotFound',
            component: NotFound
        }
    ],
    mode: 'history'
})

routes.beforeEach((to, from, next) => {
    document.title = to.meta.title ? to.meta.title : 'Untitled'
    next()
})

export default routes
