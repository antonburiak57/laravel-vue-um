<template>
  <b-navbar toggleable="md" type="dark" class="mb-5" variant="info">
    <b-navbar-toggle target="nav_collapse" />
    <b-navbar-brand :to="{ name: 'Home' }">{{ $t('nav.title') }}</b-navbar-brand>
    <b-collapse is-nav id="nav_collapse">
      <b-navbar-nav class="ml-auto">
        <template v-if="!isLoggedIn">
          <b-nav-item :to="{name: 'Login'}">{{ $t('nav.login') }}</b-nav-item>
        </template>
        <template v-else>
          <b-nav-item :to="{ name: 'ListUser' }">{{ $t('nav.user_management') }}</b-nav-item>
          <b-nav-item-dropdown right>
            <template slot="button-content">{{ user.first_name }} {{ user.last_name }}</template>
            <b-dropdown-item :to="{ name: 'Profile' }">{{ $t('nav.profile') }}</b-dropdown-item>
            <b-dropdown-item @click="onLogout()" href="javascript:void(0);">{{ $t('nav.logout') }}</b-dropdown-item>
          </b-nav-item-dropdown>
        </template>
      </b-navbar-nav>
    </b-collapse>
  </b-navbar>
</template>
<script>
import { mapGetters, mapActions } from 'vuex'
export default {
  data () {
    return {
      collapsed: false
    }
  },
  computed: {
    ...mapGetters('AuthStore', [
      'user', 'isLoggedIn'
    ])
  },
  methods: {
    ...mapActions('AuthStore', [
      'logout'
    ]),
    toggleNavbar () {
      this.collapsed = !this.collapsed
    },
    currentRoute (name) {
      return this.$route.name === name
    },
    onLogout () {
      this.logout().then(response => {
        this.$bvToast.toast(response.data.message, {
          title: 'Success',
          variant: 'success',
          solid: true
        })
        this.$router.push({ name: 'Login' })
      })
    }
  }
}
</script>
