<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Topics</div>

                    <div class="card-body">
                        <pages-component v-if="meta && links && topics.length" :for="compName" :meta="meta" :links="links"></pages-component>
                        <topic-component v-for="topic in topics" :key="topic.id" v-bind:topic="topic"></topic-component>
                        <pages-component v-if="meta && links && topics.length" :for="compName" :meta="meta" :links="links"></pages-component>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import TopicComponent from './TopicComponent'
    import PagesComponent from './PagesComponent'
    import  eventHub  from "../events.js";

    export default {
        data(){
            return {
                compName: "topicsc",
                page: 1,
                topics: [],
                meta: {'last_page': 1},
                links: ['prev']
            }
                
            
        },
        methods: {
            getTopics(page){
                axios.get(`api/topics?page=${page}`).then((response)=>{
                    this.topics = response.data.data
                    this.meta = response.data.meta
                    this.links = response.data.links
                    console.log(this.topics)
                    console.log(this.meta)
                    console.log(this.links)

                })
            }

        },
        mounted() {
            this.getTopics(this.page)
            eventHub.$on('topicsc.switched-page', this.getTopics)
        },
        components:{
            TopicComponent, PagesComponent
        }
    }
</script>
