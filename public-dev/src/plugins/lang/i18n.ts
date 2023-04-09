
import {createI18n} from 'vue-i18n'
import {locale as en} from './../../core/config/i18n/en'
import {locale as fa} from './../../core/config/i18n/es'

const defLang='en';

const messages = {
    'en': en,
    'fa': fa
}


const userlangs = (navigator.languages === undefined
    ? [navigator.language]
    : navigator.languages).map(locale => {
  const trimmedLocale = locale.trim();
  return trimmedLocale.split(/-|_/)[0];
}).reduce((_r: string[],_v: string)=>((_r).includes(_v)?_r:_r.push(_v)&&_r) as string[],[]);


const lang=userlangs.find(_v=>Object.keys(messages).includes(_v))

export const i18n = createI18n({
    legacy: false,
    locale: lang||defLang,
    fallbackLocale: defLang,
    messages,
})

// export default i18n
