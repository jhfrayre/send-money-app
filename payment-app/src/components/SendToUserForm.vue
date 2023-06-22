<template>
  <div id="SendToUser_result">{{ submitResult }}</div>
  <form id="SendToUser_form" @submit.prevent="validate">
    <label>Email</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input id="SendToUser_email" type="email" v-model="email" />
    <div id="SendToUser_email_error" class="error">{{ emailError }}</div>
    <label>Amount</label>&nbsp;&nbsp;&nbsp;
    <input
      id="SendToUser_amount"
      type="number"
      v-model="amount"
      title="Please enter a number with up to two decimal places."
      min="10.00"
      max="100000.00"
      step="0.01"
      placeholder="0.00"
      required
    />
    <div id="SendToUser_amount_error" class="error">{{ amountError }}</div>
    <br />
    <button type="submit">Send</button>
  </form>
</template>

<script>
import { useUserStore } from '../store/user'

export default {
  data() {
    return {
      email: '',
      amount: '0.00',

      emailError: '',
      amountError: '',
      submitResult: '',

      userStore: useUserStore()
    }
  },
  methods: {
    async validate() {
      this.amount = parseFloat(this.amount).toFixed(2)

      const userEmail = this.userStore.user.email
      const userBalance = parseFloat(this.userStore.user.balance)
      this.emailError = ''
      this.amountError = ''
      if (this.email === userEmail) {
        this.emailError = 'This is your email. Please send to another user.'
      }
      if (this.amount > userBalance) {
        this.amountError = 'Amount is greater than your current balance.'
      }

      if (this.emailError.length > 0 || this.amountError.length > 0) {
        return false
      }
      const token = this.userStore.token
      const res = await fetch(
        import.meta.env.VITE_PAYMENT_SERVICE_API + '/user-exists/' + this.email,
        {
          method: 'GET',
          headers: {
            Authorization: 'Bearer ' + token
          }
        }
      )

      if (res.status === 200) {
        this.sendToUser()
      } else {
        this.emailError = 'Email does not belong to a user.'
      }
    },
    async sendToUser() {
      const token = this.userStore.token
      const res = await fetch(import.meta.env.VITE_PAYMENT_SERVICE_API + '/send-money', {
        method: 'POST',
        headers: {
          Authorization: 'Bearer ' + token,
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({ email: this.email, amount: this.amount })
      })
      if (res.status === 200) {
        this.submitResult = 'Success! Please your transaction history.'
        this.userStore.fetchUser()
      } else {
        this.submitResult = 'Oops! Something went wrong.'
      }
    }
  }
}
</script>
