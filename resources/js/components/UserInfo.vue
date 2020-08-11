<template>
    <div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-auto">
                                    <img :src="$store.getters.getProfileLink(user)" class="rounded-circle" width="80" height="80" />
                                </div>

                                <div class="col">
                                    <h4>{{user.name}}</h4>
                                    <h6>@{{user.nickname}}</h6>

                                    <h6><a :href="`/users/${user.id}/following`"><b>{{user.following}}</b> following</a></h6>
                                    <h6><a :href="`/users/${user.id}/followers`"><b>{{user.followers}}</b> followers</a></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['user']
}
</script>
