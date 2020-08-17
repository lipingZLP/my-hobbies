<template>
    <div class="row">
        <div class="nav">
            <a v-for="category in $store.state.categories" :key="category.id" class="nav-link" :href="`/categories/${category.id}`">
                {{ category.icon }} {{ category.name }}
            </a>
        </div>
    </div>
</template>

<style>
.nav {
    margin-right: 100px;
}
.nav-link {
    margin-right: 20px;
}
</style>
