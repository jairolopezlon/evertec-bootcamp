<template>
  <div class="item-shopping-cart-card border-indigo-100 border-solid border-[1px] rounded-md p-4 flex gap-2 items-center">
    <div class="image-container min-w-[150px] w-[150px] bg-indigo-200 rounded-md overflow-hidden">
      <img class="max-w-full" :src="cartItem.imageUrl" :alt="cartItem.name">
    </div>
    <div class="info-container flex gap-8 self-stretch flex-grow justify-between">
      <div class="left-side-info flex flex-col justify-between">
        <div>
          <a class="font-bold" :href="`/products/slug}`">{{ cartItem.name }}</a>
          <div class="text-sm">{{ cartItem.description }}</div>
        </div>
        <modifier-cart-amount-button :productId="productId" :token="(token)"></modifier-cart-amount-button>
      </div>
      <div class="right-side-info flex flex-col justify-between items-end">
        <button @click="() => removeCartItem(productId)" class="remove-item w-5">
          <svg class="stroke-indigo-500 hover:stroke-indigo-700" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path>
          </svg>
        </button>
        <div class="price-info text-right text-sm">
          <div class="">unit price {{ cartItem.price }}</div>
          <div class="">total {{ parseFloat((cartItem.price * cartItem.amount).toFixed(2)) }}</div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import ModifierCartAmountButton from '@/components/ecommerce/shopping/shoopingCart/ModifierCartAmountButton.vue';
import { useShoppingCart } from '@/composables';

const { getItem, totalPrice, removeCartItem } = useShoppingCart()

const props = defineProps({
  productId: {
    type: String,
    require: true,
    default: ''
  },
  token: {
    type: String,
    require: true
  },
});

const cartItem = getItem.value(props.productId)

// const itemCart = reactive(getItem.value(props.productId))

// const totalPrice = computed(() => {
//   return (getCurrentCartItem.value.price * getCurrentCartItem.value.amount).toFixed(2);
// });

</script>

