<template>
<div class="form-group">
    <select id="category" name="category" v-model="selected" class="form-group form-control" @change="categoriesHandler">
            <option v-for="category in categories" v-bind:value="category.id">{{category.name}}</option>
        </select>

    <div class="form-group" v-for="attribute in attributes">
        <label >{{attribute.name}}</label>
        <input  type="text" v-model="attribute.value" v-bind:name="getInputName(attribute)" class="form-control"/>
        </div>
    </div>
</template>

<script>
export default {
    name: "ProductAttributeComponent",
    props: {
        selected: {
            type: Number,
            default: 0,
        },
        categories: {
            type: Object,
            default: function () {
                return {};
            }
        },
        attributes: {
            type: Object,
            default: function () {
                return {};
            }
        },
    },
    data() {
        console.log(this.attributes);
        return {
            categories: this.categories,
            selected: this.selected,
            attributes: this.attributes,
        }
    },
    methods: {
        categoriesHandler() {
            let url = `http://127.0.0.1:8000/api/categories/${this.selected}/attributes`;

            axios
                .get(url)
                .then(response => (this.attributes = response.data))
                .catch(error => console.log(error));
        },
        getInputName(attribute) {
            return `attributes['${attribute.id}']['${attribute.name}']`;
        },
    }
}
</script>

<style scoped>

</style>
