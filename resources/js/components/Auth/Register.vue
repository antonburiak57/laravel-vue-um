<template>
  <b-container>
    <b-row class="pb-3">
      <b-col lg="6" md="6" sm="6" offset-lg="3" offset-md="3" offset-sm="3">
        <h2>Register</h2>
      </b-col>
    </b-row>

    <b-row>
      <b-col lg="6" md="6" sm="6" offset-lg="3" offset-md="3" offset-sm="3">
        <b-form @submit="onRegister">
          <b-form-group label="First Name" label-for="first_name">
            <b-form-input required id="first_name" type="text" v-model="user.first_name" />
          </b-form-group>

          <b-form-group label="Last Name" label-for="last_name">
            <b-form-input required id="last_name" type="text" v-model="user.last_name" />
          </b-form-group>

          <b-form-group label="Email" label-for="email">
            <b-form-input required id="email" type="email" v-model="user.email" />
          </b-form-group>

          <b-form-group label="Gender" label-for="gender">
            <b-form-input required id="gender" type="text" v-model="user.gender" />
          </b-form-group>

          <b-form-group label="Degree" label-for="degree">
            <b-form-input required id="degree" type="text" v-model="user.degree" />
          </b-form-group>

          <b-form-group label="Street" label-for="street">
            <b-form-input required id="street" type="text" v-model="user.street" />
          </b-form-group>

          <b-form-group label="Street No" label-for="street_no">
            <b-form-input required id="street_no" type="text" v-model="user.street_no" />
          </b-form-group>

          <b-form-group label="Postal Code" label-for="postal_code">
            <b-form-input required id="postal_code" type="text" v-model="user.postal_code" />
          </b-form-group>

          <b-form-group label="City" label-for="city">
            <b-form-input required id="city" type="text" v-model="user.city" />
          </b-form-group>

          <b-form-group label="Password" label-for="password">
            <b-form-input required id="password" type="password" v-model="user.password" />
          </b-form-group>

          <b-form-group label="Confirm Password" label-for="password_confirmation">
            <b-form-input required id="password_confirmation" type="password" v-model="user.password_confirmation" />
          </b-form-group>

          <b-button type="submit" variant="info">Register</b-button>
        </b-form>
      </b-col>
    </b-row>

    <b-row>
      <b-col lg="6" md="6" sm="6" offset-lg="3" offset-md="3" offset-sm="3">
        <h6>Already Registered ?
          <router-link :to="{name: 'Login'}">Click Here&nbsp;</router-link>to Login
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
      user: {
        name: null,
        email: null,
        password: null,
        password_confirmation: null
      }
    }
  },
  methods: {
    ...mapActions('AuthStore', [
      'register'
    ]),
    onRegister (event) {
      event.preventDefault()
      this.register(this.user).then(response => {
        this.$bvToast.toast(response.data.message, {
          title: 'Success',
          variant: 'success',
          solid: true
        })
        // Timeout to Show Toast Message
        setTimeout(() => { this.$router.push({ name: 'Login' }) }, 500)
      })
    }
  }
}
</script>
