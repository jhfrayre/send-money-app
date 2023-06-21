<template>
  <h2>{{ message }}</h2>
</template>

<script>
import { useUserStore } from '../store/user'
export default {
  props: ['message'],
  data() {
    let message = 'Logging out...'
    return { message }
  },
  async mounted() {
    const userStore = useUserStore()
    const response = await userStore.signOut()
    if (response.status === 200) {
      this.message = 'You have successfully logged out.'
    }
  }
}
</script>
