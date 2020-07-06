<template>
    <table style="white-space:nowrap;" class="table table-bordered">
        <thead>
            <tr>
                <th v-for="column in columns" :key="column.name" @click="$emit('sort', column.name)"
                    :class="sortKey === column.name ? (sortOrders[column.name] > 0 ? 'sorting_asc' : 'sorting_desc') : 'sorting'"
                    :style="'width:'+column.width+';'+'cursor:pointer;'"
                    aria-label="CSS grade: activate to sort column descending" aria-sort="ascending">
                    {{column.label}}
                </th>
            </tr>
        </thead>
        <slot></slot>
    </table>
</template>

<script>
export default {
    props: ['columns', 'sortKey', 'sortOrders',]
}
</script>