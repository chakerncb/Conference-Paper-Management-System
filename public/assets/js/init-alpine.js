function getThemeFromLocalStorage() {
  // if user already changed the theme, use it
  if (window.localStorage.getItem('dark')) {
    return JSON.parse(window.localStorage.getItem('dark'))
  }

  // else return their preferences
  return (
    !!window.matchMedia &&
    window.matchMedia('(prefers-color-scheme: dark)').matches
  )
}

function setThemeToLocalStorage(value) {
  window.localStorage.setItem('dark', value)
}

function data() {
  console.log('Alpine data function called');
  return {
    dark: getThemeFromLocalStorage(),
    toggleTheme() {
      console.log('toggleTheme called');
      this.dark = !this.dark
      setThemeToLocalStorage(this.dark)
    },
    isSideMenuOpen: false,
    toggleSideMenu() {
      console.log('toggleSideMenu called');
      this.isSideMenuOpen = !this.isSideMenuOpen
    },
    closeSideMenu() {
      this.isSideMenuOpen = false
    },
    isNotificationsMenuOpen: false,
    toggleNotificationsMenu() {
      console.log('toggleNotificationsMenu called');
      this.isNotificationsMenuOpen = !this.isNotificationsMenuOpen
    },
    closeNotificationsMenu() {
      this.isNotificationsMenuOpen = false
    },
    isProfileMenuOpen: false,
    toggleProfileMenu() {
      console.log('toggleProfileMenu called');
      this.isProfileMenuOpen = !this.isProfileMenuOpen
    },
    closeProfileMenu() {
      this.isProfileMenuOpen = false
    },
    isPagesMenuOpen: false,
    togglePagesMenu() {
      this.isPagesMenuOpen = !this.isPagesMenuOpen
    },
    // Modal
    isModalOpen: false,
    trapCleanup: null,
    openModal() {
      this.isModalOpen = true
      this.trapCleanup = focusTrap(document.querySelector('#modal'))
    },
    closeModal() {
      this.isModalOpen = false
      this.trapCleanup()
    },
  }
}

console.log('init-alpine.js loaded');
