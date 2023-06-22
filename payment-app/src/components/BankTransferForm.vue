<template>
  <form @submit.prevent="validate">
    <div>
      <div id="BankTransfer_result">{{ submitResult }}</div>
      <label>Amount</label>&nbsp;&nbsp;&nbsp;
      <input
        id="BankTransfer_amount"
        type="number"
        v-model="amount"
        title="Please enter a number with up to two decimal places."
        min="10.00"
        max="100000"
        step="0.01"
        placeholder="0.00"
        required
      />
      <div id="BankTransfer_amount_error" class="error">{{ amountError }}</div>
    </div>

    <div>
      <label for="BankTransfer_payment">Payment Service</label>&nbsp;&nbsp;&nbsp;
      <select
        id="BankTransfer_payment"
        name="payment_system_id"
        v-model="payment_system_id"
        @change="modifyParticipants()"
      >
        <option :value="bankStore.instapayId">InstaPay</option>
        <option :value="bankStore.pesonetId">PESONet</option>
      </select>
    </div>
    <div>
      <label>Bank</label>&nbsp;&nbsp;&nbsp;
      <select
        id="BankTransfer_bank"
        ref="bank"
        name="financial_institution_id"
        v-model="financial_institution_id"
      >
        <option
          v-for="(institution, index) in participants"
          :key="index"
          v-bind:value="institution.financial_institution_id"
        >
          {{ institution.bank_name }}
        </option>
      </select>
    </div>
    <div>
      <label>Account Number</label>&nbsp;&nbsp;&nbsp;
      <input type="text" v-model="account_number" maxlength="19" required />
    </div>
    <div>
      <label>Account Name</label>&nbsp;&nbsp;&nbsp;
      <input type="text" v-model="account_name" maxlength="35" required />
    </div>
    <button type="submit">Send</button>
  </form>
</template>

<script>
import { useBankStore } from '../store/bank'
import { useUserStore } from '../store/user'

export default {
  setup() {
    const bankStore = useBankStore()

    return { bankStore }
  },
  data() {
    return {
      amount: '0.00',
      account_name: '',
      account_number: '',
      financial_institution_id: 0,
      bank_name: '',
      payment_system_id: this.bankStore.instapayId,
      payment_system_name: 'InstaPay',

      participants: this.bankStore.InstaPay,
      amountError: '',
      submitResult: '',

      userStore: useUserStore()
    }
  },
  methods: {
    async validate() {
      let hasErrors = false

      const bankName = this.$refs.bank
      this.bank_name = bankName.options[bankName.selectedIndex].text

      if (this.payment_system_id == this.bankStore.instapayId) {
        this.payment_system_name = 'InstaPay'
      } else if (this.payment_system_id == this.bankStore.pesonetId) {
        this.payment_system_name = 'PESONet'
      }

      this.amount = parseFloat(this.amount).toFixed(2)
      const userBalance = parseFloat(this.userStore.user.balance)
      if (this.amount > userBalance) {
        hasErrors = true
        this.amountError = 'Amount is greater than your current balance.'
      }

      if (hasErrors === false) {
        this.sendToBank()
      }
    },
    async sendToBank() {
      const token = this.userStore.token
      const formData = JSON.stringify({
        amount: this.amount,
        payment_system_id: this.payment_system_id,
        payment_system_name: this.payment_system_name,
        recipient: {
          bank: {
            financial_institution_id: this.financial_institution_id,
            bank_name: this.bank_name,
            account_number: this.account_number,
            account_name: this.account_name
          }
        }
      })
      const res = await fetch(import.meta.env.VITE_PAYMENT_SERVICE_API + '/bank-transfer', {
        method: 'POST',
        headers: {
          Authorization: 'Bearer ' + token,
          'Content-Type': 'application/json'
        },
        body: formData
      })
      if (res.status === 200) {
        this.submitResult = 'Success! Please check your transaction history.'
        this.userStore.fetchUser()
      } else {
        this.submitResult = 'Oops! Something went wrong.'
      }
    },
    modifyParticipants() {
      if (this.payment_system_id == this.bankStore.instapayId) {
        this.participants = this.bankStore.InstaPay
      } else if (this.payment_system_id == this.bankStore.pesonetId) {
        this.participants = this.bankStore.PESONet
      }
    }
  }
}
</script>
