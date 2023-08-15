<template lang="">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="login-container">
                    <h2 class="text-center mb-4">Login</h2>
                    <form @submit.prevent="login">
                        <div class="alert alert-danger" v-if="errors.internal_error">
                            <strong>Error!</strong> {{errors.internal_error[0]}}
                        </div>
                        <div class="form-group">
                            <label class="required-label" for="email">Email</label>
                            <input type="text" class="form-control" id="email" v-model="email" placeholder="Enter your email" required>
                            <small v-if="errors.email" class="text-danger">{{ errors.email[0]}}</small>
                        </div>
                        <div class="form-group">
                            <label class="required-label" for="password">Password</label>
                            <input type="password" class="form-control" id="password" v-model="password" placeholder="Enter your password" required>
                            <small v-if="errors.password" class="text-danger">{{ errors.password[0]}}</small>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                        <div class="text-center mt-3">
                            <p>If you don't have an account, <router-link to="/registration">register here</router-link>.</p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { login } from '../../apis/authApi.js';

export default {
    data() {
        return {
            email: '',
            password: '',
            errors: []
        }
    },

    methods: {
        async login() {
            try {
                await login(this.email, this.password)
                this.$router.push('/')
            } catch (error) {
                this.errors = error
                console.error('Login error:', error);
            }
        }
    },
}
</script>
<style scoped>
.login-container {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    background-color: #ffffff;
    border-radius: 5px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    margin-top: 150px;
}

.error-container {
    display: flex;
    align-items: center;
    margin-top: 0.5rem;
}

.error-icon {
    font-size: 1rem;
    margin-right: 0.5rem;
    color: #ff4d4d;
    /* Red color */
}

.error-message {
    color: #ff4d4d;
    /* Red color */
    font-size: 0.875rem;
}
</style>