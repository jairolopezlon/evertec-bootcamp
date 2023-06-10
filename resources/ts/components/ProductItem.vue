<template>
  <li class="my-5">
    <h3>{{ props.product.id }} {{ props.product.name }}</h3>
    <p>{{ props.product.description }}</p>
    <p>ID: {{ props.product.id }}</p>
    <p>Precio: {{ props.product.price }}</p>
    <p>en carrito: {{ getItem(props.product.id) ? 'OOO' : 'XXX' }}</p>
    <img :src="props.product.imageUrl" alt="Imagen del producto" :style="{ 'height': '150px', }" />
    <div class="flex gap-4">
      <button class="py-2 px-4 bg-red-200" @click="() => addCartItem(props.product.id, 1, props.product.token)">Add to Cart</button>
      <button class="py-2 px-4 bg-red-200" @click="() => removeCartItem(props.product.id)">Remove</button>
      <button class="py-2 px-4 bg-red-200" @click="() => incrementCartItem(props.product.id, 5, props.product.token)">+5</button>
      <button class="py-2 px-4 bg-red-200" @click="() => incrementCartItem(props.product.id, 1, props.product.token)">+1</button>
      <button class="py-2 px-4 bg-red-200" @click="() => decrementCartItem(props.product.id, 1, props.product.token)">-1</button>
      <button class="py-2 px-4 bg-red-200" @click="() => decrementCartItem(props.product.id, 5, props.product.token)">-5</button>
    </div>
    <a :href="`/products/${props.product.slug}`">link to producto: {{ props.product.name }}</a>
  </li>
</template>

<script setup lang="ts">
import { useShoppingCart } from '@/composables';

const { addCartItem, removeCartItem, incrementCartItem, decrementCartItem, getItem } = useShoppingCart()

const props = defineProps({
  product: {
    type: Object,
    default: [],
  }
})

</script>