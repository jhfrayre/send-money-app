<template>
  <table id="TransactionHisory_tbl">
    <thead>
      <tr>
        <th>Date and Time</th>
        <th>Description</th>
        <th>Amount</th>
        <th>Balance</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(transaction, index) in transactionHistory" :key="index">
        <td>{{ transaction.date_time }}</td>
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
      let transactionHistory = response.transactions
      response.transactions.forEach(function (currentValue, index) {
        let datetimeString = currentValue.created_at
        let [dateString, timeString] = datetimeString.split(' ')
        let [year, month, day] = dateString.split('-')
        let [hour, minute, second] = timeString.split(':')

        let utcTimestamp = Date.UTC(year, month - 1, day, hour, minute, second)
        let datetime = new Date(utcTimestamp)
        transactionHistory[index]['date_time'] = datetime.toLocaleString()
      })
      this.transactionHistory = transactionHistory
    }
  }
}
</script>
