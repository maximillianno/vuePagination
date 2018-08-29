<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Users</div>

                    <div class="card-body">
                        <pages-component v-if="meta && links && users.length" :for="compName" :meta="meta" :links="links"></pages-component>
                        <div class="media user" v-for="user in users" :key="user.id">
                            <div class="media-left mr-3">
                                <a href="#"><img class="media-object"  v-bind:src="user.avatar" alt=""></a>

                            </div>
                            <div class="media-body">
                                <h5 class="media-heading"><a href="">{{ user.name }}</a></h5>
                                

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    
    import PagesComponent from './PagesComponent'
    import  eventHub  from "../events.js";

    export default {
        data(){
            return {
                compName: "usersc",
                page: 1,
                users: [],
                meta: {'last_page': 1},
                links: ['prev']
            }
                
            
        },
        methods: {
            getUsers(page){
                axios.get(`api/users?page=${page}`).then((response)=>{
                    this.users = response.data.data
                    this.meta = response.data.meta
                    this.links = response.data.links
                    console.log(this.users)
                    console.log(this.meta)
                    console.log(this.links)

                })
            }

        },
        mounted() {
            this.getUsers(this.page)
            eventHub.$on('usersc.switched-page', this.getUsers)
        },
        components:{
            PagesComponent
        }
    }
</script>
