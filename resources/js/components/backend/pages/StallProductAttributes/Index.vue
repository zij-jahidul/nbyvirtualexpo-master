<template>            <!-- /.card-header -->
    <TableContent  style="margin-top:-20px;"  v-if="typeof(dataList) == 'object'" :searchForm="searchForm" :sortingForm="sortingForm" :isAddItem="isAddItem" :isEditBtn="isEditBtn" :isDelBtn="isDelBtn" :isActionBtn="isActionBtn" :cardTitle="cardTitle" :columnsHead="columnsHead" :columnsBody="columnsBody" :dataList="dataList" :showEditForm="showEditForm" :deleteItem="deleteItem" :getDataList="getDataList" :excelFields="excelFields" :excelTitle="excelTitle" :isDownload="isDownload" :isSearchBox="isSearchBox" route="admin"></TableContent>
</template>
<script>
import mixin from '../../../../src/mixin';
export default {
    mixins:[mixin],

    created(){
        this.generalApi = "admin-rsm"
        this.cardTitle ="RSM List"
        this.columnsHead.push('Sn','Color','Size', 'weight', 'Cost price','Sale price','Whole sale price', 'Offer price', 'Action')
      
        this.columnsBody.push('color','size', 'weight', 'cost_price', 'sale_price', 'whole_sale_price', 'offer_price')
        // this.columnsBodyExtra = 
         this.excelTitle = "RSM List"

         this.excelFields = {
                "User ID"       : "user_id",
                Name          : "name",
                Email         : "email",
                "Mobile NO"   : "mobile_no",
                Designation   : "role",
                "Tagged GM/SM": "sm",
                Region        : "region",
                "Pin Code"    : "pin_code",
                "FF Code"     : "ffc",
        }
       
        
    }
}
</script>
