<template>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-auto">
                    <img :src="$store.getters.getProfileLink(comment.author)" class="rounded-circle" width="30" height="30" />
                </div>
                <div class="col">
                    <h6>
                        <a :href="`/users/${comment.author.nickname}`">
                            {{comment.author.name}} @{{comment.author.nickname}}
                        </a>
                    </h6>

                    <p>{{ comment.content }}</p>
                </div>
            </div>
        </div>
        <hr>
    </div>
</template>

<script>
export default {
    props: ['comment'],
}
</script>
