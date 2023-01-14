<template>            <!-- /.card-header -->
    <TableContent class="py-5" v-if="typeof(dataList) == 'object'" :searchForm="searchForm" :sortingForm="sortingForm" :isAddItem="isAddItem" :isEditBtn="isEditBtn" :isDelBtn="isDelBtn" :isActionBtn="isActionBtn" :cardTitle="cardTitle" :columnsHead="columnsHead" :columnsBody="columnsBody" :dataList="dataList" :showEditForm="showEditForm" :deleteItem="deleteItem" :getDataList="getDataList" :excelFields="excelFields" :excelTitle="excelTitle" :isDownload="isDownload" :isSearchBox="isSearchBox" route="admin"></TableContent>
</template>
<script>
import mixin from '../../../../src/mixin';
export default {
    mixins:[mixin],

    created(){
        this.generalApi = "ads"
        this.cardTitle ="Ads"
        this.columnsHead.push('Sn','Adds Type','Adds Position','Video Link','Image','Status', 'Action')
      
        this.columnsBody.push('adsTypeText','adsPositionText', 'video_link','image_path','statusText')
        // this.columnsBodyExtra = 
       this.isDownload = false
       
        
    }
}
</script>
