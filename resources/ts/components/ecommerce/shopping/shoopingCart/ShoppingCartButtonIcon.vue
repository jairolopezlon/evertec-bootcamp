<template>
  <a class="cart-button-icon" href="/shopping-cart">
    <div class="icon-container">
      <svg class="cart-icon-stroke" v-if="getItemsAmount === 0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"></path>
      </svg>
      <svg class="cart-icon-fill" v-else fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <path clip-rule="evenodd" fill-rule="evenodd" d="M6 5v1H4.667a1.75 1.75 0 00-1.743 1.598l-.826 9.5A1.75 1.75 0 003.84 19H16.16a1.75 1.75 0 001.743-1.902l-.826-9.5A1.75 1.75 0 0015.333 6H14V5a4 4 0 00-8 0zm4-2.5A2.5 2.5 0 007.5 5v1h5V5A2.5 2.5 0 0010 2.5zM7.5 10a2.5 2.5 0 005 0V8.75a.75.75 0 011.5 0V10a4 4 0 01-8 0V8.75a.75.75 0 011.5 0V10z"></path>
      </svg>
    </div>
    <div ref="badgetAmount" class="badget-amount">
      <span>{{ getItemsAmount > 99 ? `99+` : getItemsAmount }}</span>
    </div>
  </a>
</template>

<script setup lang="ts">
import { useShoppingCart } from "@/composables";
import { watch, ref } from "vue";

const { getItemsAmount, loadShoppingCart } = useShoppingCart()

const badgetAmount = ref(null)

// watch(getItemsAmount, () => {
//   if (badgetAmount !== null) {

//     badgetAmount.value.classList.add('animate-shake');
//     setTimeout(() => {
//       badgetAmount.value.classList.remove('animate-shake');
//     }, 500);
//   }
// })

loadShoppingCart()

</script>

<style>
@keyframes shake {
  0% {
    transform: translateY(0);
    scale: 1.2;
  }

  25% {
    transform: translateY(-10%);
  }

  50% {
    transform: translateY(10%);
    scale: .9;
  }

  75% {
    transform: translateY(-10%);
  }

  100% {
    transform: translateY(0);
    scale: 1;
  }
}

.animate-shake {
  animation: shake 0.5s ease-in;
}
</style>