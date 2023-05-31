<template>
  <li class="my-5">
    <h3>{{ product.name }}</h3>
    <p>{{ product.description }}</p>
    <p>Precio: {{ product.price }}</p>
    <img :src="product.image_url" alt="Imagen del producto" :style="{ 'height': '150px', }" />
    <a :href="`/products/${product.slug}`">link to producto: {{ product.name }}</a>
  </li>
</template>

<script >
export default {
  props: {
    product: {
      type: Object,
      required: true,
    },
  },
};
</script>