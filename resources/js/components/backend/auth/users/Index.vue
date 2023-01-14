<template>            <!-- /.card-header -->
    <TableContent v-if="typeof(dataList) == 'object'" :searchForm="searchForm" :sortingForm="sortingForm" :isAddItem="isAddItem" :isEditBtn="isEditBtn" :isDelBtn="isDelBtn" :isActionBtn="isActionBtn" :cardTitle="cardTitle" :columnsHead="columnsHead" :columnsBody="columnsBody" :dataList="dataList" :showEditForm="showEditForm" :deleteItem="deleteItem" :getDataList="getDataList" :excelFields="excelFields" :excelTitle="excelTitle" :isDownload="isDownload" :isSearchBox="isSearchBox" route="admin"></TableContent>
</template>
<script>
import mixin from '../../../../src/mixin';
export default {
    mixins:[mixin],

    created(){
        this.generalApi = "user"
        this.cardTitle ="User"
        this.columnsHead.push('Sn','Name', 'Email', 'Role', 'Photo', 'Action')
      
        this.columnsBody.push('name','email', 'role','photo_path')

         this.excelFields = {
                "Name" : "name",
                "Email": "email",
                "Phone": "phone",
                "Role" : "role"
               
        }   
    }
}
</script>
