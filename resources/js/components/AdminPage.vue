<template>
    <div class="container">
        <div v-if="loading">
            Loading...
        </div>

        <div v-if="error">
            {{ error }}
        </div>

        <div v-if="usersList">
            Users list
            <table class="table table-striped">
                <thead>
                    <tr>
                    <td>ID</td>
                    <td>Name</td>
                    <td>Username</td>
                    <td>Email</td>
                    <td>Avatar</td>
                    <td>Is_Admin</td>
                    <td colspan="2">Action</td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in usersList" :key="item.id">
                        <td>{{item.id}}</td>
                        <td>{{item.name}}</td>
                        <td>{{item.nickname}}</td>
                        <td>{{item.email}}</td>
                        <td><img :src="$store.getters.getProfileLink(item)" class="rounded-circle" width="30" height="30" /></td>
                        <td>{{item.is_admin}}</td>
                        <td><a :href="`/admin/users/${item.id}/edit`">Edit</a></td>
                        <td></td>
                    </tr>
                </tbody>
        </table>
       </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            loading: true,
            error: null,
            usersList: null
        }
    },

    mounted() {
        axios.get('/api/admin/users')
            .then(res => {
                this.loading = false;
                this.usersList = res.data.users;
            })
            .catch(err => {
                this.loading = false;
                if (err.response.data.error) {
                    this.error = err.response.data.error.message
                } else {
                    this.error = err.message;
                }
            })
    }
}
</script>
