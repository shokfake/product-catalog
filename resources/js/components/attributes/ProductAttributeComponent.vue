<template>
<div class="form-group">
    <select id="category" name="category" v-model="selected" class="form-group form-control" @change="categoriesHandler">
            <option v-for="category in categories" v-bind:value="category.id">{{category.name}}</option>
        </select>

    <div class="form-group" v-for="(attribute,index) in attributes">
        <label >{{attribute.name}}</label>
        <input  type="hidden" v-bind:name="getInputName(index,'id')" v-model="attribute.id" class="form-control"/>
        <input  type="hidden" v-bind:name="getInputName(index, 'name')" v-model="attribute.name" class="form-control"/>
        <input  type="text" v-bind:name="getInputName(index, 'value')" v-model="attribute.value" class="form-control"/>
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
        getInputName(attribute, name) {
            return `attributes[${attribute}][${name}]`;
        },
    }
}
</script>

<style scoped>

</style>
