<template>            <!-- /.card-header -->
    <TableContent class="py-5" v-if="typeof(dataList) == 'object'" :searchForm="searchForm" :sortingForm="sortingForm" :isAddItem="isAddItem" :isEditBtn="isEditBtn" :isDelBtn="isDelBtn" :isActionBtn="isActionBtn" :cardTitle="cardTitle" :columnsHead="columnsHead" :columnsBody="columnsBody" :dataList="dataList" :showEditForm="showEditForm" :deleteItem="deleteItem" :getDataList="getDataList" :excelFields="excelFields" :excelTitle="excelTitle" :isDownload="isDownload" :isSearchBox="isSearchBox" route="admin"></TableContent>
</template>
<script>
import mixin from '../../../../src/mixin';
export default {
    mixins:[mixin],

    created(){
        this.generalApi = "stall-layout"
        this.cardTitle ="Stall Layout"
        this.columnsHead.push('Sn','Layout Img','Layout Name','Layout Color','Layout Size', 'Layout Description','Status' , 'Action')
      
        this.columnsBody.push('layout_img','layout_name','layout_color', 'layout_size', 'layout_description', 'status')
        // this.columnsBodyExtra = 
         this.excelTitle = "RSM List"

         this.excelFields = {
                "Layout Img"       : "layout_img",
                "Layout Name"       : "layout_name",
                "Layout Color"       : "layout_color",
                "Layout Size"       : "layout_size",
                "Layout Description"       : "layout_description",
                "Status"       : "status",
                "User ID"       : "user_id",

        }
    }
}
</script>
