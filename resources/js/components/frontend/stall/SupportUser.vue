<template>
    <div>
        <ul class="list-group list-area" v-if="this.user.user.role == 'Customer'">
            <li v-for="(support, index) in supportUsers" :key="index" class="list-group-item d-flex justify-content-between align-items-center">
                {{ support.name }}
                <span class="badge rounded-pill bg-primary" :class="support.activity_class">{{ support.activity_status }}</span>
                <button class="badge btn btn-xs btn-primary" v-if="support.activity_status == 'online'" @click="makeCall(support.id, 'voice')"><i class="fas fa-phone"></i></button>
                 <button v-else class="badge btn btn-xs" :class="support.activity_class"><i class="fas fa-phone"></i></button>
                <button class="badge btn btn-xs btn-primary" v-if="support.activity_status == 'online'" @click="makeCall(support.id, 'video')"><i class="fas fa-video"></i></button>
                <button v-else class="badge btn btn-xs" :class="support.activity_class"><i class="fas fa-video"></i></button>
            </li>
           
        </ul>
        <ul class="list-group list-area" v-if="this.user.user.role == 'Company'">
            <li v-for="(support, index) in supportUsers" :key="index" class="list-group-item d-flex justify-content-between align-items-center">
                {{ support.name }}
                <span class="badge rounded-pill bg-primary" :class="support.activity_class">{{ support.activity_status }}</span>
                <button class="badge btn btn-xs btn-primary" v-if="support.activity_status == 'online'" @click="makeCall(support.id, 'voice')"><i class="fas fa-phone"></i></button>
                 <button v-else class="badge btn btn-xs" :class="support.activity_class"><i class="fas fa-phone"></i></button>
                <button class="badge btn btn-xs btn-primary" v-if="support.activity_status == 'online'" @click="makeCall(support.id, 'video')"><i class="fas fa-video"></i></button>
                <button v-else class="badge btn btn-xs" :class="support.activity_class"><i class="fas fa-video"></i></button>
            </li>
        </ul>
    </div>
</template>
<script>
import {mapGetters} from 'vuex'
export default {
    props:['supportUsers', 'makeCall'],
    computed:{

        ...mapGetters({
            user:'user'
        })
    }
}
</script>

<style scoped>

</style>
