<template>
    <div class="row" style="margin: 50px; color: white !important;">
        <div class="col-lg-12 col-md-12 col-sm- 12 col-xs-12">
            <div class="basic-login-inner">
                <h3>Add slider information</h3>
                <form action="#">
                    <div class="form-group-inner">
                        <label class="col-sm-3 col-form-label font-color">Text</label>
                        <div class="col-sm-9" style="margin-bottom: 20px;">
                            <input type="text" v-model="form.text" class="font-color form-control" placeholder="Enter text" />
                        </div>
                    </div>
                    <div class="form-group-inner">
                        <label class="col-sm-3 col-form-label font-color">Upload image</label>
                        <div class="col-sm-9">
                            <input v-on:change="uploadImage"
                                   type="file"
                                   placeholder="Photo">
                        </div>
                    </div>
                    <div class="login-btn-inner">
                        <div class="inline-remember-me">
                            <button @click.prevent="save" class="btn btn-sm btn-primary pull-right login-submit-cs" type="submit">
                                Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ManageSlider",
    data(){
        return{
            form: new Form({
                text: '',
            }),
            errors:{}
        }
    },
    methods:{
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
    }
}
</script>

<style scoped>

</style>
