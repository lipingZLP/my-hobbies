<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" @click="show = !show">POST NEW HOBBY</div>
                    <div class="card-body" v-show="show">
                        <label for="category">Category (1: 🌍 - 2: 🎵 - 3: 🎬 - 4: 📖 - 5: 🎮)</label>
                        <input min="1" max="5" type="number" id="category" class="form-control"
                               v-model.number="formData.categoryId">
                        <!-- TODO SELECT https://vegibit.com/vuejs-form-example/ -->

                        <label for="title">Title</label>
                        <input type="text" id="title" class="form-control" v-model="formData.title">

                        <label for="description">Description</label>
                        <textarea id="description" rows="3" class="form-control"
                                  v-model="formData.description"></textarea>

                        <label for="rating">Rating (0-10)</label>
                        <input min="0" max="10" type="number" id="rating" class="form-control"
                               v-model.number="formData.rating">

                        <br>
                        <button class="btn btn-primary" @click.prevent="submitted">Submit!
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            show: false,
            formData: {
                categoryId: null,
                title: '',
                description: '',
                rating: null
            }
        }
    },

    methods: {
        submitted() {
            axios.post('/api/hobbies/add', this.formData)
                .then(res => {
                    // Force refresh page
                    document.location.reload(true)
                })
                .catch(err => {
                    console.log(err)
                })
        }
    },
}
</script>
