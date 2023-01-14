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
        this.columnsHead.push('Sn','Title','Tropic', 'Image', 'Live broadcust','Start time','End time', 'Description', 'Start date', 'Status', 'Action')
      
        this.columnsBody.push('title','tropic', 'img', 'live_broadcust', 'start_time', 'end_time', 'description','start_date','status')
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
