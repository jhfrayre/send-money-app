<template>
  <form @submit.prevent="sendToBank">
    <label>Payment Service</label>&nbsp;&nbsp;&nbsp;
    <select name="payment_system_id">
      <option value="1">InstaPay</option>
      <option value="2">PESONet</option>
    </select>
    <br />
    <label>Amount</label>&nbsp;&nbsp;&nbsp;
    <input type="number" v-model="amount" />
    <br />
    <button type="submit">Send</button>
  </form>
</template>

<script>
export default {
  methods: {
    async sendMoney() {
      console.log('Send money!')
    }
  }
}
</script>
