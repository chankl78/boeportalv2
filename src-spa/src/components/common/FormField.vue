<template>
  <div class="form-field-wrapper">
    <div class="feedback-wrapper">
      <label class="label">{{ label }}</label>
    </div>
    <slot>
      <q-input
        outlined
        :type="type"
        :value="value"
        :class="className"
        class="input-field"
        :error="error"
        @input="handleValue"
      />
    </slot>
    <div v-if="error" class="field-error">{{ errorMessage }}</div>
  </div>
</template>

<script>
export default {
  name: 'FormField',
  props: {
    label: {
      type: String,
      required: true
    },
    className: {
      type: Object,
      default: () => {}
    },
    type: {
      type: String,
      default: 'text'
    },
    value: {
      type: String,
      required: true
    },
    error: {
      type: Boolean,
      required: true
    },
    errorMessage: {
      type: String,
      required: true
    }
  },
  data() {
    return {
      inputValue: this.model
    }
  },
  methods: {
    handleValue(value) {
      this.$emit('input', value)
    }
  }
}
</script>

<style lang="stylus" scoped>
.form-field-wrapper {
  padding-bottom: 25px;
  position: relative;
}

.feedback-wrapper {
  margin-bottom: 5px;
}

.field-error {
  position: absolute;
  bottom: 0;
  font-size: 0.75rem;
  color: rgb(219, 40, 40);
  margin-bottom: 10px;
}

>>>.q-field {
  padding-bottom: 5px;
}
</style>
