import axios from 'axios'

export default {
  namespaced: true,
  state: {
    user: {},
    member: {},
    avatar: '',
    form: {
      name: '',
      email: '',
      subject: '',
      content: ''
    }
  },
  mutations: {
    setUser: (state, user) => (state.user = user),
    setMember: (state, member) => (state.member = member),
    setAvatar: (state, avatar) => (state.avatar = avatar),
    setFormName: (state, name) => (state.form.name = name),
    setFormEmail: (state, email) => (state.form.email = email),
    setFormSubject: (state, subject) => (state.form.subject = subject),
    setFormContent: (state, content) => (state.form.content = content),
    resetForm: state => (state.form = {})
  },
  actions: {
    async fetchUser({ commit }, id) {
      const user = await axios
        .get(`/api/profile/user/${id}`)
        .then(res => res.data.data)
      commit('setUser', user)
    },
    async fetchMember({ commit }, id) {
      const member = await axios
        .get(`/api/profile/member/${id}`)
        .then(res => res.data.data)
      commit('setMember', member)
    },
    removeAvatar({ state }, id) {
      return axios.delete(`/api/profile/avatar/${id}`, {})
    }
  }
}
