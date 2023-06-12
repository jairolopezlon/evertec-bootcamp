<template>
  <div>
    <h2>Listado de Productos</h2>
    <ul>
      <ProductItem v-for="product in products" :key="product.id" :product="product" />
    </ul>
  </div>
</template>

<script setup lang="ts">
// import ProductItem from './ProductItem.vue';
import ProductItem from '@/components/ProductItem.vue'

const props = defineProps({
  products: {
    type: Array<any>,
    default: [],
  }
})

</script>