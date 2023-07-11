<template>
  <div class="flex flex-col gap-2 bg-indigo-50 rounded-md p-4 min-w-[250px] self-start" style="width:min(100%, 250px)">
    <h3 class="text-lg font-bold">Payment Information</h3>
    <form action="/payments" method="POST" class="w-full flex flex-col gap-4">
      <input type="hidden" name="_token" :value="props.token">
      <div class="flex flex-col gap-2">
        <div>
          <label class="text-xs pl-2" for="paymentProvider">Payment Method</label>
          <select class="px-2 py-1 rounded-sm text-sm w-full focus:outline-4 focus:outline-indigo-300 active:outline-4 active:outline-indigo-300 placeholder-indigo-300 text-indigo-900" name="paymentProvider" id="paymentProvider" required>
            <option value="PLACETOPAY">Place to Pay</option>
            <option value="MERCADOPAGO">Mercado Pago</option>
            <option value="PAYPAL">PayPal</option>
          </select>
        </div>
        <div>
          <label class="text-xs pl-2" for="currency">Currency</label>
          <select class="px-2 py-1 rounded-sm text-sm w-full focus:outline-4 focus:outline-indigo-300 active:outline-4 active:outline-indigo-300 placeholder-indigo-300 text-indigo-900" name="currency" id="currency" required>
            <option value="COP">Pesos colombianos</option>
            <option value="USD">Dolar EEUU</option>
          </select>
        </div>
      </div>
      <div class="flex justify-between">
        <div>Total</div>
        <div class="font-bold">$ {{ getTotalPrice }}</div>
      </div>
      <button class="py-2 px-4 rounded-md bg-indigo-500 text-indigo-50 hover:bg-indigo-700 text-center w-full">
        Proceed to Payment
      </button>
    </form>
  </div>
</template>

<script setup lang="ts">
import { useShoppingCart } from '@/composables';

const props = defineProps({
  token: {
    type: String,
    require: true
  },
})

const { getTotalPrice } = useShoppingCart()

</script>