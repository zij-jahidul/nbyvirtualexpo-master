<template>            <!-- /.card-header -->
    <TableContent class="py-5" v-if="typeof(dataList) == 'object'" :searchForm="searchForm" :sortingForm="sortingForm" :isAddItem="isAddItem" :isEditBtn="isEditBtn" :isDelBtn="isDelBtn" :isActionBtn="isActionBtn" :cardTitle="cardTitle" :columnsHead="columnsHead" :columnsBody="columnsBody" :dataList="dataList" :showEditForm="showEditForm" :deleteItem="deleteItem" :getDataList="getDataList" :excelFields="excelFields" :excelTitle="excelTitle" :isDownload="isDownload" :isSearchBox="isSearchBox" route="admin"></TableContent>
</template>
<script>
import mixin from '../../../../src/mixin';
export default {
    mixins:[mixin],

    created(){
        this.generalApi = "stall-visitor"
        this.cardTitle ="Stall Visitor"
        this.columnsHead.push('Sn','Stall ID','Customer ID','Action')
      
        this.columnsBody.push('stall_id','customer_id')
        // this.columnsBodyExtra = 
         this.excelTitle = "RSM List"

         this.excelFields = {
                "Stall ID"       : "stall_id",
                "Customer ID"     : "customer_id",
        }
    }
}
</script>
