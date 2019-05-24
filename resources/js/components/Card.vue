<template>
<div class="product-item">
    <img v-bind:src="image" class="rounded mx-auto d-block">
    <div class="product-list">
        <h3>{{product.name}}</h3>
        <div class="product-items">
            <ul class="list-group list-group-flush">
                <li class="list-group-item" v-bind:key = "attribute.id" v-for="attribute in product.attributes">
                    <b>{{attribute.name}}</b> : {{attribute.value}}
                </li>
            </ul>
        </div>
    </div>
</div>
</template>

<script>
export default {
    name: "cart",
    props: {
        product: {
            type: Object,
            default: function () {
                return {};
            }
        }
    },
    data() {
        return {
            product: this.product,
        }
    },
    computed: {
        image: function () {
            console.log(this.product);
            const url = "http://127.0.0.1:8000/";
            return `${url}uploads/${this.product.image}`;
        },
    },
}
</script>

<style scoped>
* {
    box-sizing: border-box;
}

.product-item {
    width: 300px;
    text-align: center;
    margin: 0 auto;
    margin-bottom: 20px;
    border-bottom: 2px solid #F5F5F5;
    background: white;
    font-family: "Open Sans";
    transition: .3s ease-in;
    align-content: center;
}

.product-item:hover {
    border-bottom: 2px solid #fc5a5a;
}

.product-list {
    background: #fafafa;
    padding: 15px 0;
}

.product-list h3 {
    font-size: 18px;
    font-weight: 400;
    color: #444444;
    margin: 0 0 10px 0;
}

.product-item img {
    width: 200px;
    height: 200px;
}

.product-item:hover .button {
    background: #fc5a5a;
}

.product-name {
    border-bottom: 2px solid #301ed8;
    ;
}
</style>
