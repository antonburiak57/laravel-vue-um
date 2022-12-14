<template>
  <b-container class="pb-4 mb-4">
    <b-row>
      <b-col>
        <h2>{{ $t('users.user_profile', {name: `${user.first_name} ${user.last_name}`}) }}</h2>
        <hr>
      </b-col>
    </b-row>

    <b-row>
      <b-col>
        <b-tabs card>
          <b-tab :title="$t('users.profile')">
            <b-form class="mt-2" @submit="onUpdateProfile">
              <b-row>
                <b-col lg="6" md="6" sm="6">
                  <b-form-group :label="$t('users.first_name')" label-for="first_name">
                    <b-form-input size="sm" :placeholder="$t('users.first_name')" required id="first_name" v-model="userData.first_name" type="text" />
                  </b-form-group>

                  <b-form-group :label="$t('users.last_name')" label-for="last_name" lg="6" md="6" sm="6">
                    <b-form-input :placeholder="$t('users.last_name')" type="text" v-model="userData.last_name" />
                  </b-form-group>

                  <b-form-group :label="$t('users.email')" label-for="email">
                    <b-form-input :placeholder="$t('users.email')" size="sm" disabled required id="email" type="email" :value="userData.email" />
                  </b-form-group>

                  <b-form-group :label="$t('users.gender')" label-for="gender" lg="6" md="6" sm="6">
                    <b-form-select :placeholder="$t('users.gender')" v-model="userData.gender" :options="gender" />
                  </b-form-group>

                  <b-form-group :label="$t('users.degree')" label-for="degree" lg="6" md="6" sm="6">
                    <b-form-input :placeholder="$t('users.degree')" type="text" v-model="userData.degree" />
                  </b-form-group>

                  <b-form-group :label="$t('users.street')" label-for="street" lg="6" md="6" sm="6">
                    <b-form-input :placeholder="$t('users.street')" type="text" v-model="userData.street" />
                  </b-form-group>

                  <b-form-group :label="$t('users.street_no')" label-for="street_no" lg="6" md="6" sm="6">
                    <b-form-input :placeholder="$t('users.street_no')" type="text" v-model="userData.street_no" />
                  </b-form-group>

                  <b-form-group :label="$t('users.postal_code')" label-for="postal_code" lg="6" md="6" sm="6">
                    <b-form-input :placeholder="$t('users.postal_code')" type="text" v-model="userData.postal_code" />
                  </b-form-group>

                  <b-form-group :label="$t('users.city')" label-for="city" lg="6" md="6" sm="6">
                    <b-form-input :placeholder="$t('users.city')" type="text" v-model="userData.city" />
                  </b-form-group>

                  <b-button type="submit" variant="info">Update</b-button>
                </b-col>
              </b-row>
            </b-form>
          </b-tab>
          <b-tab :title="$t('users.settings')">
            <b-form class="mt-2" @submit="onChangePassword">
              <b-row>
                <b-col lg="6" md="6" sm="6">
                  <b-form-group :label="$t('users.old_password')" label-for="old_password">
                    <b-form-input :placeholder="$t('users.old_password')" size="sm" type="password" required id="old_password" v-model="passwordData.old_password" />
                  </b-form-group>

                  <b-form-group :label="$t('users.password')" label-for="password">
                    <b-form-input :placeholder="$t('users.password')" size="sm" required id="password" type="password" v-model="passwordData.password" />
                  </b-form-group>

                  <b-form-group :label="$t('users.confirm_password')" label-for="password_confirmation">
                    <b-form-input :placeholder="$t('users.confirm_password')" size="sm" required id="password_confirmation" type="password" v-model="passwordData.password_confirmation" />
                  </b-form-group>
                  <b-button type="submit" variant="info">{{ $t('users.change') }}</b-button>
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
      },
      gender: [
        { value: '', text: 'Gender' },
        { value: 'male', text: 'Male' },
        { value: 'female', text: 'Female' }
      ]
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
