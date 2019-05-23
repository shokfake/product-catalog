<template>
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <div class="list-group">
                    <button type="button" class="list-group-item list-group-item-action active"
                            @click="categoriesHandler">
                        Categories
                    </button>
                    <button type="button" class="list-group-item list-group-item-action"
                            @click="categoryHandler(category)" v-model="category.name"
                            v-for="category in categories">
                        {{category.name}}
                    </button>
                </div>
            </div>
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-4" v-for="product in products">
                        <card class="card" :product="product"></card>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "HomePage",
        props: {
            products: {
                type: Array,
                default: function () {
                    return [];
                }
            },
            categories: {
                type: Array,
                default: function () {
                    return [];
                }
            },
        },
        data() {
            return {
                categories: this.categories,
                products: this.products,
            }
        },
        methods: {
            categoriesHandler() {
                let url = `http://127.0.0.1:8000/api/products`;

                axios
                    .get(url)
                    .then(response => (this.products = response.data))
                    .catch(error => console.log(error));
            },
            categoryHandler(category) {
                let url = `http://127.0.0.1:8000/api/categories/${category.id}/products`;

                axios
                    .get(url)
                    .then(response => (this.products = response.data))
                    .catch(error => console.log(error));
            },
        },
        mounted() {
            // console.log(this.products);
            // console.log(this.attributes);
        }
    }
</script>

<style scoped>
    .card {
    }
</style>