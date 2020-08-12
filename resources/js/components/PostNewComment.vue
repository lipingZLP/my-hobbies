<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div>
                    <button class="btn btn-primary" @click="show = !show">POST NEW COMMENT></button>
                </div>
                <br>
                <div class="card">
                    <div class="card-body" v-show="show">

                        <label for="comment">Add your comment</label>
                        <textarea id="comment" rows="3" class="form-control" v-model="formData.content"></textarea>

                        <br>
                        <button class="btn btn-primary" @click.prevent="submitted">Send</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['hobby_id'],

    data() {
        return {
            show: false,
            formData: {
                content: ''
            }
        }
    },

    methods: {
        submitted() {
            axios.post(`/api/hobbies/${this.$props.hobby_id}/comment`, this.formData)
                .then(res => {
                    // Force refresh page
                    document.location.reload(true)
                })
                .catch(err => {
                    console.log(err)
                })
        }
    }
}
</script>
