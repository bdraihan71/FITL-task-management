<template lang="">
    <div class="modal fade" id="createFormModal" tabindex="-1" role="dialog" aria-labelledby="createFormModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createFormModalLabel">{{ !isEditMode? 'View' : isEditing ? 'Update' : 'Create' }} Task</h5>
                    <button type="button" ref="closeButton" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
               
                <div class="modal-body">
                    <div id="app" v-if="!isEditMode && !onlyView" class="d-flex justify-content-center align-items-center">
                        <button class="btn btn-primary" @click="editMode">Click To Edit</button>
                    </div>
    
                    <form @submit.prevent="submitTaskForm">
                        <div class="alert alert-danger" v-if="errors.internal_error">
                            <strong>Error!</strong> {{errors.internal_error[0]}}
                        </div>

                        <div class="form-group">
                            <label class="required-label" for="title">Title</label>
                            <input type="text" class="form-control" id="title" v-model="form.title" placeholder="Enter title"  :readonly="!isEditMode">
                            <small v-if="errors.title" class="text-danger">{{ errors.title[0]}}</small>
                        </div>
    
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" rows="3" v-model="form.description" placeholder="Enter description"  :readonly="!isEditMode"></textarea>
                        </div>
    
                        <div class="form-group" v-if="!isEditMode || isEditing">
                            <label for="status">Status:</label>
                            <select class="form-control" id="status" v-model="form.status" :readonly="!isEditMode">
                                <option v-for="option in dropdownOptions" :value="option.value" :key="option.value">{{ option.label }}</option>
                            </select>
                        </div>
    
                        <div class="form-group">
                            <label for="deadline">Deadline</label>
                            <input type="datetime-local" class="form-control" v-model="form.deadline" id="deadline"  :readonly="!isEditMode">
                        </div>
    
                        <div class="form-group search-container position-relative">
                            <label for="created_for">Assign To</label>
                            <input type="text" class="form-control" id="created_for" v-model="form.created_for" placeholder="Enter email" :readonly="!isEditMode" @keyup="searchUser">
                            <small v-if="errors.user_email" class="text-danger">{{ errors.user_email[0]}}</small>
                            <div v-if="showSuggestions" class="search-suggestions">
                                <div v-for="(suggestion, index) in usersEmail" :key="index" class="search-suggestion" @click="selectSuggestion(suggestion)">
                                {{ suggestion }}
                                </div>
                            </div>
                        </div>
    
                        <button v-if="isEditMode && !onlyView" type="submit" class="btn btn-primary">{{ isEditing ? 'Update' : 'Create' }}</button>
    
                    </form>
                </div>
            </div>
        </div>
    </div>
    </template>
<script>
import { createTask, updateTask } from '../../apis/taskApi.js'
import { useTaskStore } from '../../stores/taskStore.js';
export default {
    data() {
        return {
            form: {
                title: '',
                description: null,
                status: null,
                deadline: null,
                created_for: null
            },
            isEditing: true,
            taskId: null,
            isEditMode: false,
            onlyView: false,
            dropdownOptions: [
                { label: "open", value: "open" },
                { label: "in-progress", value: "in-progress" },
                { label: "done", value: "done" }
            ],
            showSuggestions: false,
            errors: []
        }
    },

    computed: {
        status() {
            return useTaskStore().status
        },
        usersEmail() {
            return useTaskStore().usersEmail
        }
    },

    methods: {
        submitTaskForm() {
            if (this.isEditing) {
                this.updateTask()
            } else {
                this.createNewTask()
            }
        },

        async createNewTask() {
            try {
                await createTask(this.form)
                if (this.status == 'success') {
                    this.form.title = ''
                    this.form.description = null
                    this.form.status = null
                    this.form.deadline = null
                    this.form.created_for = null
                    this.$refs.closeButton.click()
                    this.$emit('fetchTasks')
                    this.$router.push('/')
                }

            } catch (error) {
                this.errors = error
                console.error('Task creating error:', error);
            }
        },

        async updateTask() {
            try {
                await updateTask(this.form, this.taskId)
                console.log("hello Raihan");
                this.$refs.closeButton.click()
                this.$emit('fetchTasks')
                this.$router.push('/')
            } catch (error) {
                this.errors = error
                console.error('Task creating error:', error);
            }
        },

        initCreate() {
            this.isEditMode = true
            this.isEditing = false
            this.form.title = ''
            this.form.description = null
            this.form.deadline = useTaskStore().myData.deadline
            this.form.created_for = null
        },

        editData(onlyView) {
            onlyView == 'onlyView' ? this.onlyView = true : this.onlyView = false
            this.isEditMode = false
            this.isEditing = true
            this.taskId = useTaskStore().myData.id
            this.form.title = useTaskStore().myData.title
            this.form.description = useTaskStore().myData.description
            this.form.status = useTaskStore().myData.status
            this.form.deadline = useTaskStore().myData.deadline
            this.form.created_for = useTaskStore().myData.created_for
        },

        editMode() {
            this.isEditMode = !this.isEditMode
        },

        selectSuggestion(suggestion) {
            this.form.created_for = suggestion;
            this.showSuggestions = false;
        },

        async searchUser() {
            const taskStore = useTaskStore()
            const searchData = this.form.created_for
            try {
                await taskStore.userSearchByEmail(searchData)
                this.showSuggestions = true
            } catch (error) {
                this.errors = error
                console.log(this.error)
            }
        }

    },
}
</script>
<style scoped>
select[readonly] {
    pointer-events: none;
}

.search-container {
    position: relative;
}

.search-suggestions {
    position: absolute;
    top: 100%;
    left: 0;
    width: 100%;
    background-color: #fff;
    border: 1px solid #ccc;
    border-top: none;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    max-height: 150px;
    overflow-y: auto;
    z-index: 1000;
    border-radius: 4px;
}

.search-suggestion {
    padding: 10px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.search-suggestion:hover {
    background-color: #f4f4f4;
}

.form-control:focus+.search-suggestions {
    display: block;
}

/* Styling enhancements */
.search-suggestion {
    display: flex;
    align-items: center;
}

.search-suggestion::before {
    content: "\f007";
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    margin-right: 10px;
}

.search-suggestion span {
    flex: 1;
}
</style>
    