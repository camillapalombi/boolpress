<template>
  <div>
        <header-main />
        <router-view></router-view>
  </div>
</template>

<script>
import HeaderMain from '../components/HeaderMain.vue';
import ContainerPosts from  '../components/ContainerPosts.vue';

export default {
    name: 'App',
    components: {
        HeaderMain,
        ContainerPosts,
    }
}
</script>

<style>

</style>
