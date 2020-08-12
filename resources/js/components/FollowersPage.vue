<template>
    <div class="container">
        <div>
            {{user.name}}
        </div>
        <p>@{{user.nickname}} has followers:</p>
        <div class="row">
            <div class="card-body">
                <div class="col">
                    <div v-for="(follower, i) in followersList" :key="i">
                        <div class="row">
                            <img :src="$store.getters.getProfileLink(follower)" class="rounded-circle" width="30" height="30" />
                            <h6>
                                <a :href="`/users/${follower.nickname}`">
                                    {{follower.name}} @{{follower.nickname}}
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
            user: null,
            followersList: null
        }
    },

    mounted() {
        axios.get(`/api/users/${this.$props.user_id}/followers`)
            .then(res => {
                this.user = res.data.user;
                this.followersList = res.data.followers;
            })

    }
}
</script>
