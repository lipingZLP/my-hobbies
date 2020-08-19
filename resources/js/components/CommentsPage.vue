<template>
    <div class="container">
        <div v-if="loading">
            Loading...
        </div>

        <div v-if="error">
            {{ error }}
        </div>

        <div v-if="commentsData">
            <post-new-comment :hobby_id="hobby_id"></post-new-comment>
            <br>
            <comments-list :comments="commentsData"></comments-list>
        </div>
    </div>
</template>

<script>
export default {
    props: ['hobby_id'],

    data() {
        return {
            loading: true,
            error: null,
            commentsData: null
        }
    },

    mounted() {
        axios.get(`/api/hobbies/${this.$props.hobby_id}/comments`)
            .then(res => {
                this.loading = false;
                this.commentsData = res.data.comments;
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
