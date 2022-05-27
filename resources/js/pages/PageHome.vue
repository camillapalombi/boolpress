<template>
    <div>
        <h1>Ecco 4 post random per voi</h1>

        <div class="row g-4">
            <div class="col-6" v-for="post in posts" :key="post.id">
                <div class="card h-100">
                    <!-- <img src="..." class="card-img-top" alt="..."> -->
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ post.title }}</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <router-link :to="{name: 'postShow', params: {slug: post.slug}}" class="btn btn-primary mt-auto">Read more</router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'ContainerPosts',
    data() {
        return {
            posts: [],
            baseApiUrl: 'http://localhost:8000/api/v1/posts?home',
        }
    },
    created() {
        this.getData(this.baseApiUrl);
    },
    methods: {
        getData(url) {
            if (url) {
                Axios.get(url)
                .then(res => {
                    this.posts =  res.data.response.data;
                });
            }
        }
    }
}
</script>

<style lang="scss" scoped>
    .page-link {
        cursor: pointer;
    }
</style>
