<template>
  <q-page padding>
    <div class="q-pa-md q-gutter-sm">
      <p>PROFILE</p>
      <router-link :to="{name: 'changePassword'}">
        <q-btn color="primary" label="Change password"/>
      </router-link>
    </div>
  </q-page>
</template>

<script>
export default {
  // name: 'PageName',
}
</script>
