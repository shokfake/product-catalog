<template>
    <div class="container">
        <h5>Category attribute</h5>

        <div class="row " v-for="(input, index) in inputs">
            <div class="form-group form-inline">
                <div class="col-sm">
                    <input type="hidden" v-bind:name="getInputName(index,'id')" v-model="input.id" class="form-control"/>
                    <input type="text"
                           class="form-control" v-bind:name="getInputName(index,'name')" v-model="input.name"
                           placeholder="Attribute">
                </div>
                <div class="col-sm">
                      <button  class="btn btn-danger" type="button" @click="remove(index)">Delete</button>
                </div>
            </div>
        </div>
        <div class="col-sm">
            <button class="btn btn-info" type="button" @click="add">Add row</button>
        </div>
    </div>
</template>

<script>

    export default {
        name: 'CategoryAttributeComponent',
        props: {
            attributes: {
                type: Array,
                default: () => []
            },
        },
        data() {
            return {
                inputs: this.attributes,
                isSaveButton: false
            }
        },
        methods: {
            add() {
                this.inputs.push({
                    id: 0,
                    name: '',
                });
            },
            remove(index) {
                if (this.inputs[index].id === 0) {
                    this.inputs.splice(index, 1);
                    return;
                }
                let url = `http://localhost:8000/api/attributes/${this.inputs[index].id}`;

                axios
                    .delete(url)
                    .then(function (response) {
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

                this.inputs.splice(index, 1);
            },
            getInputName(index, name) {
                return `attributes[${index}][${name}]`;
            },
        },
    }
</script>

<style scoped>

</style>