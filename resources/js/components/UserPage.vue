<template>
    <div class="container">
        <div v-if="loading">
            Loading...
        </div>

        <div v-if="error">
            {{ error }}
        </div>

        <div v-if="userInfo">
            <user-info :user="userInfo.user"></user-info>
            <br>
            <hobbies-list :hobbies="userInfo.hobbies"></hobbies-list>
        </div>
    </div>
</template>

<script>
export default {
    props: ['username'],

    data() {
        return {
            loading: true,
            error: null,
            userInfo: null
        }
    },

    mounted() {
        axios.get(`/api/users/${this.username}`)
            .then(res => {
                this.loading = false;
                this.userInfo = res.data;
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
