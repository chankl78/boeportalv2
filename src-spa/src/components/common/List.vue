<template>
  <div class="wrapper">
    <q-toolbar v-show="title" class="bg-primary text-white shadow-2">
      <q-toolbar-title>{{title}}</q-toolbar-title>
    </q-toolbar>
    <q-list bordered separator>
      <q-item v-ripple v-for="item in Object.entries(items)" :key="item[0]">
        <q-item-section>
          <q-item-label overline>{{item[0]}}</q-item-label>
          <q-item-label>{{item[1] || 'None'}}</q-item-label>
        </q-item-section>
      </q-item>
    </q-list>
  </div>
</template>

<script>
export default {
  name: 'List',
  props: {
    items: {
      type: Object,
      required: true
    },
    title: {
      type: String,
      default: ''
    },
    className: {
      type: String,
      default: ''
    }
  }
}
</script>

<style lang="stylus" scoped>
.wrapper {
  border-radius: 4px;
}
</style>
