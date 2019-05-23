<template>
    <div class="container">
        <h5>Category attribute</h5>

        <div class="row " v-for="(input, index) in inputs">
            <div class="form-group form-inline">
                <div class="col-sm">
                    <input type="text" @focus="setVisibleSaveButton(input)"
                           class="form-control" v-bind:name="getInputName(index)" v-model="input.name"
                           placeholder="Attribute">
                </div>
                <div class="col-sm">
                    <button v-if="input.isSave" class="btn btn-info" type="button" @click="save(index)">Save</button>
                    <button v-else class="btn btn-danger" type="button" @click="remove(index)">Delete</button>
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
            isSaveButton: {
                type: Boolean,
                default: false,
                require: false
            },
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
            setVisibleSaveButton(input) {
                if (input.id) {
                    input.isSave = true;
                }
            },
            setVisibleDeleteButton(input) {
                input.isSave = false;
            },
            add() {
                this.inputs.push({
                    name: '',
                    isSave: this.isSaveButton
                });
            },
            remove(index) {

                let url = `http://127.0.0.1:8000/api/attributes/${this.inputs[index].id}`;

                axios
                    .delete(url)
                    .then(function (response) {
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

                this.inputs.splice(index, 1);
            },
            save(index) {
                this.inputs[index].isSave = false;

                if (!this.inputs[index].id) {
                    console.log("Error");
                }
                let url = `http://127.0.0.1:8000/api/attributes/${this.inputs[index].id}`;

                axios
                    .post(url, this.inputs[index])
                    .then(function (response) {
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            getInputName(index) {
                if (this.inputs[index].id) {
                    return  ""
                }

                return "attributes[" + index + "]";
            }
        },
    }
</script>

<style scoped>

</style>