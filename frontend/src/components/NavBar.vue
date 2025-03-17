<template>
  <div>
    <nav class="navbar navbar-expand-lg fixed-top">
      <div class="container-fluid">
        <router-link to="/" class="nav-brand">
          <i class="bi bi-book text-success fs-1 mx-5"></i>
        </router-link>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
          aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
          <ul class="navbar-nav mx-5 mb-2 mb-lg-0 nav-underline">
            <li class="nav-item">
              <router-link class="nav-link" to="/">Home</router-link>
            </li>
            <li class="nav-item">
              <router-link to="/about" class="nav-link">About</router-link>
            </li>
            <li class="nav-item dropdown">
              <router-link to="/admission status" class="nav-link">Check Admission Status</router-link>
            </li>
            <li class="nav-item">
              <router-link to="/sundry payment" class="nav-link">Sundry Payment</router-link>
            </li>
            <li class="nav-item">
              <router-link to="/e-bursary" class="nav-link">E-Bursary</router-link>
            </li>
            <li class="nav-item">
              <router-link to="/e-transcript" class="nav-link">E-Transcript</router-link>
            </li>
          </ul>
        </div>
        <div v-if="isLoggedIn">
          <div class="dropdown">
            <button class="btn btn-success dropdown-toggle" type="button" id="profileDropdown" data-bs-toggle="dropdown">
              <i class="bi bi-person-circle"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><h6 class="dropdown-header">{{ user?.full_name }}</h6></li>
              <li>
                <router-link to="/profile" class="dropdown-item">Update Profile</router-link>
              </li>
              <li>
                <button class="dropdown-item" @click="logout">Logout</button>
              </li>
            </ul>
          </div>
        </div>
        <div v-else>
          <router-link to="/login" class="btn btn-success me-4">Login</router-link>
        </div>
      </div>
    </nav>
  </div>
</template>

<script>
import { useAuthStore } from '@/stores/authStore'
import { computed } from 'vue'

export default {
  setup() {
    const authStore = useAuthStore()
    authStore.checkAuth()

    return {
      isLoggedIn: computed(() => authStore.isLoggedIn),
      user: computed(() => authStore.getUser),
      logout: () => authStore.logout()
    }
  }
}
</script>

<style scoped>
.navbar {
  background-color: rgba(255, 255, 255, 0.2) !important; 
  backdrop-filter: blur(10px);
}

.nav-link {
  font-weight: 700;
}

.nav-underline {
  color: red !important;
}

.dropdown-toggle::after {
  display: none;
}

.bi-person-circle {
  font-size: 1.5rem;
}

.dropdown-item {
  cursor: pointer;
}

.dropdown-item:hover {
  background-color: #f8f9fa;
}
</style>