<template lang="">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="login-container">
                    <h2 class="text-center mb-4">Registration</h2>
                    <form @submit.prevent="signup">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" v-model="name" placeholder="Enter your name">
                            <small v-if="errors.name" class="text-danger">{{ errors.name[0]}}</small>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" v-model="email" placeholder="Enter your email">
                            <small v-if="errors.email" class="text-danger">{{ errors.email[0]}}</small>
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" v-model="password" placeholder="Enter your password">
                            <small v-if="errors.password" class="text-danger">{{ errors.password[0]}}</small>
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" class="form-control" id="password_confirmation" v-model="password_confirmation"  placeholder="Enter your password">
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Registration</button>

                        <div class="text-center mt-3">
                            <p>If you have an account, <router-link to="/login">login here</router-link>.</p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { signup } from '../../apis/authApi.js';
export default {
    data() {
        return {
            name: '',
            email: '',
            password: '',
            password_confirmation: '',
            errors: []
        }
    },

    methods: {
        async signup() {
            try {
                await signup(this.name, this.email, this.password, this.password_confirmation);
                this.$router.push('/');
            } catch (error) {
                this.errors = error
                console.error('Signup error:', error);
            }
        },
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
    margin-top: 100px;
}
</style>