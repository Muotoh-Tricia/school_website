import { defineStore } from "pinia";
import axios from "axios";

export const useAuthStore = defineStore("auth", {
  state: () => ({
    isAuthenticated: false,
    user: null,
    token: null,
  }),

  getters: {
    getUser: (state) => state.user,
    getToken: (state) => state.token,
    isLoggedIn: (state) => state.isAuthenticated,
  },

  actions: {
    async register(registrationData) {
      try {
        const response = await axios.post(
          "http://127.0.0.1:8000/api/auth/register",
          registrationData
        );

        this.isAuthenticated = true;
        this.user = response.data.user;
        this.token = response.data.token;

        sessionStorage.setItem("token", response.data.token);
        axios.defaults.headers.common[
          "Authorization"
        ] = `Bearer ${response.data.token}`;

        return response.data; // Return response for handling success messages
      } catch (error) {
        throw error.response?.data || error.message;
      }
    },

    async login(credentials) {
      try {
        const response = await axios.post(
          "http://127.0.0.1:8000/api/auth/login",
          credentials
        );

        if (response.data.user) {
          this.isAuthenticated = true;
          this.user = response.data.user;
          this.token = response.data.token;

          sessionStorage.setItem("token", response.data.token);
          sessionStorage.setItem("user", JSON.stringify(response.data.user));
          axios.defaults.headers.common[
            "Authorization"
          ] = `Bearer ${response.data.token}`;
        }

        return response.data;
      } catch (error) {
        throw error;
      }
    },

    logout() {
      this.isAuthenticated = false;
      this.user = null;
      this.token = null;
      sessionStorage.removeItem("token");
      sessionStorage.removeItem("user");
      delete axios.defaults.headers.common["Authorization"];
    },

    checkAuth() {
      const token = sessionStorage.getItem("token");
      const user = sessionStorage.getItem("user");
      
      if (token && user) {
        this.isAuthenticated = true;
        this.token = token;
        this.user = JSON.parse(user);
        axios.defaults.headers.common["Authorization"] = `Bearer ${token}`;
      } else {
        this.isAuthenticated = false;
        this.user = null;
        this.token = null;
      }
    },
  },
});
