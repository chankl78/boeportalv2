<template>
  <q-page padding>
    <div class="q-pa-md q-gutter-sm row">
      <q-card class="actions col-xs-12 col-md-4 col-lg-3">
        <img :src="user.avatar">
        <q-list>
          <q-item clickable @click="handleRemoveAvatar">
            <q-item-section avatar>
              <q-icon color="negative" name="delete"/>
            </q-item-section>
            <q-item-section>
              <q-item-label>Remove profile picture</q-item-label>
            </q-item-section>
          </q-item>

          <q-item clickable @click="handleUploadOpen">
            <q-item-section avatar>
              <q-icon color="primary" name="add_a_photo"/>
            </q-item-section>

            <q-item-section>
              <q-item-label>Change profile picture</q-item-label>
              <q-item-label caption>Only jpg, jpeg, png</q-item-label>
            </q-item-section>
          </q-item>

          <q-item clickable @click="$router.push({name: 'changePassword'})">
            <q-item-section avatar>
              <q-icon color="amber" name="build"/>
            </q-item-section>

            <q-item-section>
              <q-item-label>Change password</q-item-label>
            </q-item-section>
          </q-item>

          <q-item clickable @click="$router.push({name: 'changeInfo'})">
            <q-item-section avatar>
              <q-icon color="amber" name="cached"/>
            </q-item-section>

            <q-item-section>
              <q-item-label>Request info change</q-item-label>
              <q-item-label caption>Fill feedback form</q-item-label>
            </q-item-section>
          </q-item>
        </q-list>
      </q-card>

      <DialogBox
        :dialogOpen="avatarDialogOpen"
        title="Change profile picture"
        @hide="handleUploadOpen"
      >
        <q-uploader
          :url="`http://localhost:8000/api/profile/avatar/${id}`"
          :headers="[{name: 'Authorization', value: getToken()}]"
          method="PUT"
          label="Only jpg or png"
          accept=".jpg, .png, image/*"
          style="max-width: 300px"
          @uploaded="fetchUser1"
        />
      </DialogBox>
      <List :items="member" title="Member info" class="col-xs-12 col-md-4 col-lg-8"/>
    </div>
  </q-page>
</template>

<script>
import { createNamespacedHelpers } from 'vuex'
import DialogBox from '../../../components/common/DialogBox'
import List from '../../../components/common/List'

const { mapState, mapActions } = createNamespacedHelpers('profile/actions')
export default {
  name: 'Profile',
  components: {
    DialogBox,
    List
  },
  data() {
    return {
      avatarDialogOpen: false
    }
  },
  computed: {
    ...mapState(['member', 'user']),
    id() {
      return this.user.id
    },
    user() {
      return this.$store.state.user
    }
  },
  methods: {
    ...mapActions(['fetchUser', 'fetchMember', 'removeAvatar']),
    getToken() {
      return localStorage.getItem('token')
    },
    async handleRemoveAvatar() {
      try {
        await this.removeAvatar(this.id)
        this.$q.notify({
          type: 'positive',
          message: 'Profile picture was successfully removed!'
        })
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
    },
    handleUploadOpen() {
      this.avatarDialogOpen = !this.avatarDialogOpen
    },
    async fetchUser1() {
      await this.fetchUser(this.id)
    },
    async fetchMember1() {
      await this.fetchMember(this.id)
    }
  },
  async created() {
    this.fetchUser1()
    this.fetchMember1()
  }
}
</script>

<style lang="stylus" scoped>
.q-avatar:hover .avatar {
  cursor: pointer;
  filter: brightness(50%);
}

.q-avatar:hover span.avatar-actions {
  display: block;
}

.avatar-actions {
  position: absolute;
  color: #fff;
  font-size: 0.4em;
  margin: 0 auto;
  z-index: 1;
  display: none;
  cursor: pointer;
  user-select: none;
}
</style>
