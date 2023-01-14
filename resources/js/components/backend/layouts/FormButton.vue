<template>
    <div>
        <button type="submit" class="btn btn-sm btn-primary float-right m-1" v-text="isEdit?'Update':'Save Changes'"></button>
        <router-link :to="backUrl" class="btn btn-sm btn-primary float-right m-1"><i class="fa fa-arrow-left"></i> Back</router-link>
    </div>
</template>

<script>
export default {
    props:['backUrl','isEdit']
}
</script>

