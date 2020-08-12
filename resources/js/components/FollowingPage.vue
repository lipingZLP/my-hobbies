<template>
    <div class="container">
        <div>
            {{user.name}}
        </div>
        <p>@{{user.nickname}} is following:</p>
        <div class="row">
            <div class="card-body">
                <div class="col">
                    <div v-for="(following, i) in followingList" :key="i">
                        <div class="row">
                            <img :src="$store.getters.getProfileLink(following)" class="rounded-circle" width="30" height="30" />
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
            user: null,
            followingList: null
        }
    },

    mounted() {
        axios.get(`/api/users/${this.$props.user_id}/following`)
            .then(res => {
                this.user = res.data.user;
                this.followingList = res.data.following;
            })

    }
}
</script>
