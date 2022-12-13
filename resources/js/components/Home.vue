<template>
  <b-container>
    <h1>{{ $t('home.title') }}</h1>
    <template v-if="isLoggedIn">
      <h3>{{ $t('home.greetings', {name: `${user.first_name} ${user.last_name}`}) }}</h3>
    </template>
  </b-container>
</template>
<script>
import { mapGetters } from 'vuex'
export default {
  data () {
    return {}
  },
  computed: {
    ...mapGetters('AuthStore', [
      'user', 'isLoggedIn'
    ])
  },
  created () {
  },
  methods: {
  }
}
</script>
