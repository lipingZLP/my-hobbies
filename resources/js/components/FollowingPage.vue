<template>
    <div class="container">
        <div v-if="loading">
            Loading...
        </div>

        <div v-if="error">
            {{ error }}
        </div>

        <div v-if="user">
            <div>
                <user-info :user="user" :small="true"></user-info>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-9">
                    <br>
                    <h4>Following:</h4><br>

                    <div v-for="(following, i) in followingList" :key="i">
                        <div class="row">
                            <img :src="$store.getters.getProfileLink(following)" class="rounded-circle image-keep-ratio" width="50" height="50" />
                            <h6>
                                <a :href="`/users/${following.nickname}`">
                                    {{following.name}} @{{following.nickname}}
                                </a>
                            </h6>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['user_id'],

    data() {
        return {
            loading: true,
            error: null,
            user: null,
            followingList: null
        }
    },

    mounted() {
        axios.get(`/api/users/${this.$props.user_id}/following`)
            .then(res => {
                this.loading = false
                this.user = res.data.user
                this.followingList = res.data.following
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
