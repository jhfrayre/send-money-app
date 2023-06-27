<script>
import { useUserStore } from '../store/user'
export default {
  setup() {
    const userStore = useUserStore()
    return { userStore }
  }
}
</script>

<template>
  <div class="about">
    <h3>
      Welcome to the Payment App. This connects to the Payment Service API which runs in Laravel.
    </h3>
  </div>
</template>

<style>
@media (min-width: 1024px) {
  .about {
    min-height: 100vh;
    display: flex;
    align-items: center;
  }
}
</style>
