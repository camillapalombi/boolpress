<template>
    <div>
        <div class="row g-4">
            <div class="col-4" v-for="post in posts" :key="post.id">
                <div class="card h-100">
                    <!-- <img src="..." class="card-img-top" alt="..."> -->
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ post.title }}</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a :href="'/posts/' + post.slug" class="btn btn-primary mt-auto">Read more</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="text-center">
                Page {{ nCurrentPage }} of {{ nLastPage }}
            </div>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item" :class="{disabled: nCurrentPage == 1}" @click="getData(firstPageUrl)">
                        <a class="page-link">First</a>
                    </li>
                    <li class="page-item" :class="{disabled: !prevPageUrl}" @click="getData(prevPageUrl)">
                        <a class="page-link">Previous</a>
                    </li>

                    <!-- <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li> -->

                    <li class="page-item">
                        <form @submit.prevent="getData(baseApiUrl + '/?page=' + nNewPage)">
                            <input type="text" name="" id="" v-model="nNewPage">
                        </form>
                    </li>

                    <li class="page-item" :class="{disabled: !nextPageUrl}" @click="getData(nextPageUrl)">
                        <a class="page-link">Next</a>
                    </li>
                    <li class="page-item" :class="{disabled: nCurrentPage == nLastPage}" @click="getData(lastPageUrl)">
                        <a class="page-link">Last</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>

<script>
export default {
    name: 'ContainerPosts',
    data() {
        return {
            posts: [],

            baseApiUrl: 'http://localhost:8000/api/posts',

            nNewPage: null,

            prevPageUrl: null,
            nextPageUrl: null,

            firstPageUrl: null,
            lastPageUrl: null,

            nCurrentPage: null,
            nLastPage: null,
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

                    this.prevPageUrl = res.data.response.prev_page_url;
                    this.nextPageUrl = res.data.response.next_page_url;

                    this.firstPageUrl = res.data.response.first_page_url;
                    this.lastPageUrl = res.data.response.last_page_url;

                    this.nCurrentPage = res.data.response.current_page;
                    this.nLastPage = res.data.response.last_page;

                    this.nNewPage = null;
                });
            }
        }
    }
}
</script>

<style>
    .page-link {
        cursor: pointer;
    }
</style>
