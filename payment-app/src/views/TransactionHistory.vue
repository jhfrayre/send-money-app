<template>
  <table id="TransactionHisory_tbl">
    <thead>
      <tr>
        <th>Description</th>
        <th>Amount</th>
        <th>Balance</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="transaction in transactionHistory">
        <td>{{ transaction.description }}</td>
        <td>{{ transaction.amount }}</td>
        <td>{{ transaction.ending_balance }}</td>
      </tr>
    </tbody>
  </table>
</template>

<script>
import { useUserStore } from '../store/user'

export default {
  data() {
    return {
      transactionHistory: []
    }
  },
  async created() {
    const userStore = useUserStore()
    const token = userStore.token
    await this.getTransactionData(token)
  },
  methods: {
    async getTransactionData(token) {
      const res = await fetch(import.meta.env.VITE_PAYMENT_SERVICE_API + '/transaction-history', {
        method: 'GET',
        headers: {
          Authorization: 'Bearer ' + token,
          'Content-Type': 'application/json'
        }
      })
      const response = await res.json()
      this.transactionHistory = response.transactions
    }
  }
}
</script>
