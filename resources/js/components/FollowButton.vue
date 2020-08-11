<template>
    <div class="container">
        <button v-show="!isFollowed" type="button" class="btn btn-primary btn-sm" @click="follow()">Follow</button>
        <button v-show="isFollowed" type="button" class="btn btn-primary btn-sm" disabled>Followed!</button>
    </div>
</template>

<script>
export default {
    props: ['id'],

    data() {
        return {
            isFollowed: false
        }
    },

    methods: {
        follow() {
            axios.post(`/api/users/${this.id}/follow`, this.formData)
                .then(res => {
                    this.isFollowed = true
                })
                .catch(err => {
                    // if there are any errors, it may mean that user is already followed
                    this.isFollowed = true
                })
        }
    }
}
</script>
