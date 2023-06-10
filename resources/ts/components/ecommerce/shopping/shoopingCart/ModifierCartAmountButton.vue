<template>
  <div class="modifier-cart-amount-button">
    <button @click="() => decrementCartItem(props.productId, 1, props.token)">
      <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <path clip-rule="evenodd" fill-rule="evenodd" d="M5.25 12a.75.75 0 01.75-.75h12a.75.75 0 010 1.5H6a.75.75 0 01-.75-.75z"></path>
      </svg>
    </button>
    <span>{{ cartItem.amount }}</span>
    <button @click="() => incrementCartItem(props.productId, 1, props.token)">
      <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <path clip-rule="evenodd" fill-rule="evenodd" d="M12 5.25a.75.75 0 01.75.75v5.25H18a.75.75 0 010 1.5h-5.25V18a.75.75 0 01-1.5 0v-5.25H6a.75.75 0 010-1.5h5.25V6a.75.75 0 01.75-.75z"></path>
      </svg>
    </button>
  </div>
</template>

<script setup lang="ts">
import { useShoppingCart } from '@/composables';

const props = defineProps({
  productId: {
    type: String,
    default: '',
  },
  token: {
    type: String,
    default: '',
  },
})

const { incrementCartItem, decrementCartItem, getItem } = useShoppingCart()

const cartItem = getItem.value(props.productId)

</script>