import { useUserStore } from '../store/user'

export function isAuthenticated() {
  const userStore = useUserStore()
  let isAuthenticated = false
  if (
    userStore.user !== null &&
    typeof userStore.user.name === 'string' &&
    typeof userStore.token === 'string'
  ) {
    isAuthenticated = true
  }
  return isAuthenticated
}
