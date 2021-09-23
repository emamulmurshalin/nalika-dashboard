<template>
    <div id="user-modal" class="modal fade bd-example-modal-lg"
         tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel"
         aria-hidden="true">
        <div class="modal-dialog mt-0 modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 v-if="selectedUrl" class="modal-title">Edit Employee</h5>
                    <h5 v-else class="modal-title">Add Employee</h5>
                    <button type="button" class="close" @click.prevent="closeModal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" id="quickForm">
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Text</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                           v-model="form.text"
                                           class="form-control"
                                           placeholder="Enter name">
                                    <p
                                        v-if="errors.text"
                                        class="text-danger col-sm-12 mt-2 mb-0 float-right"
                                        style="padding-left: 0px;
                                        font-size: 14px;
                                        margin-top: 3px;"
                                    >
                                        {{ errors.text[0] }}
                                    </p>
                                </div>

                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Image</label>
                                <div class="col-sm-9">
                                    <input v-on:change="uploadImage"
                                           type="file"
                                           placeholder="Photo">
                                    <p
                                        v-if="errors.image"
                                        class="text-danger col-sm-12 mt-2 mb-0 float-right"
                                        style="padding-left: 0px;
                                        font-size: 14px;
                                        margin-top: 3px;"
                                    >
                                        {{ errors.image[0] }}
                                    </p>
                                </div>
                            </div>


                        </div>
                        <!-- /.card-body -->
                    </form>
                </div>
                <div class="modal-footer">
                    <button style="font-size: 16px;" type="button" class="btn btn-secondary" @click.prevent="closeModal">
                        Cancel
                    </button>
                    <button v-if="selectedUrl" style="font-size: 16px;" type="submit" class="btn btn-primary" @click.prevent="update">
                        Update
                    </button>
                    <button style="font-size: 16px;" v-else type="submit" class="btn btn-primary" @click.prevent="submit">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "AddSliderInfoModal",
    props:['selectedUrl'],
    data(){
        return{
            form: new Form({
                text: ''
            }),
            errors:{}
        }
    },
    methods:{
        closeModal(){
            this.$emit("close-modal");
        },
        uploadImage(file) {
            if (file == "") return false;
            this.form.image = file.target.files[0];
        },
        save(){
            const config = {
                headers: { 'content-type': 'multipart/form-data' }
            }

            let formData = new FormData();
            formData.append('text', this.form.text);
            formData.append('image', this.form.image);

            this.axios.post('/slider', formData)
                .then((response) => {
                    if (response.status == 200){
                        this.$toast.success(response.data.message);
                    }
                }).catch((error)=>{
                this.errors = error.response.data.errors;
            });
        }
    },
    created() {

    }
}
</script>

<style scoped>

</style>
