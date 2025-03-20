<template>
    <div>
        <div class="text-center m-5">
            <img src="/coou-logo.png" class="img-fluid coou-logo" />
        </div>

        <div>
            <ul class="nav nav-underline justify-content-center">
                <li class="nav-item">
                    <router-link to="/allSundry" class="nav-link" active-class="active">
                        All Sundry
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/transcriptApp" class="nav-link" active-class="active">
                        Transcript App
                    </router-link>
                </li>
            </ul>
        </div>

        <div class="p-5 row g-3">
            <hr>
            <h5>Sundry Fee Collections</h5>
            <hr>

            <!-- Fee Category -->
            <div class="col-md-6 d-flex align-items-center gap-3">
                <label class="form-label fw-bold flex-label">Fee Category</label>
                <v-select v-model="selectedCategory" :options="filteredCategories" :filterable="false"
                    placeholder="Select a category" @search="onSearch" class="flex-input">
                    <template #no-options>
                        <span class="no-options-message">No matching category found</span>
                    </template>
                </v-select>
            </div>

            <!-- Reg No -->
            <div class="col-md-6 d-flex align-items-center gap-3">
                <label class="form-label fw-bold flex-label">Reg No</label>
                <input type="text" class="form-control flex-input">
            </div>

            <hr>

            <!-- Button -->
            <div class="col-12 d-flex">
                <button class="btn btn-lg btn-primary ms-auto">Next</button>
            </div>
            <hr>
        </div>
    </div>
</template>


<script>
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";

export default {
    components: { vSelect },
    data() {
        return {
            selectedCategory: null,
            categories: [
                "Student Related Payment",
                "Contractor Payment",
                "Library Fee",
                "Hostel Fee",
                "Exam Fee"
            ],
            filteredCategories: [],
        };
    },
    methods: {
        onSearch(searchTerm) {
            if (!searchTerm) {
                this.filteredCategories = this.categories;
                return;
            }

            const results = this.categories.filter(category =>
                category.toLowerCase().includes(searchTerm.toLowerCase())
            );

            if (results.length === 0) {
                this.filteredCategories = [];
            } else {
                this.filteredCategories = results;
            }
        }
    },
    mounted() {
        this.filteredCategories = this.categories;
    }
};
</script>

<style scoped>
.coou-logo {
    width: 15%;
    margin: 5.5% 0 0 0;
}

.nav {
    margin: 50px;
}

.nav-link {
    color: black;
    font-weight: 700;
    transition: color 0.3s ease-in-out;
}

.nav-link:hover {
    color: var(--bs-primary) !important;
    font-weight: 700;
}

.active {
    color: var(--bs-primary) !important;
    font-weight: 700;
}

.custom-select {
    width: 100%;
    font-size: 16px;
}

.no-options-message {
    color: red;
    font-size: 14px;
    padding: 8px;
    display: block;
    text-align: center;
}

.flex-label {
    width: 30%;
}

.flex-input {
    flex-grow: 1;
}
</style>
