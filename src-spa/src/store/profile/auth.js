import axios from 'axios'

export default {
  namespaced: true,
  state: {
    oldPassword: '',
    newPassword: '',
    repeatPassword: ''
  },
  mutations: {
    setOldPassword: (state, password) => (state.oldPassword = password),
    setNewPassword: (state, password) => (state.newPassword = password),
    setRepeatPassword: (state, password) => (state.repeatPassword = password),
    resetForm(state) {
      state.oldPassword = ''
      state.newPassword = ''
      state.repeatPassword = ''
    }
  },
  actions: {
    save({ state }) {
      return axios.post('/api/auth/change-password', {
        current_password: state.oldPassword,
        new_password: state.newPassword,
        new_password_confirmation: state.repeatPassword
      })
    }
  }
}
