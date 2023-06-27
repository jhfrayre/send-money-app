<template>
  <h2>{{ message }}</h2>
</template>

<script>
import { useBankStore } from '../store/bank'
import { useUserStore } from '../store/user'
export default {
  data() {
    let message = 'Logging out...'
    return { message }
  },
  async mounted() {
    const bankStore = useBankStore()
    bankStore.InstaPay = null
    bankStore.PESONet = null

    const userStore = useUserStore()
    const response = await userStore.signOut()
    if (response.status === 200) {
      this.message = 'You have successfully logged out.'
    }
  }
}
</script>
