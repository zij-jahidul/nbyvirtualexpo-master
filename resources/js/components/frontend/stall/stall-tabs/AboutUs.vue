<template>
    <div>
        <div class="row mt-5">
            <div class="col-11 col-md-12 b-kule">
                <p class="text-justify">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent pretium feugiat aliquam. Mauris consequat mauris vitae commodo vulputate. Phasellus sodales consectetur lectus, ut pellentesque tortor facilisis ac. Cras vitae vehicula mi, at faucibus felis. Sed quis sem ligula. In faucibus, felis eget aliquet hendrerit, leo dolor commodo massa, vulputate condimentum nisi urna a lacus. Cras at enim eget nisl placerat posuere ornare a risus. Vestibulum auctor auctor orci a euismod. Mauris convallis purus vel eros pharetra venenatis.
                </p>
                <h4 class="mt-5">Web Site</h4>
                <a href="#" target="_blank" class="text-danger">https://www.nbyvirtualexpo.com</a>
                <h4 class="mt-5">Services</h4>
                <ul class="service-list">
                    <li>3D modeling</li>
                    <li>Animation</li>
                    <li>Graphics Design</li>
                </ul>

            </div>
        </div>
    </div>
</template>

<script>
import frmixin from '../../../../src/mixin-frontend'
export default {
mixins:[frmixin],
    name: "AboutUs"
}
</script>

<style scoped>
ul.service-list {
    color: red;
    display: inline-flex;
    width: 100%;
    list-style: none;
    padding-left: 0;
}
ul.service-list li:first-child{
    padding-left: 0 !important;
}
ul.service-list li{
    padding: 5px 15px;
}
@media only screen and (max-width: 767px) {
    .b-kule {
    margin-left: 5%;
}
}

</style>
