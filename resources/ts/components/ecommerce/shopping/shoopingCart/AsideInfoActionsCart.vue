<template>
  <div class="p-4 rounded-md min-w-[250px] gap-4 bg-indigo-50 flex flex-col self-start" style="width: min(250px, 100%);">
    <div class="flex flex-col gap-1">
      <div class="flex justify-between">
        <div>Numero de Items</div>
        <div class="font-bold">{{ getItemsAmount }}</div>
      </div>
      <div class="flex justify-between">
        <div>Total</div>
        <div class="font-bold">$ {{ getTotalPrice }}</div>
      </div>
    </div>
    <a href="/checkout" :class="`py-2 px-4 rounded-md bg-indigo-500 text-indigo-50 hover:bg-indigo-700 text-center ${getItemsAmount === 0 ? 'bg-indigo-300  hover:bg-indigo-300 pointer-events-none' : ''}`">
      Go to Checkout
    </a>
  </div>
</template>
<script setup lang="ts">
import { useShoppingCart } from '@/composables';

const { getTotalPrice, getItemsAmount } = useShoppingCart()

</script>