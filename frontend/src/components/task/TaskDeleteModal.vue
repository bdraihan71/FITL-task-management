<template lang="">
<div class="modal fade" id="deleteTaskModal" tabindex="-1" role="dialog" aria-labelledby="deleteTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Deletion</h5>
                <button type="button" ref="closeButton" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" v-if="errors.internal_error">
                    <strong>Error!</strong> {{errors.internal_error[0]}}
                </div>
                Are you sure you want to delete this task?<br> 
                Title: <mark> {{ task ? task.title : ''}} </mark>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" @click="deleteTask">Delete</button>
            </div>
        </div>
    </div>
</div>
</template>
<script>
import { useTaskStore } from '../../stores/taskStore.js';
export default {
    props:{
        task : Object
    },
    data() {
        return {
            errors:[]
        }
    },
    methods: {
        async deleteTask() {
            const taskStore = useTaskStore();
            try {
                await taskStore.deleteTask(this.task.id)
                this.$refs.closeButton.click()
                this.$emit('fetchTasks')
                this.$router.push('/')
            } catch (error) {
                this.errors = error
                console.log(error);
            }
        }
    }
}
</script>
<style scoped></style>
