<template>
  <main>
    <h2>Welcome, {{ userStore.user.name }}</h2>
    <div id="user_balance">
      <h3>Balance: {{ userStore.user.balance }}</h3>
    </div>
    <RouterLink to="/send-money">Send Money</RouterLink>
    <br />
    <RouterLink to="/transaction-history">View Transaction History</RouterLink>
  </main>
</template>

<script>
import { useUserStore } from '../store/user'
import { RouterLink } from 'vue-router'
export default {
  setup() {
    const userStore = useUserStore()
    return { userStore }
  },
  async mounted() {
    await this.userStore.fetchUser()
  }
}
</script>
