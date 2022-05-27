<template>
    <div>
        <router-link :to="{name: 'home'}">Home</router-link>
        <router-link :to="{name: 'postIndex'}">Blog</router-link>
        <router-link :to="{name: 'about'}">About</router-link>
    </div>
</template>

<script>
export default {
    name: 'HeaderMain'
}
</script>

<style>

</style>
