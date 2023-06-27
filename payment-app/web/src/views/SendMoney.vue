<template>
  <div>
    <h3>Balance: {{ userStore.user.balance }}</h3>
    <div>
      <button id="SendToUserBtn" @click="sendToUser = true">Send to user</button>
      &nbsp;&nbsp;&nbsp;
      <button id="BankTransferBtn" @click="sendToUser = false">Bank Transfer</button>
    </div>
    <br />
    <br />
    <div v-if="sendToUser"><SendToUserForm /></div>
    <div v-else><BankTransferForm /></div>
  </div>
</template>

<script>
import BankTransferForm from '../components/BankTransferForm.vue'
import SendToUserForm from '../components/SendToUserForm.vue'
import { useBankStore } from '../store/bank'
import { useUserStore } from '../store/user'
export default {
  data() {
    const userStore = useUserStore()
    const bankStore = useBankStore()
    if (bankStore.InstaPay === null || bankStore.PESONet === null) {
      bankStore.fetchData()
    }
    return {
      sendToUser: true,
      userStore: userStore
    }
  },
  components: {
    BankTransferForm,
    SendToUserForm
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

.pr15 {
  padding-right: 15px;
}
.pr30 {
  padding-right: 30px;
}
.mt10 {
  margin-top: 10px;
}
</style>
