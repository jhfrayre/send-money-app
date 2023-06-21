import { defineStore } from 'pinia'

export const useUserStore = defineStore('user', {
  state: () => ({
    user: null,
    token: null
  }),

  actions: {
    async fetchUser() {
      const res = await fetch(import.meta.env.VITE_PAYMENT_SERVICE_API + '/user', {
        method: 'GET',
        headers: {
          Authorization: 'Bearer ' + this.token,
          'Content-Type': 'application/json'
        }
      })
      const response = await res.json()
      this.user = response.user
    },

    async signIn(username, password) {
      const res = await fetch(import.meta.env.VITE_PAYMENT_SERVICE_API + '/login', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({ username, password })
      })

      const response = await res.json()
      this.user = response.user
      this.token = response.token
    },

    async signOut() {
      const res = await fetch(import.meta.env.VITE_PAYMENT_SERVICE_API + '/logout', {
        method: 'POST',
        headers: {
          Authorization: 'Bearer ' + this.token,
          'Content-Type': 'application/json'
        }
      })
      this.user = null
      this.token = null
      return res
    }
  }
})
