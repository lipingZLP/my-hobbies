<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div>
                    <button class="btn btn-primary" @click="show = !show">POST NEW HOBBY</button>
                </div>
                <br>
                <div class="card">
                    <div class="card-body" v-show="show">
                        <label for="category">Category</label>
                        <select id="category" class="form-control" v-model="formData.categoryId">
                            <option value="null">-- Choose your category --</option>
                            <option v-for="category in $store.state.categories" :value="category.id" :key="category.id">{{category.icon}}&nbsp;&nbsp;{{ category.name }}</option>
                        </select>

                        <br>
                        <label for="title">Title</label>
                        <input type="text" id="title" class="form-control" v-model="formData.title">

                        <br>
                        <label for="description">Description</label>
                        <textarea id="description" rows="3" class="form-control"
                                  v-model="formData.description"></textarea>

                        <br>
                        <label for="rating">Rating</label>
                        <select id="rating" class="form-control" v-model="formData.rating">
                            <option value="null">-- Rate your hobby --</option>
                            <option value="10">10 Best ever</option>
                            <option value="9">09 Excellent</option>
                            <option value="8">08 Very good</option>
                            <option value="7">07 Fine</option>
                            <option value="6">06 OK</option>
                            <option value="5">05 Average</option>
                            <option value="4">04 Bad</option>
                            <option value="3">03 Very bad</option>
                            <option value="2">02 Horrible</option>
                            <option value="1">01 Abonimable</option>
                            <option value="0">00 Worst ever</option>
                        </select>

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
    }
}
</script>
