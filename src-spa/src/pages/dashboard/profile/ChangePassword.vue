<template>
  <q-page padding>
    <div class="q-pa-md q-gutter-sm">
      <div class="fields">
        <FormField
          v-model="oldPass"
          label="Old Password"
          :error="$v.oldPass.$error"
          error-message="Old password is required"
          type="password"
        />
        <FormField
          v-model="newPass"
          label="New Password"
          :error="$v.newPass.$error"
          error-message="Password length should be at least 8 characters"
          type="password"
        />
        <FormField
          v-model="repeatPass"
          label="Repeat Password"
          :error="$v.repeatPass.$error"
          error-message="Passwords should match"
          type="password"
        />
        <div class="button-wrapper">
          <q-btn
            label="Back"
            color="primary"
            class="float-left"
            @click="$router.push({name: 'profile'})"
          />
        </div>
        <div class="button-wrapper">
          <q-btn
            label="Submit"
            :disable="$v.$invalid"
            color="primary"
            data-testid="submit-button"
            class="float-right"
            @click="changePassword"
          />
        </div>
      </div>
      <q-inner-loading :visible="loading"/>
    </div>
  </q-page>
</template>

<script>
import { createNamespacedHelpers } from 'vuex'
import { required, minLength, sameAs } from 'vuelidate/lib/validators'
import FormField from '../../../components/common/FormField'

const {
  mapState: mapSettingsState,
  mapActions: mapSettingsActions,
  mapMutations: mapSettingsMutations
} = createNamespacedHelpers('profile/auth')

export default {
  name: 'ChangePassword',
  components: { FormField },
  validations: {
    oldPass: { required },
    newPass: { required, minLength: minLength(8) },
    repeatPass: { required, sameAs: sameAs('newPassword') }
  },
  data() {
    return { loading: false }
  },
  computed: {
    ...mapSettingsState(['oldPassword', 'newPassword', 'repeatPassword']),
    oldPass: {
      get() {
        return this.oldPassword
      },
      set(val) {
        this.$v.oldPass.$touch()
        this.setOldPassword(val)
      }
    },
    newPass: {
      get() {
        return this.newPassword
      },
      set(val) {
        this.$v.newPass.$touch()
        this.setNewPassword(val)
      }
    },
    repeatPass: {
      get() {
        return this.repeatPassword
      },
      set(val) {
        this.$v.repeatPass.$touch()
        this.setRepeatPassword(val)
      }
    }
  },
  created() {
    this.resetForm()
  },
  methods: {
    ...mapSettingsActions(['save']),
    ...mapSettingsMutations([
      'resetForm',
      'setOldPassword',
      'setNewPassword',
      'setRepeatPassword'
    ]),
    async changePassword() {
      try {
        this.loading = true

        await this.save()

        this.$q.notify({
          type: 'positive',
          message: 'Password successfully changed!'
        })

        this.resetForm()
        this.$v.$reset()
      } catch (err) {
        const errors =
          err.response && err.response.data && err.response.data.errors
        console.log(err)
        this.$q.notify({
          color: 'negative',
          position: 'top',
          message: errors || 'Something went wrong',
          icon: 'report_problem'
        })
      }

      this.loading = false
    }
  }
}
</script>

<style lang="stylus" scoped>
</style>
