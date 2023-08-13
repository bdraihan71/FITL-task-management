<template lang="">
<div class="modal fade" id="createFormModal" tabindex="-1" role="dialog" aria-labelledby="createFormModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createFormModalLabel">Create Task</h5>
                <button type="button" ref="closeButton" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form @submit.prevent="submitTaskForm">
                    <div class="form-group">
                        <label class="required-label" for="title">Title</label>
                        <input type="text" class="form-control" id="title" v-model="form.title" placeholder="Enter title" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" rows="3" v-model="form.description" placeholder="Enter description"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="deadline">Deadline</label>
                        <input type="datetime-local" class="form-control" v-model="form.deadline" id="deadline">
                    </div>

                    <div class="form-group">
                        <label for="created_for">Assign To</label>
                        <input type="text" class="form-control" id="created_for" v-model="form.created_for" placeholder="Enter searchable value">
                        <div id="suggestionList" class="suggestion-list"></div>
                    </div>

                    <button type="submit" class="btn btn-primary">Create</button>

                </form>
            </div>
        </div>
    </div>
</div>
</template>
<script>
import { createTask } from '../../apis/taskApi.js'
import { useTaskStore } from '../../stores/taskStore.js';
export default {
    data() {
        return {
            form: {
                title: '',
                description: null,
                deadline: null,
                created_for: null
            },
        }
    },

    computed: {
        status() {
            return useTaskStore().status
        }
    },

    methods: {
        async submitTaskForm() {
            try {
                await createTask(this.form)
                if (this.status == 'success') {
                    this.form.title = ''
                    this.form.description = null
                    this.form.deadline = null
                    this.form.created_for = null
                    this.$refs.closeButton.click()
                    this.$emit('fetchTasks')
                    this.$router.push('/')
                }

            } catch (error) {
                console.error('Task creating error:', error);
            }
        },
    },
}
</script>
<style scoped></style>
