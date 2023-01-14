<template> <!-- /.card-header -->
    <TableContent v-if="typeof(dataList) == 'object'" :searchForm="searchForm" :sortingForm="sortingForm" :isAddItem="isAddItem" :isEditBtn="isEditBtn" :isDelBtn="isDelBtn" :isActionBtn="isActionBtn" :cardTitle="cardTitle" :columnsHead="columnsHead" :columnsBody="columnsBody" :dataList="dataList" :showEditForm="showEditForm" :deleteItem="deleteItem" :getDataList="getDataList" :excelFields="excelFields" :excelTitle="excelTitle" :isDownload="isDownload" :isSearchBox="isSearchBox" route="admin"></TableContent>
</template>
<script>
import mixin from '../../../../src/mixin';
export default {
    mixins:[mixin],

    created(){
        this.generalApi = "company"
        this.cardTitle ="Company"
        this.columnsHead.push('Sn','Company Logo', 'Company Expire Date', 'Company Description','Company Image','Action')
      
        this.columnsBody.push('company_name', 'company_expire_date', 'company_description', 'company_img')
        // this.columnsBodyExtra = 
         this.excelTitle = "RSM List"

         this.excelFields = {
                "Company Name"       : "company_name",
                "Company Expire Date"       : "company_expire_date",
                "Company Description"       : "company_description",
                "Company Image"       : "company_img",
        }  
    }
}
</script>
