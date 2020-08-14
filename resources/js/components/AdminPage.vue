<template>
    <div class="container">
        <div v-if="loading">
            Loading...
        </div>

        <div v-if="error">
            {{ error }}
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                  <td>ID</td>
                  <td>Name</td>
                  <td>Nickname</td>
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
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
       </table>
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
                if (err.res.data.error) {
                    this.error = err.res.data.error.message
                } else {
                    this.error = err.message;
                }
            })
    }
}
</script>
