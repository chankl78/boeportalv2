<template>
  <q-dialog v-model="isOpen">
    <q-card>
      <q-card-section class="row items-center" v-show="title">
        <div class="text-h6">{{title}}</div>
        <q-space/>
        <q-btn icon="close" flat round dense v-close-popup/>
      </q-card-section>

      <q-card-section>
        <slot/>
      </q-card-section>
    </q-card>
  </q-dialog>
</template>

<script>
export default {
  name: 'DialogBox',
  props: {
    dialogOpen: {
      type: Boolean,
      required: true
    },
    title: {
      type: String,
      default: ''
    }
  },
  computed: {
    isOpen: {
      get() {
        return this.dialogOpen
      },
      set() {
        this.$emit('hide')
      }
    }
  }
}
</script>

<style>
</style>
