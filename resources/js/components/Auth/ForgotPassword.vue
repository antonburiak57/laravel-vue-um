<template>
  <b-container>
    <b-row>
      <b-col lg="6" md="6" sm="6" offset-lg="3" offset-md="3" offset-sm="3">
        <h2>{{ $t('forgot_password.title') }}</h2>
      </b-col>
    </b-row>

    <b-row>
      <b-col lg="6" md="6" sm="6" offset-lg="3" offset-md="3" offset-sm="3">
        <b-form @submit="onForgot">
          <b-form-group label="Registered Email Id" label-for="email">
            <b-form-input id="email" type="email" v-model="forgotPassword.email" />
          </b-form-group>

          <b-button type="submit" variant="info">{{ $t('forgot_password.btn') }}</b-button>
        </b-form>
      </b-col>
    </b-row>

    <b-row>
      <b-col lg="6" md="6" sm="6" offset-lg="3" offset-md="3" offset-sm="3">
        <h6>
          <router-link :to="{name: 'Login'}">&laquo; {{ $t('forgot_password.back_to') }}</router-link>
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
      forgotPassword: {
        email: null
      }
    }
  },
  methods: {
    ...mapActions('AuthStore', [
      'sendResetPasswordLink'
    ]),
    onForgot (event) {
      event.preventDefault()
      this.sendResetPasswordLink(this.forgotPassword).then(response => {
        this.forgotPassword.email = null
        this.$bvToast.toast(response.data.message, {
          title: 'Success',
          variant: 'success',
          solid: true
        })
      })
    }
  }
}
</script>
