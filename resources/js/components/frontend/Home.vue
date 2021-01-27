<template>
    <div id="wrapper">
        <div class=" welcome-container">
            <div class="image-center d-flex justify-content-center ">
                <img src="/images/dulux_images/dulux_logo.png" alt="" srcset="" class="header-logo-image">
            </div>
            <h1 class="d-flex justify-content-center welcome-heading">Welcome</h1>
            <div class="row align-middle d-flex justify-content-center">
                <div class="col-sm-6 d-flex justify-content-center">
                    <router-link to="" class="btn btn-lg btn-success btn-beginner"> I'm a Beginner</router-link>
                </div>
                <div class="col-sm-6 d-flex justify-content-center ">
                    <router-link to="/color" class="btn btn-lg btn-success btn-expert"> I'm an Expert</router-link>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 d-flex justify-content-center">
                    <router-link to="" class="btn btn-lg btn-search">Search</router-link>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
