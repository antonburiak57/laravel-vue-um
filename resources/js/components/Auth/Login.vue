<template>
  <b-container>
    <b-row>
      <b-col lg="6" md="6" sm="6" offset-lg="3" offset-md="3" offset-sm="3">
        <h2>{{ $t('login.title') }}</h2>
      </b-col>
    </b-row>

    <b-row>
      <b-col lg="6" md="6" sm="6" offset-lg="3" offset-md="3" offset-sm="3">
        <b-form @submit="onLogin">
          <b-form-group label="Email" label-for="email">
            <b-form-input required id="email" type="email" v-model="credentials.email"/>
          </b-form-group>

          <b-form-group label="Password" label-for="password">
            <b-form-input required id="password" type="password" v-model="credentials.password"/>
          </b-form-group>

          <b-button type="submit" variant="info">{{ $t('login.btn') }}</b-button>
        </b-form>
      </b-col>
    </b-row>

    <b-row>
      <b-col lg="6" md="6" sm="6" offset-lg="3" offset-md="3" offset-sm="3">
        <h6>
          <router-link :to="{ name: 'ForgotPassword' }">{{ $t('login.forgot_password') }}</router-link>
        </h6>
        <h6>{{ $t('login.not_registered') }}
          <router-link :to="{name: 'Register'}">{{ $t('login.click_here') }}&nbsp;</router-link>{{ $t('login.to_register') }}
        </h6>
      </b-col>
    </b-row>
  </b-container>
</template>
<script>
import { mapActions } from 'vuex'
export default {
  data () {
    return {
      credentials: {
        email: null,
        password: null
      }
    }
  },
  created () {
  },
  methods: {
    ...mapActions('AuthStore', [
      'login'
    ]),
    onLogin (event) {
      event.preventDefault()
      this.login(this.credentials).then(response => {
        this.$router.push({ name: 'Home' })
      })
    }
  }
}
</script>
