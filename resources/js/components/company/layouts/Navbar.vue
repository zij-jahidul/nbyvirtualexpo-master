<template>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container-fluid">
        <router-link class="navbar-brand" to="/">
            NBY Virtual Expo
        </router-link>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
              
                        <li class="nav-item">
                            <router-link class="nav-link" to="/signin">Sign In</router-link>
                        </li>
                   
                        <li class="nav-item">
                            <router-link class="nav-link" to="/admin/signup">Sign Up</router-link>
                        </li>
                  
                    <li class="nav-item dropdown">
                        <router-link id="navbarDropdown" class="nav-link dropdown-toggle" to="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                           Admin
                        </router-link>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="javascript:void(0)" @click.prevent="signOut">
                                Sign Out
                            </a>
                        </div>
                    </li>
            </ul>
        </div>
    </div>
</nav>
</template>

<script>
export default {
    props:['signOut'],
    data(){
        return {
            
        }
    }
}
</script>