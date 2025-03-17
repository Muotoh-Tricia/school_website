<template>
    <div>
        <div class="text-center">
            <img src="/coou-logo.png" class="img-fluid coou-logo" />
            <h1 class="mt-4 mb-4">Registration Form</h1>
        </div>
        <form @submit.prevent="handleRegister" class="form-div">
            <div class="mb-3">
                <label for="full_name" class="form-label">Full Name</label>
                <input type="text" v-model="full_name" placeholder="Enter your full name" class="form-control" />
                <small v-if="errors.full_name" class="text-danger">{{
                    errors.full_name
                    }}</small>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" v-model="email" placeholder="email@gmail.com" class="form-control" />
                <small v-if="errors.email" class="text-danger">{{
                    errors.email
                    }}</small>
            </div>

            <div class="mb-3">
                <label for="phone_number" class="form-label">Phone Number</label>
                <input type="tel" v-model="phone_number" placeholder="08170941138" class="form-control" />
                <small v-if="errors.phone_number" class="text-danger">{{
                    errors.phone_number
                    }}</small>
            </div>

            <div class="mb-3">
                <label for="department" class="form-label">Department</label>
                <input type="text" v-model="department" placeholder="Computer Science" class="form-control" />
                <small v-if="errors.department" class="text-danger">{{
                    errors.department
                    }}</small>
            </div>

            <div class="mb-3">
                <label for="dob" class="form-label">DOB</label>
                <input type="date" v-model="date_of_birth" class="form-control" />
                <small v-if="errors.date_of_birth" class="text-danger">{{
                    errors.date_of_birth
                    }}</small>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" v-model="password" placeholder="password" class="form-control" />
                <small v-if="errors.password" class="text-danger">{{
                    errors.password
                    }}</small>
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" v-model="password_confirmation" placeholder="Confirm Password"
                    class="form-control" />
                <small v-if="errors.password_confirmation" class="text-danger">{{
                    errors.password_confirmation
                    }}</small>
            </div>

            <div class="mb-3">
                <label class="form-label">Gender</label>
                <select v-model="gender" class="form-select">
                    <option value="" disabled>Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
                <small v-if="errors.gender" class="text-danger">{{
                    errors.gender
                    }}</small>
            </div>

            <div class="mb-5">
                <label class="form-label">UserType</label>
                <select v-model="userTypes_id" class="form-select">
                    <option value="" disabled>Select User</option>
                    <option value="1">Student</option>
                    <option value="2">Staff</option>
                </select>
                <small v-if="errors.userTypes_id" class="text-danger">{{
                    errors.userTypes_id
                    }}</small>
            </div>

            <div v-if="apiError" class="alert alert-danger mb-3">
                {{ apiError }}
            </div>

            <button type="submit" class="btn btn-success fs-5 w-100 p-2 mt-4" :disabled="isLoading">
                <span v-if="isLoading" class="spinner-border spinner-border-sm me-2" role="status"
                    aria-hidden="true"></span>
                Register
            </button>

            <hr class="mb-0 mt-4" />
            <router-link to="/login" class="text-decoration-none text-dark">
                <span class="already-have-acct">Already have an account?</span>
                <span class="text-success"> Login</span>
            </router-link>
        </form>
    </div>
</template>

<script>
import { useAuthStore } from "@/stores/authStore";
import { useToast } from "vue-toastification";

export default {
    data() {
        return {
            full_name: "",
            email: "",
            phone_number: "",
            department: "",
            date_of_birth: "",
            password: "",
            password_confirmation: "",
            gender: "",
            userTypes_id: "",
            errors: {},
            isLoading: false,
            apiError: null,
            authStore: null,
            toast: null,
        };
    },
    created() {
        this.authStore = useAuthStore();
        this.toast = useToast();
    },

    methods: {
        validateFields() {
            this.errors = {};

            if (!this.full_name.trim())
                this.errors.full_name = "Full Name is required.";
            if (!this.email) this.errors.email = "Email is required.";
            else if (!/^\S+@\S+\.\S+$/.test(this.email))
                this.errors.email = "Invalid email format.";

            if (!this.phone_number)
                this.errors.phone_number = "Phone Number is required.";
            else if (!/^\d{11}$/.test(this.phone_number))
                this.errors.phone_number = "Phone Number must be 11 digits.";

            if (!this.department.trim())
                this.errors.department = "Department is required.";
            if (!this.date_of_birth)
                this.errors.date_of_birth = "Date of Birth is required.";

            if (!this.password) this.errors.password = "Password is required.";
            else if (this.password.length < 8)
                this.errors.password = "Password must be at least 8 characters long.";

            if (this.password !== this.password_confirmation)
                this.errors.password_confirmation = "Passwords do not match.";

            if (!this.gender) this.errors.gender = "Gender is required.";
            if (!this.userTypes_id)
                this.errors.userTypes_id = "User type is required.";

            return Object.keys(this.errors).length === 0;
        },

        async handleRegister() {
            this.errors = {};
            this.apiError = null;
            this.isLoading = true;

            if (!this.validateFields()) {
                this.isLoading = false;
                return;
            }

            try {
                const formattedDate = new Date(this.date_of_birth)
                    .toISOString()
                    .split("T")[0];

                const registrationData = {
                    full_name: this.full_name,
                    email: this.email,
                    phone_number: this.phone_number,
                    department: this.department,
                    date_of_birth: formattedDate,
                    password: this.password,
                    password_confirmation: this.password_confirmation,
                    gender: this.gender,
                    userTypes_id: parseInt(this.userTypes_id),
                };

                const response = await this.authStore.register(registrationData);
                this.toast.success("Registration successful!");
                this.resetForm();

                // Log out before redirecting to login
                this.authStore.logout();

                setTimeout(() => {
                    this.$router.push({ path: "/login", query: { registered: "true" } });
                }, 2000);
            } catch (error) {
                if (error.errors) {
                    // Handle validation errors from backend
                    this.errors = error.errors;
                    this.apiError = "Please fix the validation errors.";
                } else {
                    // Handle other errors
                    this.apiError = error.message || "Registration failed. Please try again.";
                }
            } finally {
                this.isLoading = false;
            }
        },

        resetForm() {
            this.full_name = "";
            this.email = "";
            this.phone_number = "";
            this.department = "";
            this.date_of_birth = "";
            this.password = "";
            this.password_confirmation = "";
            this.gender = "";
            this.userTypes_id = "";
            this.errors = {};
            this.apiError = null;
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

.spinner-border {
    width: 1rem;
    height: 1rem;
}

.alert {
    border-radius: 0.25rem;
    padding: 0.75rem 1.25rem;
}
</style>
