<template>
  <div class="flex flex-col gap-4">
    <h1>list cart item</h1>
    <div>
      total: {{ getTotalPrice }}
    </div>
    <ItemShoppingCartCard v-for=" cartItem in getItems" :key="cartItem.productId" :productId="cartItem.productId" :token="props.token">
    </ItemShoppingCartCard>
  </div>
</template>

<script setup lang="ts">
import { useShoppingCart } from '@/composables';

const { getTotalPrice, getItems } = useShoppingCart()

const props = defineProps({
  token: {
    type: String,
    default: ''
  }
})

</script>