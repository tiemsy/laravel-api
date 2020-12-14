export default {
    data() {
        return {
            users: {},
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
            this.$Progress.start();
            this.fetchUserList();

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
                .catch((e) => {
                    var attr = document.getElementById("text");

                    console.log(attr)
                })
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
                            this.loadTasks(1);

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

        fetchUserList() {
            axios.get("api/user").then(response => (this.users = response.data));
        },
    },

    mounted() {
        this.fetchUserList();
    },

    created() {
        this.loadTasks(1);

        Fire.$on('AfterCreatedTaskLoadIt', () => { //custom events fire on
            this.loadTasks(1);
        });
    }
}
