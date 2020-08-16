<template>
    <div class="container">
        <div v-if="loading">
            Loading...
        </div>

        <div v-if="error">
            {{ error }}
        </div>

        <div v-if="userData">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">

                            <div v-if="formError" class="alert alert-danger" role="alert">
                                {{ formError }}
                            </div>

                            <label for="name">Name: </label>
                            <input type="text" id="name" class="form-control"
                                   v-model="userData.name">
                            <br>
                            <label for="nickname">Username: </label>
                            <input type="text" id="nickname" class="form-control"
                                    v-model="userData.nickname">
                            <br>
                            <label for="email">Email: </label>
                            <input type="email" id="email" class="form-control"
                                    v-model="userData.email">
                            <br>
                            <label for="password">Password: </label>
                            <input type="password" id="password" class="form-control"
                                    v-model="userData.password">
                            <br>
                            <label for="avatar">Avatar: </label>
                            <input type="text" id="avatar" class="form-control"
                                   v-model="userData.avatar">
                            <br>
                            <label for="is_admin">Is admin: </label>

                            <div class="form-group row">
                                <div class="col-lg">
                                    <input type="radio" id="is_admin" v-bind:value="true"
                                           v-model="userData.is_admin">
                                    <label for="is_admin">Yes</label>
                                    <input type="radio" id="not_admin" v-bind:value="false"
                                           v-model="userData.is_admin">
                                    <label for="not_admin">No</label>
                                </div>
                            </div>
                            <br>
                            <button class="btn btn-primary" @click.prevent="submitted">Submit!
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props:['id'],

    data() {
        return {
            loading: true,
            error: null,
            formError: null,
            userData: null
        }
    },

    methods: {
        submitted() {
            axios.put(`/api/admin/users/${this.$props.id}/edit`, this.userData)
                .then(res => {
                    this.loading = false
                    window.location.replace("/admin/users")
                })
                .catch(err => {
                    this.loading = false
                    if (err.response.data.error) {
                        this.formError = err.response.data.error.message
                    } else {
                        this.formError = err.message
                    }

                    // Scroll to the top to see errors
                    window.scrollTo(0, 0);
                })
        }
    },

    mounted() {
        axios.get(`/api/admin/users/${this.$props.id}`)
            .then(res => {
                this.loading = false
                this.userData = res.data
            })
            .catch(err => {
                this.loading = false
                if (err.response.data.error) {
                    this.error = err.response.data.error.message
                } else {
                    this.error = err.message
                }
            })
    }
}
</script>
