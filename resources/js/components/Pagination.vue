<template>
    <nav class="pagination">
        <button v-if="pagination.prevPageUrl" class="btn btn-primary btn-sm" @click="$emit('prev')">
            Previous
        </button>
        <button class="btn btn-primary btn-sm" v-else :disabled="true">
            Previous
        </button>
        
        <span class="page-stats">Page {{pagination.from}} - {{pagination.to}} out of {{pagination.total}}</span>

        <button v-if="pagination.nextPageUrl" class="btn btn-primary btn-sm" @click="$emit('next');">
            Next
        </button>
        <button v-else class="btn btn-primary btn-sm" :disabled="true">
            Next
        </button>
    </nav>
</template>

<script>
export default {
     props: ['pagination']
}
</script>