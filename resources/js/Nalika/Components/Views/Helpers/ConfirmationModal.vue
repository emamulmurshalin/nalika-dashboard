<template>

</template>

<script>
export default {
    name: "ConfirmationModal",
    props: ["isActive"],
    data(){
        return{

        }
    },
    created() {
        if (this.isActive){
            this.showConfirmationModal();
        }
    },
    methods:{
        showConfirmationModal(){
            swal.fire({
                title: 'Are you sure?',
                text: "This content will be deleted permanently!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    this.$emit('confirm');
                }
                if (result.dismiss == 'cancel') {
                    this.$emit('cancel');
                }
            })
        }
    }
}
</script>

<style scoped>

</style>
