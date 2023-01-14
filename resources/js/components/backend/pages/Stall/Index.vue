<template>            <!-- /.card-header -->
    <TableContent class="py-5" v-if="typeof(dataList) == 'object'" :searchForm="searchForm" :sortingForm="sortingForm" :isAddItem="isAddItem" :isEditBtn="isEditBtn" :isDelBtn="isDelBtn" :isActionBtn="isActionBtn" :cardTitle="cardTitle" :columnsHead="columnsHead" :columnsBody="columnsBody" :dataList="dataList" :showEditForm="showEditForm" :deleteItem="deleteItem" :getDataList="getDataList" :excelFields="excelFields" :excelTitle="excelTitle" :isDownload="isDownload" :isSearchBox="isSearchBox" route="admin"></TableContent>
</template>
<script>
import mixin from '../../../../src/mixin';
export default {
    mixins:[mixin],

    created(){
        this.generalApi = "stall"
        this.cardTitle ="stall"
        this.columnsHead.push('Sn','Stall Name','Brand Name', 'Manufacturer Name', 'Open Time','Close Time','Stall Brochure', 'Description', 'Stall Live Broadcust', 'Stall Announcement ','Status','Action')
      
        this.columnsBody.push('stall_name','brand_name', 'manufacturer_name', 'open_time', 'close_time', 'stall_brochure', 'stall_description','stall_live_boardcust','stall_announcement' , 'statusIndex')
        // this.columnsBodyExtra = 
         this.excelTitle = "RSM List"

         this.excelFields = {
                "Stall Name"       : "stall_name",
                "Brand Name"       : "brand_name",
                "Manufacturer Name"       : "manufacturer_name",
                "Open Time"       : "open_time",
                "Close Time"       : "close_time",
                "Stall Brochure"       : "stall_brochure",
                "Stall Description"       : "stall_description",
                "Stall Live Boardcust"       : "stall_live_boardcust",
                "Stall Announcement"       : "stall_announcement",
        }
       
        
    }
}
</script>
