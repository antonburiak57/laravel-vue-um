<template>
  <div class="position-fixed w-100 px-4 py-2 d-flex justify-content-end fixed-bottom bg-secondary">
    <b-form-select placeholder="Language" @change="setLocale" v-model="$i18n.locale" class="w-25">
      <option value="en" >{{ $t('languages.en') }}</option>
      <option value="de" >{{ $t('languages.de') }}</option>
    </b-form-select>
  </div>
</template>
<script>

export default {
  methods: {
    setLocale (lang) {
      this.$i18n.locale = lang;
      this.$i18n.setLocaleMessage(lang, require(`../lang/${lang}.json`));
      localStorage.setItem("lang", lang);
    }
  }
}
</script>
