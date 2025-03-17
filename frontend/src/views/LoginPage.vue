<template>
  <div class="d-flex">
    <div class="row w-100">
      <div class="col-5">
        <img src="/login-img.jpg" class="img-fluid my-5" />
      </div>

      <div class="col-7 form-div">
        <form @submit.prevent="handleLogin">
          <div class="text-center">
            <img src="/coou-logo.png" class="coou-logo mb-4" />
            <h3>Welcome to COOU</h3>
            <p>Access your portal</p>
          </div>

          <!-- Error Message -->
          <div v-if="error" class="alert alert-danger mb-3">
            {{ error }}
          </div>

          <label for="email" class="form-label">Email</label>
          <input
            type="email"
            id="email"
            v-model="email"
            class="form-control"
            placeholder="Enter Email"
            required
          />

          <label for="password" class="form-label">Password</label>
          <input
            type="password"
            id="password"
            v-model="password"
            class="form-control"
            placeholder="Enter Password"
            required
          />

          <p class="text-end mt-1">Forgot Password?</p>
          <hr />
          <div class="d-flex justify-content-between">
            <div>
              New Student?
              <router-link to="/register" class="text-decoration-none">
                <span class="text-success"> create account </span>
              </router-link>
            </div>
            <div>
              <button
                type="submit"
                class="btn btn-success"
                :disabled="isLoading"
              >
                {{ isLoading ? "Logging in..." : "Login" }}
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import { useAuthStore } from "@/stores/authStore";
import { useToast } from "vue-toastification";

export default {
  data() {
    return {
      email: "",
      password: "",
      isLoading: false,
      error: null,
    };
  },
  setup() {
    const toast = useToast();
    const authStore = useAuthStore();

    return { toast, authStore };
  },
  methods: {
    async handleLogin() {
      this.isLoading = true;
      this.error = null;

      try {
        await this.authStore.login({ email: this.email, password: this.password });
        this.toast.success("Login successful!");
        this.$router.push("/");
      } catch (err) {
        this.error = err.response?.data?.message || "Login failed!";
        this.toast.error(this.error);
      } finally {
        this.isLoading = false;
      }
    },
  },
};
</script>


<style scoped>
.form-div {
  background-color: rgb(250, 251, 252);
  line-height: 35px;
}

form {
  width: 70%;
  background-color: rgb(255, 255, 255);
  padding: 50px;
  margin: 15% auto;
  border-radius: 10px;
  box-shadow: 0 0 1px;
}

form:hover {
  transform: translateY(8px);
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}

.coou-logo {
  width: 25%;
}

@keyframes blink {
  0% {
    opacity: 1;
    color: green;
  }

  25% {
    opacity: 0.8;
    color: white;
  }

  50% {
    opacity: 0.6;
    color: green;
  }

  75% {
    opacity: 0.8;
    color: white;
  }

  100% {
    opacity: 1;
    color: green;
  }
}

h3 {
  animation: blink 2s infinite ease-in-out;
}

.alert-danger {
  margin-bottom: 15px;
}
</style>
