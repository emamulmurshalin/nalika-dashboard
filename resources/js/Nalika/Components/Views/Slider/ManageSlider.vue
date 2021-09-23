<template>
    <div class="page-content" style="margin: 20px !important;">
        <div class="row">
            <div class="col-xs-12">
                <h3 class="header smaller lighter blue font-color">Slider Information</h3>

                <div class="clearfix" style="margin-bottom: 14px;">
                    <div class="pull-right tableTools-container"></div>
                </div>

                <button @click.prevent="openModal" data-toggle="modal" class="btn btn-success"
                        style="border: 0px !important; padding: 7px;
                        background-color: #F3F3F3 !important; color: black !important; float: right; margin-bottom: 10px;">
                    <i class="fas glyphicon-plus"></i>
                    Add
                </button>

                <!-- div.table-responsive -->

                <!-- div.dataTables_borderWrap -->
                <div>
                    <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th class="font-color">ID</th>
                            <th class="font-color">Text</th>
                            <th class="font-color">Image</th>
                            <th class="font-color">
                                <i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
                                Action
                            </th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr v-for="slider in sliderData.data">
                            <td>
                                <a href="#">{{ slider.id }}</a>
                            </td>
                            <td>{{ slider.text }}</td>
                            <td>{{ slider.text }}</td>
                            <td>
                                <div class="hidden-sm hidden-xs action-buttons">
                                    <a class="green" href="#" @click.prevent="editSlider(slider.id)">
                                        <i class="ace-icon fa fa-pencil bigger-130"></i>
                                    </a>

                                    <a class="red" href="#" @click.prevent="deleteSlider(slider.id)">
                                        <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                    </a>
                                </div>

                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div style="float: right;">
            <paginate
                :page-count="pageCount"
                :click-handler="getSliderData"
                :prev-text="'Prev'"
                :next-text="'Next'"
                :container-class="'pagination'"
                :page-class="'page-item'">
            </paginate>
        </div>

        <add-slider-modal v-if="isModalActive"
                               :selected-url="selectedUrl"
                               @close-modal="closeModal">
        </add-slider-modal>

        <app-confirmation-modal v-if="isConfirmationModal"
                                :is-active="isConfirmationModal"
                                @confirm="confirmed"
                                @cancel="cancelled">
        </app-confirmation-modal>
    </div>
</template>

<script>
export default {
    name: "ListView",
    data(){
        return{
            isModalActive: false,
            isConfirmationModal: false,
            deletedId: null,
            selectedUrl: '',
            perPage: 10,
            totalData: 0,
            sliderData: {}
        }
    },
    mounted() {
        this.getSliderData();
    },
    computed:{
        pageCount(){
            if (this.totalData <= 10){
                return 1;
            }else {
                let totalPage;
                totalPage = (this.totalData % this.perPage);
                if (totalPage == 0){
                    totalPage = (this.totalData / this.perPage) + 1;
                }else {
                    totalPage = (this.totalData / this.perPage);
                }
                return totalPage;
            }
        }
    },
    methods:{
        deleteSlider(id){
            this.deletedId = id;
            this.isConfirmationModal = true;
        },
        confirmed(){
            this.axios.delete(`/slider/${this.deletedId}`)
                .then((response) => {
                    if(response.status == 200){
                        this.$toast.success(response.data.message);
                        this.getSliderData();
                        this.isConfirmationModal = false;
                    }
                }).catch(()=>{
                this.isConfirmationModal = false;
            });
        },
        cancelled(){
            this.isConfirmationModal = false;
            this.deletedId = null;
        },
        editSlider(id){
            this.selectedUrl = `/slider/${id}`;
            this.isModalActive = true;
            setTimeout(()=> {
                $('#slider-modal').modal('show');
            })
        },
        getSliderData(page = 1){
            this.axios.get('/slider?page=' + page)
                .then((response) => {
                    this.totalData = response.data.total;
                    this.sliderData = response.data;
                }).catch(()=>{
            });
        },
        openModal(){
            this.isModalActive = true;
            setTimeout(()=> {
                $('#slider-modal').modal('show');
            })
        },
        closeModal(){
            this.selectedUrl = "";
            this.isModalActive = false;
            $('#slider-modal').modal('hide');
            this.getSliderData();
        },
    }
}
</script>

<style scoped>

.filter-dropdown{
    padding-left: 0px;
    padding-right: 0px;
    margin-right: 2px;
}
.search-button{
    height: 34px;
    border-radius: 5px;
    padding: 0;
    width: 80px;
}
.filter-button-design{
    border-radius: 5px !important;
}
</style>
