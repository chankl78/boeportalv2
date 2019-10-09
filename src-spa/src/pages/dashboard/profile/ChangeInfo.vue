  <template>
  <q-page padding>
    <div class="q-pa-md q-gutter-sm row justify-center items-center">
      <div class="fields col-lg-5 col-xs-12 col-sm-8">
        <FormField
          v-model="name"
          label="Name"
          :error="$v.name.$error"
          error-message="Name is required"
          type="text"
        />
        <FormField
          v-model="email"
          label="Email"
          :error="$v.email.$error"
          error-message="Email should be correct"
          type="email"
        />
        <FormField
          v-model="subject"
          label="Subject"
          :error="$v.subject.$error"
          error-message="Subject too short"
          type="text"
        />
        <FormField
          v-model="content"
          label="Content"
          :error="$v.content.$error"
          error-message="Content too short"
          type="textarea"
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
            @click="submitInfoChanges"
          />
        </div>
      </div>
      <q-inner-loading :visible="loading"/>
    </div>
  </q-page>
</template>

<script>
import { createNamespacedHelpers } from 'vuex'
import { required, minLength, email } from 'vuelidate/lib/validators'
import FormField from '../../../components/common/FormField'

const { mapState, mapActions, mapMutations } = createNamespacedHelpers(
  'profile/actions'
)

export default {
  name: 'ChangeInfo',
  data() {
    return {
      loading: false
    }
  },
  components: {
    FormField
  },
  validations: {
    name: { required },
    email: { required, email },
    subject: { required, minLength: minLength(4) },
    content: { required, minLength: minLength(10) }
  },
  computed: {
    ...mapState(['form']),
    name: {
      get() {
        return this.form.name
      },
      set(val) {
        this.$v.name.$touch()
        this.setFormName(val)
      }
    },
    email: {
      get() {
        return this.form.email
      },
      set(val) {
        this.$v.email.$touch()
        this.setFormEmail(val)
      }
    },
    subject: {
      get() {
        return this.form.subject
      },
      set(val) {
        this.$v.subject.$touch()
        this.setFormSubject(val)
      }
    },
    content: {
      get() {
        return this.form.content
      },
      set(val) {
        this.$v.content.$touch()
        this.setFormContent(val)
      }
    }
  },
  methods: {
    ...mapMutations([
      'resetForm',
      'setFormName',
      'setFormEmail',
      'setFormSubject',
      'setFormContent'
    ]),
    submitInfoChanges() {
      this.loading = true
      console.log('privet')
      this.resetForm()
      this.loading = false
    }
  }
}
</script>

<style>
</style>
