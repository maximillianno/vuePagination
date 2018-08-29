<template>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item" v-bind:class="{'disabled': links.prev===null }">
            <a class="page-link" href="#" aria-label="Previous" @click.prevent="switchPage(meta.current_page - 1)">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
            </a>
            </li>
            <li v-for="page in parseInt(meta.last_page)" :key="page" 
                    class="page-item" v-bind:class="{ 'active': meta.current_page===page }">
                    <a class="page-link" @click.prevent="switchPage(page)" href="#">{{ page }}</a>
            </li>
            <li class="page-item" v-bind:class="{ disabled: links.next===null }">
            <a class="page-link" href="#" aria-label="Next" @click.prevent="switchPage(meta.current_page + 1)">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
            </a>
            </li>
        </ul>
    </nav>
</template>

<script>
    import  eventHub  from "../events.js";
    export default {
        props: ['meta', 'links'],
        mounted() {
            console.log('Component mounted.')
        },
        methods:{
            switchPage(page){
                eventHub.$emit('switched-page', page)

            }
        }
    }
</script>
