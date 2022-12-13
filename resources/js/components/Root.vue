<template>
  <div class="app">
    <navbar />
    <router-view />
    <Footer />
  </div>
</template>
<script>
import Navbar from './Navbar'
import Footer from './Footer'
import { mapGetters } from 'vuex'
export default {
  data() {
    return {
      defaultLanguage: "en"
    }
  },
  beforeMount() {
    let lang = !!localStorage.getItem("lang") ?
      localStorage.getItem("lang") :
      this.defaultLanguage;

    this.$i18n.locale = lang;
    this.$i18n.setLocaleMessage(lang, require(`../lang/${lang}.json`));
  },
  components: {
    Navbar,
    Footer
  },
  computed: {
    ...mapGetters('AuthStore', ['user']),
    ...mapGetters('MiscStore', ['error'])
  },
  watch: {
    error (error) {
      let response = error.response
      let message = response.data.message
      if (response.status === 401) {
        this.$store.commit('AuthStore/UNSETUSER')
        this.$router.push({ name: 'Login' })
      } else if (response.status === 422) {
        let firstKey = Object.keys(response.data.data)[0]
        message = response.data.data[firstKey][0]
      }
      this.$bvToast.toast(message, {
        title: 'Error',
        variant: 'danger',
        solid: true
      })
    }
  }
}
</script>
