<template>
  <div id="SendToUser_result"></div>
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
      emailError: ''
    }
  },
  async created() {},
  methods: {
    async validate() {
      const amountInput = document.getElementById('SendToUser_amount')
      amountInput.value = parseFloat(amountInput.value).toFixed(2)

      const userStore = useUserStore()
      const token = userStore.token
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
        const errorMsg = 'Email does not belong to a user.'
        this.emailError = errorMsg
      }
    },
    async sendToUser() {
      const userStore = useUserStore()
      const token = userStore.token
      const res = await fetch(import.meta.env.VITE_PAYMENT_SERVICE_API + '/send-money', {
        method: 'POST',
        headers: {
          Authorization: 'Bearer ' + token,
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({ email: this.email, amount: this.amount })
      })
      const resultDiv = document.getElementById('SendToUser_result')
      if (res.status === 200) {
        resultDiv.innerText = 'Success! Check your transacion history.'
      } else {
        resultDiv.innerText = 'Oops! Something went wrong.'
        console.log(response)
      }
    }
  }
}
</script>

<style>
/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type='number'] {
  appearance: textfield;
}
</style>
