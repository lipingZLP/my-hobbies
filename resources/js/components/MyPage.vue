<template>
    <div class="container">
        <div v-if="loading">
            Loading...
        </div>

        <div v-if="error">
            {{ error }}
        </div>

        <div>
            <div class="row justify-content-center">
                <h2>🏠 {{ username}}'s Home</h2>
            </div>

            <post-new-hobby></post-new-hobby>
            <br>
        </div>

        <div v-if="latest">
            <hobbies-list :hobbies="latest.hobbies"></hobbies-list>
            <br>
            <pagination v-if="latest.hobbies.length > 0" :currentPage="pagination.curPage" :totalPages="pagination.totalPages" @changePage="loadPage"></pagination>
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
            latest: null,
            pagination: null
        }
    },

    mounted() {
        this.loadPage(1)
    },

    methods: {
        loadPage(page) {
            this.loading = true

            axios.get(`/api/hobbies/latest?page=${page}`)
                .then(res => {
                    this.loading = false
                    this.latest = res.data
                    this.pagination = res.data.pagination
                })
                .catch(err => {
                    this.loading = false
                    if (err.response.data.error) {
                        this.error = err.response.data.error.message
                    } else {
                        this.error = err.message
                    }
                })
            },
    }
}
</script>
