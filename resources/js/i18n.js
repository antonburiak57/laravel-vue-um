import Vue from 'vue';
import VueI18n from 'vue-i18n';

Vue.use(VueI18n);

const i18n = new VueI18n({
    locale: "en",
});

export const languages = {
    "en": "English",
    "de": "Deutsch"
}

export default {
    i18n
}