<template>
    <div class="container">
        <div v-if="loading">
            Loading...
        </div>

        <div v-if="error">
            {{ error }}
        </div>

        <div v-if="latest">
            <post-new-hobby></post-new-hobby>

            <br>
            <hobbies-list :hobbies="latest.hobbies"></hobbies-list>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            loading: true,
            error: null,
            latest: null
        }
    },

    mounted() {
        axios.get('/api/hobbies/latest')
            .then(res => {
                this.loading = false;
                this.latest = res.data;
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
