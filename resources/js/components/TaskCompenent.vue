<template id="task-compenent">
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tasks Table</h3>

                        <div class="card-tools">
                            <button class="btn btn-success" data-toggle="modal" data-target="#addNew"
                                    @click="openModalWindow">Add New <i class="fas fa-tasks fa-fw"></i></button>
                        </div>
                    </div>

                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>User</th>
                                <th>Registered At</th>
                                <th>Modify</th>
                            </tr>


                            <tr v-for="task in tasks['tasks']">
                                <td>{{ task.id }}</td>
                                <td>{{ task.name }}</td>
                                <td>
                                    {{ task.description | truncate(50, '...') }}
                                </td>
                                <td v-if="task.status == 0">
                                    Close
                                </td>
                                <td v-else="task.status == 0">
                                    Open
                                </td>
                                <td>{{ task.user_id }}</td>
                                <td>{{ task.created_at | formatDate }}</td>

                                <td>
                                    <a href="#" data-id="task.id" @click="editModalWindow(task)">
                                        <i class="fa fa-edit blue"></i>
                                    </a>
                                    |
                                    <a href="#" @click="deleteTask(task.id)">
                                        <i class="fa fa-trash red"></i>
                                    </a>

                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer">
                        <pagination :data="tasks">
                            <span slot="prev-nav">&lt; Previous</span>
                            <span slot="next-nav">Next &gt;</span>
                        </pagination>
                    </div>
                </div>

            </div>
        </div>

        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">

                        <h5 v-show="!editMode" class="modal-title" id="addNewLabel">Add New Task</h5>
                        <h5 v-show="editMode" class="modal-title" id="addNewLabel">Update Task</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form @submit.prevent="editMode ? updateTask() : createTask()">
                        <div class="modal-body">

                            <div class="form-group">
                                <input v-model="form.name" type="text" name="name"
                                       placeholder="Name"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                                <has-error :form="form" field="name"></has-error>
                            </div>

                            <div class="form-group">
                                <textarea class="form-control" v-model="form.description" name="description" :class="{ 'is-invalid': form.errors.has('description') }" placeholder="Description"></textarea>
                                
                                <has-error :form="form" field="description"></has-error>
                            </div>

                            <div class="form-group">

                                <select v-model="form.status" name="status" id="status" class="form-control" >
                                    <option value="1">Open</option>
                                    <option value="0">Close</option>
                                </select>
                                <has-error :form="form" field="status"></has-error>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button v-show="editMode" type="submit" class="btn btn-primary">Update</button>
                            <button v-show="!editMode" type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</template>

<script>
import UserCompenent from "./UserCompenent";

export default {
    data() {
        return {
            users : {},
            editMode: false,
            tasks: {},
            form: new Form({
                id: '',
                name: '',
                description: '',
                status: '',
                user_id: ''
            })
        }
    },

current_page: 1,
    from: 1,
    last_page: 1,
    next_page_url: null,
    per_page: 5,
    prev_page_url: null,
    to: 1,
    total: 0,
    mounted() {
        // Fetch initial results
        this.loadTasks();
    },

    methods: {

        editModalWindow(task) {
            this.form.clear();
            this.editMode = true
            this.form.reset();
            $('#addNew').modal('show');
            this.form.fill(task)
        },
        updateTask() {
            this.form.put('api/task/' + this.form.id)
                .then(() => {

                    Toast.fire({
                        icon: 'success',
                        title: 'Task updated successfully'
                    })

                    Fire.$emit('AfterCreatedTaskLoadIt');

                    $('#addNew').modal('hide');
                })
                .catch(() => {
                    console.log("Error.....")
                })
        },
        openModalWindow() {
            this.editMode = false
            this.form.reset();
            $('#addNew').modal('show');
        },

        loadTasks(page = 1) {
            if (typeof page === 'undefined') {
                page = 1;
            }
            axios.get("api/task?page=" + page).then(response => (this.tasks = response.data));


            //pick data from controller and push it into tasks object

        },

        createTask() {

            this.$Progress.start()

            this.form.post('api/task')
                .then(() => {

                    Fire.$emit('AfterCreatedTaskLoadIt'); //custom events

                    Toast.fire({
                        icon: 'success',
                        title: 'Task created successfully'
                    })

                    this.$Progress.finish()

                    $('#addNew').modal('hide');

                })
                .catch(() => {
                    console.log("Error......")
                })


            this.loadTasks();
        },
        deleteTask(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {

                if (result.value) {
                    //Send Request to server
                    this.form.delete('api/task/' + id)
                        .then((response) => {
                            Swal.fire(
                                'Deleted!',
                                'Task deleted successfully',
                                'success'
                            )
                            this.loadTasks();

                        }).catch(() => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                            footer: '<a href>Why do I have this issue?</a>'
                        })
                    })
                }

            })
        },
        mounted() {

            try {
                let getUsers = axios.get('api/user')
                getUsers.data.forEach(element => this.users.push(element))
                console.log(this.users);
            }
            catch(error) {
                console.log(error)
            }
        }
    },

    created() {
        this.loadTasks();

        Fire.$on('AfterCreatedTaskLoadIt', () => { //custom events fire on
            this.loadTasks();
        });

    }
}
</script>
