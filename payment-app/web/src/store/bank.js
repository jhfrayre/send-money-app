import { defineStore } from 'pinia'
import { useUserStore } from './user'

export const useBankStore = defineStore('bank', {
  state: () => ({
    instapayId: 1,
    pesonetId: 2,
    InstaPay: null,
    PESONet: null
  }),
  actions: {
    async fetchData() {
      const userStore = useUserStore()
      const token = userStore.token
      let res = await fetch(
        import.meta.env.VITE_PAYMENT_SERVICE_API + '/financial-institutions/' + this.instapayId,
        {
          method: 'GET',
          headers: {
            Authorization: 'Bearer ' + token,
            'Content-Type': 'application/json'
          }
        }
      )
      let response = await res.json()
      this.InstaPay = response['financial-institutions']
      res = await fetch(
        import.meta.env.VITE_PAYMENT_SERVICE_API + '/financial-institutions/' + this.pesonetId,
        {
          method: 'GET',
          headers: {
            Authorization: 'Bearer ' + token,
            'Content-Type': 'application/json'
          }
        }
      )
      response = await res.json()
      this.PESONet = response['financial-institutions']
    }
  }
})
