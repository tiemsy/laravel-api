export default {
    data() {
        return {
            editMode: false,
            users: {},
            form: new Form({
                id: '',
                first_name: '',
                name: '',
                email: '',
                password: '',
                api_token: ''
            }),
        }
    },
    methods: {

        editModalWindow(user) {
            this.form.clear();
            this.editMode = true
            this.form.reset();
            $('#addNew').modal('show');
            this.form.fill(user)
        },
        updateUser() {
            this.form.put('api/user/' + this.form.id)
                .then(() => {

                    Toast.fire({
                        icon: 'success',
                        title: 'User updated successfully'
                    })

                    Fire.$emit('AfterCreatedUserLoadIt');

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

        loadUsers(page = 1) {
            if (typeof page === 'undefined') {
                page = 1;
            }
            axios.get("api/user?page=" + page).then(response => (this.users = response.data));
        },

        createUser() {

            this.$Progress.start()

            this.form.post('api/user')
                .then(() => {

                    Fire.$emit('AfterCreatedUserLoadIt'); //custom events

                    Toast.fire({
                        icon: 'success',
                        title: 'User created successfully'
                    })

                    this.$Progress.finish()

                    $('#addNew').modal('hide');

                })
                .catch(() => {
                    console.log("Error......")
                })

            this.loadUsers();
        },
        deleteUser(id) {
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
                    this.form.delete('api/user/' + id)
                        .then((response) => {
                            Swal.fire(
                                'Deleted!',
                                'User deleted successfully',
                                'success'
                            )
                            this.loadUsers();

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
        }
    },

    created() {
        this.loadUsers();

        Fire.$on('AfterCreatedUserLoadIt', () => { //custom events fire on
            this.loadUsers();
        });

    }
}
