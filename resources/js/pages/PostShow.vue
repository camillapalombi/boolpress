<template>
    <page-404 v-if="is404" />
    <div v-else-if="post">
        <h1>{{ post.title }}</h1>
        <b>From {{ post.user.name }}<span v-if="post.category"> in category {{ post.category.name }}</span></b>
        <img :src="post.img_url" alt="post.title" class="img-fluid">
        <p>{{ post.content }}</p>
        <div class="tags">
            <span v-for="tag in post.tags" :key="tag.id" class="tag">{{ tag.name }}</span>
        </div>
    </div>
</template>

<script>
import Page404 from './Page404.vue';

export default {
    name: 'PostShow',
    props: ['slug'],
    components: {
        Page404,
    },
    data() {
        return {
            is404: false,
            post: null,
            baseApiUrl: 'http://localhost:8000/api/v1/posts',
        }
    },
    created() {
        this.getData(this.baseApiUrl + '/' + this.slug);
    },
    methods: {
        getData(url) {
            if (url) {
                Axios.get(url)
                .then(res => {
                    if (res.data.success) {
                        this.post =  res.data.response.data;
                    } else {
                        //this.$router.replace({name: 'page404'}); //TODO: fare in modo che non modifica l'url (Risolto ma credo si puo' fare di meglio)
                        this.is404 = true;
                    }
                });
            }
        }
    }
}
</script>

<style lang="scss" scoped>
    .tag {
        margin: .5rem;
        padding: .5rem;
        background-color: salmon;
        border-radius: 10rem;
    }
</style>
