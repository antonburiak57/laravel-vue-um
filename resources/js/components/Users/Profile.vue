<template>
  <b-container>
    <b-row>
      <b-col>
        <h2>{{ user.first_name }} {{ user.last_name }}'s Profile</h2>
        <hr>
      </b-col>
    </b-row>

    <b-row>
      <b-col>
        <b-tabs card>
          <b-tab title="Profile">
            <b-form class="mt-2" @submit="onUpdateProfile">
              <b-row>
                <b-col lg="6" md="6" sm="6">
                  <b-form-group label="First Name" label-for="first_name">
                    <b-form-input size="sm" required id="first_name" v-model="userData.first_name" type="text" />
                  </b-form-group>

                  <b-form-group label="Last Name" label-for="last_name" lg="6" md="6" sm="6">
                    <b-form-input placeholder="Last Name" type="text" v-model="userData.last_name" />
                  </b-form-group>

                  <b-form-group label="Email" label-for="email">
                    <b-form-input size="sm" disabled required id="email" type="email" :value="userData.email" />
                  </b-form-group>

                  <b-form-group label="Gender" label-for="gender" lg="6" md="6" sm="6">
                    <b-form-input placeholder="Gender" type="text" v-model="userData.gender" />
                  </b-form-group>

                  <b-form-group label="Degree" label-for="degree" lg="6" md="6" sm="6">
                    <b-form-input placeholder="Degree" type="text" v-model="userData.degree" />
                  </b-form-group>

                  <b-form-group label="Street" label-for="street" lg="6" md="6" sm="6">
                    <b-form-input placeholder="Street" type="text" v-model="userData.street" />
                  </b-form-group>

                  <b-form-group label="Street No" label-for="street_no" lg="6" md="6" sm="6">
                    <b-form-input placeholder="Street No" type="text" v-model="userData.street_no" />
                  </b-form-group>

                  <b-form-group label="Postal Code" label-for="postal_code" lg="6" md="6" sm="6">
                    <b-form-input placeholder="Postal Code" type="text" v-model="userData.postal_code" />
                  </b-form-group>

                  <b-form-group label="City" label-for="city" lg="6" md="6" sm="6">
                    <b-form-input placeholder="City" type="text" v-model="userData.city" />
                  </b-form-group>

                  <!-- <b-button type="submit" variant="info">Update</b-button> -->
                </b-col>
              </b-row>
            </b-form>
          </b-tab>
          <b-tab title="Settings">
            <b-form class="mt-2" @submit="onChangePassword">
              <b-row>
                <b-col lg="6" md="6" sm="6">
                  <b-form-group label="Old Password" label-for="old_password">
                    <b-form-input size="sm" type="password" required id="old_password" v-model="passwordData.old_password" />
                  </b-form-group>

                  <b-form-group label="Password" label-for="password">
                    <b-form-input size="sm" required id="password" type="password" v-model="passwordData.password" />
                  </b-form-group>

                  <b-form-group label="Confirm Password" label-for="password_confirmation">
                    <b-form-input size="sm" required id="password_confirmation" type="password" v-model="passwordData.password_confirmation" />
                  </b-form-group>
                  <b-button type="submit" variant="info">Change</b-button>
                </b-col>
              </b-row>
            </b-form>
          </b-tab>
        </b-tabs>
      </b-col>
    </b-row>
  </b-container>
</template>
<script>
import { mapGetters, mapMutations } from 'vuex'
import { User } from '../../services/user'
export default {
  data () {
    return {
      passwordData: {
        old_password: null,
        password: null,
        password_confirmation: null
      },
      userData: {
        first_name: '',
        last_name: '',
        email: '',
        gender: '',
        degree: '',
        street: '',
        street_no: '',
        postal_code: '',
        city: ''
      }
    }
  },
  computed: {
    ...mapGetters('AuthStore', ['user'])
  },
  created () {
    this.userData = {
      first_name: this.user.first_name,
      last_name: this.user.last_name,
      email: this.user.email,
      gender: this.user.gender,
      degree: this.user.degree,
      street: this.user.street,
      street_no: this.user.street_no,
      postal_code: this.user.postal_code,
      city: this.user.city
    }
  },
  methods: {
    ...mapMutations('AuthStore', {
      updateUser: 'UPDATEUSER'
    }),
    onUpdateProfile (event) {
      event.preventDefault()
      User.updateProfile(this.userData).then(response => {
        this.updateUser(response.data.data)
        this.$bvToast.toast(response.data.message, {
          title: 'Success',
          variant: 'success',
          solid: true
        })
        this.redirectToHome()
      })
    },
    onChangePassword (event) {
      event.preventDefault()
      User.changePassword(this.passwordData).then(response => {
        this.$bvToast.toast(response.data.message, {
          title: 'Success',
          variant: 'success',
          solid: true
        })
        this.redirectToHome()
      })
    },
    redirectToHome () {
      this.$router.push({ name: 'Home' })
    }
  }
}
</script>
