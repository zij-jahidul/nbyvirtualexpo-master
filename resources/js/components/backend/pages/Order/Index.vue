<template>            <!-- /.card-header -->
    <TableContent class="py-5" v-if="typeof(dataList) == 'object'" :searchForm="searchForm" :sortingForm="sortingForm" :isAddItem="isAddItem" :isEditBtn="isEditBtn" :isDelBtn="isDelBtn" :isActionBtn="isActionBtn" :cardTitle="cardTitle" :columnsHead="columnsHead" :columnsBody="columnsBody" :dataList="dataList" :showEditForm="showEditForm" :deleteItem="deleteItem" :getDataList="getDataList" :excelFields="excelFields" :excelTitle="excelTitle" :isDownload="isDownload" :isSearchBox="isSearchBox" route="admin"></TableContent>
</template>
<script>
import mixin from '../../../../src/mixin';
export default {
    mixins:[mixin],

    created(){
        this.generalApi = "back/order"
        this.cardTitle ="Order"
        this.columnsHead.push('SL','Order Number', 'Customer Name', 'Customer Email', 'Order Status', 'Quantity', 'Amount', 'Action')

        this.columnsBody.push('order_number', 'user_name','user_email', 'order_status_rendered', 'quantity','amount', 'show_btn')
        // this.columnsBodyExtra =
        this.excelTitle = "RSM List"

        this.isActionBtn = false
        this.excelFields = {
            "Order Number": "order_number",
            "Customer Name": "user_name",
            "Customer Email": "user_email",
            "Quantity": "quantity",
            "Amount": "amount",

        }
    }
}
</script>
