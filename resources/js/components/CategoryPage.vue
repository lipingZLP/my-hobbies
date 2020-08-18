<template>
    <div class="container">
        <div v-if="loading">
            Loading...
        </div>

        <div v-if="error">
            {{ error }}
        </div>

        <div v-if="categoriesData">
            <h1>{{ categoriesData.category.icon }} {{ categoriesData.category.name }}</h1>
            <post-new-hobby :categoryId="$props.id"></post-new-hobby>

            <hobbies-list :hobbies="categoriesData.hobbies"></hobbies-list>
        </div>
    </div>
</template>

<script>
export default {
    props: ['id'],

    data() {
        return {
            loading: true,
            error: null,
            categoriesData: null
        }
    },

    mounted() {
        axios.get(`/api/categories/${this.id}/hobbies`)
            .then(res => {
                this.loading = false;
                this.categoriesData = res.data;
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
