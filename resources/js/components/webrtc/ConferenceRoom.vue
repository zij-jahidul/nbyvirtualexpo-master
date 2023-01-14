<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <router-link to="webinar"><i class="fas fa-chevron-left fa-2x back-button-conference"></i></router-link>
                <div class="hall-banner">
                    <img :src="imageUrl+'hall-room.png'" alt="Live Recording" class="img-fluid">
                    <img :src="imageUrl+'tv.png'" alt="Live TV" class="img-fluid live-tv">
                </div>
                <div class="hall-details">
                    <h3 class="">Importance of Digital Marketing for Today's Prespective</h3>
                    <div class="row mt-3 mb-3">
                        <div class="col-lg-8 col-12">
                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <div class="row">
                                        <div class="col-3">
                                            <img :src="imageUrl+'speaker-1.jpg'" alt="Live Recording" class="img-fluid speaker-photo">
                                        </div>
                                        <div class="col-9 speaker-details">
                                            <p><strong>Md. Numan Al Kalif</strong></p>
                                            <p><small>Motivational Spearker</small></p>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="row">
                                        <div class="col-3">
                                            <img :src="imageUrl+'speaker-2.jpg'" alt="Live Recording" class="img-fluid speaker-photo">
                                        </div>
                                        <div class="col-9 speaker-details">
                                            <p><strong>Dr. Mujtaba Ar -Rashid</strong></p>
                                            <p><small>Marketing Expert</small></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="text-justify">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean bibendum sollicitudin ligula, eu tincidunt nisi vehicula in. Suspendisse convallis, lectus sit amet consectetur ornare, justo est sagittis lectus, vitae condimentum magna dui non nisl. Nullam erat mi, fermentum eu felis ac, tincidunt venenatis urna. Duis quis velit bibendum, scelerisque neque sed, rhoncus magna. Fusce a dui magna. Maecenas sit amet efficitur enim. Maecenas at neque semper justo convallis molestie. Phasellus vel sagittis dui. Phasellus condimentum sed ex pellentesque fringilla. Nulla non interdum enim. Quisque cursus posuere nisl ac rutrum. Nullam sit amet semper eros.
                    </p>
                    <p class="text-justify">
                        Morbi facilisis magna hendrerit augue volutpat fermentum. Proin quis gravida arcu. Donec malesuada consectetur magna nec efficitur. Quisque sagittis aliquet quam, id facilisis enim gravida in. Integer nec ex tempus, congue dolor eu, suscipit massa. Mauris auctor tempus dolor, sed vulputate leo auctor eu. Aenean a libero nec sapien posuere aliquet. Aliquam sagittis urna a velit pellentesque, et dictum justo consectetur. Cras malesuada massa justo. Etiam pulvinar commodo aliquet. Nulla gravida, elit vel semper volutpat, justo sem mattis odio, nec posuere lacus nisl pulvinar sem. Nulla iaculis augue quis mauris facilisis vestibulum. Maecenas scelerisque risus nisi, ac molestie orci viverra vel. Cras et laoreet diam.
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data(){
            return{
                imageUrl : window.location.origin,
            }
        },
        created() {
            this.imageUrl = this.imageUrl+'/frontend/assets/webinar/'
        }
    }
</script>

<style>
.hall-details h3{
    color: green;
    margin: 20px 0;
}
.speaker-photo {
    border-radius: 50%;
    border: 1px solid silver;
}

.speaker-details p{
    margin: 0;
}
.hall-banner{
    position: relative;
}
 .live-tv {
     position: absolute;
     left: 53%;
     transform: translate(-50%,0);
     top: 8%;
     width: 35%;
 }
</style>
