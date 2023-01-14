<template>            <!-- /.card-header -->
    <TableContent v-if="typeof(dataList) == 'object'" :searchForm="searchForm" :sortingForm="sortingForm" :isAddItem="isAddItem" :isEditBtn="isEditBtn" :isDelBtn="isDelBtn" :isActionBtn="isActionBtn" :cardTitle="cardTitle" :columnsHead="columnsHead" :columnsBody="columnsBody" :dataList="dataList" :showEditForm="showEditForm" :deleteItem="deleteItem" :getDataList="getDataList" :excelFields="excelFields" :excelTitle="excelTitle" :isDownload="isDownload" :isSearchBox="isSearchBox" route="admin"></TableContent>
</template>
<script>
import mixin from '../../../../src/mixin';
export default {
    mixins:[mixin],

    created(){
        this.generalApi = "product-image"
        this.cardTitle ="Product Image"
        this.columnsHead.push('Sn','Action')
      
        this.columnsBody.push('image')
        // this.columnsBodyExtra = 
         this.excelTitle = "RSM List"

         this.excelFields = {
                "Image"  : "image",
        }
       
        
    }
}
</script>
