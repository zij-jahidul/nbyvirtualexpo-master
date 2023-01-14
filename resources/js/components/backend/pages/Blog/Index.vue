<template>            <!-- /.card-header -->
    <TableContent v-if="typeof(dataList) == 'object'" :searchForm="searchForm" :sortingForm="sortingForm" :isAddItem="isAddItem" :isEditBtn="isEditBtn" :isDelBtn="isDelBtn" :isActionBtn="isActionBtn" :cardTitle="cardTitle" :columnsHead="columnsHead" :columnsBody="columnsBody" :dataList="dataList" :showEditForm="showEditForm" :deleteItem="deleteItem" :getDataList="getDataList" :excelFields="excelFields" :excelTitle="excelTitle" :isDownload="isDownload" :isSearchBox="isSearchBox" route="admin"></TableContent>
</template>
<script>
import mixin from '../../../../src/mixin';
export default {
    mixins:[mixin],

    created(){
        this.generalApi = "blog"
        this.cardTitle ="Blog"
        this.columnsHead.push('Sn','Title', 'Topic', 'Live Broadcust','Description','Feature Image','Action')
      
        this.columnsBody.push('title','tropic', 'live_broadcust', 'description', 'image_path')
        // this.columnsBodyExtra = 
       this.isDownload = false 
    }
}
</script>
