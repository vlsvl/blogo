export function useActive() {
  const isActive = (link) => {
    if (route().current(link.route.split('.')[0] + '*')) {
      return true
    }
    return false
  }
  return { isActive }
}
