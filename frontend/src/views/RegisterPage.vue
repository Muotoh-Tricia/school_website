<template>
    <div>
        <div class="text-center">
            <img src="/coou-logo.png" class="img-fluid coou-logo" />
            <h1 class="mt-4 mb-4">Registration Form</h1>
        </div>
        <form @submit.prevent="handleRegister" class="form-div">
            <div class="mb-3">
                <label for="full_name" class="form-label">Full Name</label>
                <input type="text" v-model="full_name" placeholder="Enter your full name" class="form-control"
                    required />
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" v-model="email" placeholder="email@gmail.com" class="form-control" required />
            </div>
            <div class="mb-3">
                <label for="phone_number" class="form-label">Phone Number</label>
                <input type="tel" v-model="phone_number" placeholder="08170941138" class="form-control" required />
            </div>
            <div class="mb-3">
                <label for="department" class="form-label">Department</label>
                <input type="text" v-model="department" placeholder="Computer Science" class="form-control" required />
            </div>
            <div class="mb-3">
                <label for="level" class="form-label">Level</label>
                <input type="text" v-model="level" placeholder="100" class="form-control" required />
            </div>
            <div class="mb-3">
                <label for="dob" class="form-label">DOB</label>
                <input type="date" v-model="date_of_birth" class="form-control" required />
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" v-model="password" placeholder="password" class="form-control" required />
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" v-model="password_confirmation" placeholder="Confirm Password"
                    class="form-control" required />
            </div>
            <div class="mb-3">
                <label class="form-label">Gender</label>
                <select v-model="gender" class="form-select" required>
                    <option value="" disabled>Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">other</option>
                </select>
            </div>
            <div class="mb-5">
                <label class="form-label">Role</label>
                <select v-model="role" class="form-select" required>
                    <option value="" disabled>Select Role</option>
                    <option value="student">Student</option>
                    <option value="staff">Staff</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success fs-5 w-100 p-2 mt-4">
                Register
            </button>
            <hr class="mb-0 mt-4" />
            <router-link to="/login" class="text-decoration-none text-dark">
                <span class="already-have-acct">Already have an account?</span><span class="text-success"> Login</span>
            </router-link>
        </form>
    </div>
</template>

<script>
import axios from "axios";
import { useToast } from "vue-toastification";

export default {
    setup() {
        const toast = useToast();
        return { toast };
    },
    data() {
        return {
            full_name: "",
            email: "",
            phone_number: "",
            department: "",
            level: "",
            date_of_birth: "",
            password: "",
            password_confirmation: "",
            gender: "",
            role: "",
            error: null,
            isLoading: false,
        };
    },

    methods: {
        async handleRegister() {
            this.error = null;
            this.isLoading = true;

            // Validate password confirmation
            if (this.password !== this.password_confirmation) {
                this.error = "Passwords do not match";
                this.isLoading = false;
                return;
            }

            try {
                // Get CSRF cookie first (required for Sanctum)
                await axios.get("/sanctum/csrf-cookie");

                // Format date of birth
                const formattedDate = new Date(this.date_of_birth)
                    .toISOString()
                    .split("T")[0];

                // Attempt registration
                const response = await axios.post(
                    "http://127.0.0.1:8000/api/auth/register",
                    {
                        full_name: this.full_name,
                        email: this.email,
                        phone_number: this.phone_number,
                        department: this.department,
                        level: this.level,
                        date_of_birth: formattedDate,
                        password: this.password,
                        password_confirmation: this.password_confirmation,
                        gender: this.gender,
                        role: this.role,
                    }
                );
                this.toast.success(response?.data?.message);

                // Redirect to login with success message
                setTimeout(() => {
                    this.$router.push({ path: "/login", query: { registered: "true" } });
                }, 2000);
            } catch (err) {
                console.error(err);
                this.error =
                    err.response?.data?.message ||
                    "An unexpected error occurred during registration";
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
    height: 50%;
}

.coou-logo {
    width: 15%;
    margin: 5.5% 0 0 0;
}

form {
    width: 60%;
    max-height: 500px;
    background-color: rgb(255, 255, 255);
    padding: 50px;
    margin: 0 auto 4% auto;
    border-radius: 10px;
    box-shadow: 0 0 1px;
    overflow-y: auto;
}

form:hover {
    transform: translateY(8px);
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}

.already-have-acct {
    margin: 0 0 0 71%;
}

@keyframes blinkColor {
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

h1 {
    animation: blinkColor 4s infinite ease-in-out;
}
</style>
