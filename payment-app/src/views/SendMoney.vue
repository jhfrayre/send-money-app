<template>
  <div>
    <div>
      <button id="SendToUserBtn" @click="sendToUser = true">Send to user</button>
      &nbsp;&nbsp;&nbsp;
      <button id="BankTransferBtn" @click="sendToUser = false">Bank Transfer</button>
    </div>
    <br />
    <br />
    <br />
    <div v-if="sendToUser"><SendToUserForm /></div>
    <div v-else><BankTransferForm /></div>
  </div>
</template>

<script>
import BankTransferForm from '../components/BankTransferForm.vue'
import SendToUserForm from '../components/SendToUserForm.vue'
export default {
  data() {
    return {
      sendToUser: true
    }
  },
  components: {
    BankTransferForm,
    SendToUserForm
  }
}
</script>
