<template>            <!-- /.card-header -->
    <TableContent class="py-5" v-if="typeof(dataList) == 'object'" :searchForm="searchForm" :sortingForm="sortingForm" :isAddItem="isAddItem" :isEditBtn="isEditBtn" :isDelBtn="isDelBtn" :isActionBtn="isActionBtn" :cardTitle="cardTitle" :columnsHead="columnsHead" :columnsBody="columnsBody" :dataList="dataList" :showEditForm="showEditForm" :deleteItem="deleteItem" :getDataList="getDataList" :excelFields="excelFields" :excelTitle="excelTitle" :isDownload="isDownload" :isSearchBox="isSearchBox" route="admin"></TableContent>
</template>
<script>
import mixin from '../../../../src/mixin';
export default {
    mixins:[mixin],

    created(){
        this.generalApi = "order-detail"
        this.cardTitle ="Order Detail"
        this.columnsHead.push('Sn','Order ID','Color', 'Price', 'Quanity','Size','Action')
      
        this.columnsBody.push('order_id','color', 'product_price', 'product_qty', 'size')
        // this.columnsBodyExtra = 
         this.excelTitle = "RSM List"

         this.excelFields = {
                "Order ID" : "order_id",
                "Color"    : "color",
                "Price"   : "product_price",
                "Quanity": "product_qty",
                "Size"    : "size",
        }  
    }
}
</script>
