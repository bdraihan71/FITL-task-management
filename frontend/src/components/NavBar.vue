<template lang="">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="#">Task Manager</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Create Task</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" @click="logout" >Logout</a>
                </li>
            </ul>
        </div>
    </nav>
</template>
<script>
import { logout } from '../apis/authApi.js';
export default {
    methods: {
        async logout() {
            try {
                await logout();
                this.$router.push('/login');
            } catch (error) {
                console.error('Logut error:', error);
            }
        }
    }
}
</script>
<style scoped>
.navbar {
    background-color: #343a40;
    border-bottom: 1px solid #222;
}

.navbar-brand {
    color: #ffffff;
    font-weight: bold;
}

.navbar-toggler-icon {
    background-color: #ffffff;
}

.navbar-nav .nav-link {
    color: #ffffff;
    font-weight: bold;
}

.navbar-nav .nav-link:hover {
    color: #f8f9fa;
}
</style>