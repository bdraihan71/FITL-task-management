<template lang="">
<NavBar/>
<div class="container">
    <div class="row mt-3 no-gutters">
        <div class="col-md-4">
            <div class="task-column open-column">
                <h3 class="column-heading">Open</h3>
                <ul class="list-group">
                    <button type="button" class="btn btn-primary btn btn-primary mb-2" data-toggle="modal" data-target="#createFormModal" @click="initCreateTask">
                        Create Task
                    </button>
                    <li class="list-group-item" v-for="task in filteredTasks('open')" :key="task.id">{{ task.title }}
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <span class="mr-3">Deadline: {{ task.deadline }}</span>
                            <span>
                                <a href="#" class="fas fa-edit mr-3 text-info fa-lg" @click="editTask(task)" data-toggle="modal" data-target="#createFormModal"></a>
                                <a href="#" class="fas fa-trash-alt text-danger fa-lg" @click="deleteTask(task)"></a>
                            </span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-md-4">
            <div class="task-column in-progress-column">
                <h3 class="column-heading">In-Progress</h3>
                <ul class="list-group">
                    <li class="list-group-item" v-for="task in filteredTasks('in-progress')" :key="task.id">{{ task.title }}
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <span class="mr-3">Deadline: {{ task.deadline }}</span>
                            <span>
                                <a href="#" class="fas fa-edit mr-3 text-info fa-lg" @click="editTask(task)" data-toggle="modal" data-target="#createFormModal"></a>
                            </span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-md-4">
            <div class="task-column done-column">
                <h3 class="column-heading">Done</h3>
                <ul class="list-group">
                    <li class="list-group-item" v-for="task in filteredTasks('done')" :key="task.id">{{ task.title }}
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <span class="mr-3">Deadline: {{ task.deadline }}</span>
                            <span>
                                <a href="#" class="fas fa-edit mr-3 text-info fa-lg" @click="editTask(task)" data-toggle="modal" data-target="#createFormModal"></a>
                                <a href="#" class="fas fa-trash-alt text-danger fa-lg" @click="deleteTask(task)"></a>
                            </span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<TaskCreateModal id="createFormModal" @fetchTasks="fetchTasks" ref="childRef">

</TaskCreateModal>
</template>
<script>
import NavBar from '../../components/NavBar.vue'
import TaskCreateModal from '../../components/task/TaskCreateModal.vue'
import { useTaskStore } from '../../stores/taskStore.js';
export default {
    components: {
        NavBar, TaskCreateModal
    },
    data() {
        return {
            tasks: [],
        }
    },

    created() {
        this.fetchTasks()
    },

    computed: {
        filteredTasks() {
            return status => this.tasks.filter(task => task.status === status)
        },
    },

    methods: {
        async fetchTasks() {
            const taskStore = useTaskStore();
            try {
                await taskStore.fetchTasks();
                this.tasks = taskStore.tasks;
            } catch (error) {
                console.log(this.error)
            }
        },

        async deleteTask(task) {
            const taskStore = useTaskStore();
            try {
                await taskStore.deleteTask(task.id);
                this.tasks = taskStore.tasks
            } catch (error) {
                console.log(this.error)
            }
        },

        initCreateTask() {
            if (this.$refs.childRef) {
                    this.$refs.childRef.initCreate(); // Calling the child function
                }
        },
        editTask(task) {
            const taskStore = useTaskStore();
            try {
                taskStore.passingTaskValue(task);
                if (this.$refs.childRef) {
                    this.$refs.childRef.editData(); // Calling the child function
                }
            } catch (error) {
                console.log(this.error)
            }
        }

    },
}
</script>
<style scoped>
.task-column {
    background-color: #f5f5f5;
    border-radius: 5px;
    padding: 15px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    margin: 5px;
}

.column-heading {
    font-size: 20px;
    text-align: center;
    margin-bottom: 10px;
    color: #007bff;
    padding: 5px;
    border-radius: 5px;
    background-color: darkslategrey;
    padding: 15px;
    color: white;
}

.list-group-item {
    border: none;
    border-radius: 5px;
    margin-bottom: 8px;
    padding: 10px;
    background-color: #ffffff;
    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s, box-shadow 0.3s;
}

.list-group-item:hover {
    transform: translateY(-5px);
    box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.2);
}
</style>