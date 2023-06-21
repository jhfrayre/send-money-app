<template>
  <form @submit.prevent="login">
    <label>Email</label>
    <br />
    <input type="text" v-model="username" />
    <br />
    <label>Password</label>
    <br />
    <input type="password" v-model="password" />
    <br />
    <br />
    <button type="submit">Login</button>
  </form>
</template>

<script>
import { useUserStore } from '../store/user'
export default {
  setup() {
    const userStore = useUserStore()
    return { userStore }
  },
  data() {
    return {
      username: '',
      password: ''
    }
  },
  methods: {
    async login() {
      await this.userStore.signIn(this.username, this.password)
      this.$router.push('/')
    }
  }
}
</script>
