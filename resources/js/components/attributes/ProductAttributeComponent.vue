<template>
    <div class="form-group">
        <label for="category">Category:</label>
        <select id="category" name="category" v-model="selected" class="custom-select" @change="categoriesHandler">
            <option value="0" hidden>Please Select</option>
            <option v-for="category in categories" v-bind:value="category.id">{{category.name}}</option>
        </select>

        <div class="form-group mt-3" v-for="(attribute,index) in attributes">
            <label>{{attribute.name}}</label>
            <input type="hidden" v-bind:name="getInputName(index,'id')" v-model="attribute.id" class="form-control"/>
            <input type="hidden" v-bind:name="getInputName(index, 'name')" v-model="attribute.name"
                   class="form-control"/>
            <input type="text" v-bind:name="getInputName(index, 'value')" v-model="attribute.value" class="form-control"
                   :placeholder="attribute.name"/>
        </div>

    </div>
</template>

<script>
    export default {
        name: "ProductAttributeComponent",
        props: {
            selected: {
                type: Number,
                require: false,
                default: 0,
            },
            categories: {
                type: Array,
                require: false,
                default: function () {
                    return [];
                }
            },
            attributes: {
                type: Array,
                require: false,
                default: function () {
                    return [];
                }
            },
        },
        data() {
            return {}
        },
        methods: {
            categoriesHandler() {
                let url = `http://localhost:8000/api/categories/${this.selected}/attributes`;

                axios
                    .get(url)
                    .then(response => (this.attributes = response.data))
                    .catch(error => console.log(error));
            },
            getInputName(index, name) {
                return `attributes[${index}][${name}]`;
            },
        }
    }
</script>

<style scoped>

</style>
