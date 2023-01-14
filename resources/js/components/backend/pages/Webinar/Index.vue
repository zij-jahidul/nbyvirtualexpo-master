<template>            <!-- /.card-header -->
    <TableContent  style="margin-top:-20px;"  v-if="typeof(dataList) == 'object'" :searchForm="searchForm" :sortingForm="sortingForm" :isAddItem="isAddItem" :isEditBtn="isEditBtn" :isDelBtn="isDelBtn" :isActionBtn="isActionBtn" :cardTitle="cardTitle" :columnsHead="columnsHead" :columnsBody="columnsBody" :dataList="dataList" :showEditForm="showEditForm" :deleteItem="deleteItem" :getDataList="getDataList" :excelFields="excelFields" :excelTitle="excelTitle" :isDownload="isDownload" :isSearchBox="isSearchBox" route="admin"></TableContent>
</template>
<script>
import mixin from '../../../../src/mixin';
export default {
    mixins:[mixin],

    created(){
        this.generalApi = "webinar"
        this.cardTitle ="Webinar List"
        this.columnsHead.push('Sn', 'Meeting ID', 'Title', 'Description', 'Date', 'Time','Duration','Time Zone','Action')
      
        this.columnsBody.push('meeting_id','title', 'description', 'date', 'time', 'duration', 'time_zone')
        this.isDownload = false
    }
}
</script>
