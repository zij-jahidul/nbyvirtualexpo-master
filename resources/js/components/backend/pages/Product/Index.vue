<template>            <!-- /.card-header -->
    <TableContent class="py-5" v-if="typeof(dataList) == 'object'" :searchForm="searchForm" :sortingForm="sortingForm" :isAddItem="isAddItem" :isEditBtn="isEditBtn" :isDelBtn="isDelBtn" :isActionBtn="isActionBtn" :cardTitle="cardTitle" :columnsHead="columnsHead" :columnsBody="columnsBody" :dataList="dataList" :showEditForm="showEditForm" :deleteItem="deleteItem" :getDataList="getDataList" :excelFields="excelFields" :excelTitle="excelTitle" :isDownload="isDownload" :isSearchBox="isSearchBox" route="admin"></TableContent>
</template>
<script>
import mixin from '../../../../src/mixin';
export default {
    mixins:[mixin],

    created(){
        this.generalApi = "product"
        this.cardTitle ="Product"
        this.columnsHead.push('Sn','Product Image','Product Name','Product Code', 'Color', 'Size', 'Cost price', 'Selling price', 'Wholesale price', 'Offer price','Product Description', 'Action')

        this.columnsBody.push('feature_image','product_name', 'product_code',  'color','size' , 'cost_price' ,'selling_price' ,'wholesale_price' ,'offer_price' ,'description')
        // this.columnsBodyExtra =
         this.excelTitle = "RSM List"

         this.excelFields = {
                "Product img": "product_img",
                "Product name": "product_name",
                "Product code": "product_code",
                "Color": "color",
                "Size": "size",
                "Cost price": "cost_price",
                "Selling price": "selling_price",
                "Wholesale price": "wholesale_price",
                "Offer price": "offer_price",
                "Description": "description",
        }


    }
}
</script>
