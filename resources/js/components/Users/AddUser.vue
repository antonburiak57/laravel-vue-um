<template>
  <b-container>
    <h1>{{ this.$route.params.id ? $t('users.edit_user') : $t('users.add_new_user') }}</h1>
    <b-row>
      <b-col>
        <b-form @submit="saveUser">
          <b-form-group>
            <b-form-input :placeholder="$t('users.first_name')" type="text" v-model="newUser.first_name" />
          </b-form-group>
          <b-form-group>
            <b-form-input :placeholder="$t('users.last_name')" type="text" v-model="newUser.last_name" />
          </b-form-group>
          <b-form-group>
            <b-form-input :placeholder="$t('users.email')" type="email" v-model="newUser.email" />
          </b-form-group>
          <b-form-group>
            <b-form-select :placeholder="$t('users.gender')" v-model="newUser.gender" :options="gender" />
          </b-form-group>
          <b-form-group>
            <b-form-input :placeholder="$t('users.degree')" type="text" v-model="newUser.degree" />
          </b-form-group>
          <b-form-group>
            <b-form-input :placeholder="$t('users.street')" type="text" v-model="newUser.street" />
          </b-form-group>
          <b-form-group>
            <b-form-input :placeholder="$t('users.street_no')" type="text" v-model="newUser.street_no" />
          </b-form-group>
          <b-form-group>
            <b-form-input :placeholder="$t('users.postal_code')" type="text" v-model="newUser.postal_code" />
          </b-form-group>
          <b-form-group>
            <b-form-input :placeholder="$t('users.city')" type="text" v-model="newUser.city" />
          </b-form-group>
          <b-form-group>
            <b-form-input :placeholder="$t('users.password')" type="password" v-model="newUser.password" />
          </b-form-group>
          <b-form-group>
            <b-form-input :placeholder="$t('users.confirm_password')" type="password" v-model="newUser.password_confirmation" />
          </b-form-group>
          <b-button type="submit" variant="info">{{ $t('users.save') }}</b-button>
          <b-button :to="{ name: 'ListUser' }" variant="outline-warning">{{ $t('users.cancel') }}</b-button>
        </b-form>
      </b-col>
    </b-row>
  </b-container>
</template>
<script>
import { User } from '../../services/user'
import { mapGetters } from 'vuex'
export default {
  data () {
    return {
      newUser: {
        first_name: '',
        last_name: '',
        email: '',
        password: '',
        gender: '',
        degree: '',
        street: '',
        street_no: '',
        postal_code: '',
        city: '',
        password_confirmation: ''
      },
      routeId: null,
      gender: [
        { value: '', text: 'Gender' },
        { value: 'male', text: 'Male' },
        { value: 'female', text: 'Female' }
      ]
    }
  },
  computed: {
    ...mapGetters('AuthStore', [
      'user'
    ])
  },
  created () {
    if (this.user.role !== 1) this.$router.go(-1);

    if (this.$route.params.id) {
      this.routeId = this.$route.params.id
      User.show(this.routeId).then(response => {
        this.newUser = response.data.data
      }).catch(err => {
        this.$router.go(-1);
      })
    }
  },
  methods: {
    saveUser (event) {
      event.preventDefault()
      let promise = new Promise(resolve => {
        if (!this.routeId) {
          User.store(this.newUser).then(response => {
            resolve(response.data)
          })
        } else {
          User.update(this.newUser, this.routeId).then(response => {
            resolve(response.data)
          })
        }
      })
      promise.then(response => {
        this.$bvToast.toast(response.message, {
          title: 'Success',
          variant: 'success',
          solid: true
        })
        this.$router.push({ name: 'ListUser' })
      })
    }
  }
}
</script>
