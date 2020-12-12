<template>
    <!-- buttons container start -->
    <section id="the-navbar" class="row justify-content-center">
        <div class="col-12 text-center" id="calc-contact-menu">
            <h5>{{ title }}</h5>
        </div>
        <div class="container-fluid">

        </div>
    </section>
    <!-- buttons container end -->
</template>

<script>
    export default {
        mounted() {
            // console.log('The navbar component mounted.')
        },

        data: function(){
            return {
                title: '',
            }
        },
    }
</script>