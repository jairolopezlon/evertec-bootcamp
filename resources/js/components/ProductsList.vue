<template>
  <div>
    <h2>Listado de Productos</h2>
    <ul>
      <ProductItem v-for="product in products" :key="product.id" :product="product" />
    </ul>
  </div>
</template>

<script >
import ProductItem from './ProductItem.vue';

export default {
  props: {
    products: {
      type: Array,
      required: true,
      default: [ { name: 'random_1' }, { name: 'random_2' }, { name: 'random_3' }, ]
    },
  },
  components: {
    ProductItem,
  },
};
</script>