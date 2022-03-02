import { usePage } from '@inertiajs/inertia-vue3'
export const translation = {
  methods: {
    __(key, replace = {}) {
      let translation = usePage().props.value.translation[key] || key
      Object.keys(replace).forEach(function (key) {
        translation = translation.replace(':' + key, replace[key])
      })
      return translation
    },
  },
}
