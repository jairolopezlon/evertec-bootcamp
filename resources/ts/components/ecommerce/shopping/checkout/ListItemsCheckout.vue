<template>
  <div class="flex flex-col gap-4 grow-[1]">
    <item-checkout-card v-for="cartItem in getItems" :key="cartItem.productId" :productId="cartItem.productId" :token="props.token"></item-checkout-card>
  </div>
</template>

<script setup lang="ts">
import { useShoppingCart } from '@/composables';

const { getItems } = useShoppingCart()

const props = defineProps({
  token: {
    type: String,
    default: ''
  }
})

</script>