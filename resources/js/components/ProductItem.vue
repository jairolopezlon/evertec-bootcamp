<template>
  <li class="my-5">
    <h3>{{ product.id }} {{ product.name }}</h3>
    <p>{{ product.description }}</p>
    <p>Precio: {{ product.price }}</p>
    <img :src="product.imageUrl" alt="Imagen del producto" :style="{ 'height': '150px', }" />
    <div class="flex gap-4">
      <div style="flex">
        <form action="/shopping-cart" method="post">
          <input type="hidden" name="_token" :value="product.token">
          <input type="hidden" name="productId" :value="product.id">
          <input type="hidden" name="amount" value="1">
          <button class="py-2 px-4 bg-red-200">Add to Cart</button>
        </form>
      </div>
      <div style="flex">
        <form action="/shopping-cart" method="post">
          <input type="hidden" name="_method" value="DELETE">
          <input type="hidden" name="_token" :value="product.token">
          <input type="hidden" name="productId" :value="product.id">
          <button class="py-2 px-4 bg-red-200">Delete</button>
        </form>
      </div>
      <div style="flex">
        <form action="/shopping-cart" method="post">
          <input type="hidden" name="_method" value="PATCH">
          <input type="hidden" name="_token" :value="product.token">
          <input type="hidden" name="productId" :value="product.id">
          <input type="hidden" name="option" value="INCREMENT">
          <input type="hidden" name="amount" value="5">
          <button class="py-2 px-4 bg-red-200">+5</button>
        </form>
      </div>
      <div style="flex">
        <form action="/shopping-cart" method="post">
          <input type="hidden" name="_method" value="PATCH">
          <input type="hidden" name="_token" :value="product.token">
          <input type="hidden" name="productId" :value="product.id">
          <input type="hidden" name="option" value="INCREMENT">
          <input type="hidden" name="amount" value="1">
          <button class="py-2 px-4 bg-red-200">+1</button>
        </form>
      </div>
      <div style="flex">
        <form action="/shopping-cart" method="post">
          <input type="hidden" name="_method" value="PATCH">
          <input type="hidden" name="_token" :value="product.token">
          <input type="hidden" name="productId" :value="product.id">
          <input type="hidden" name="option" value="DECREASE">
          <input type="hidden" name="amount" value="1">
          <button class="py-2 px-4 bg-red-200">-1</button>
        </form>
      </div>
      <div style="flex">
        <form action="/shopping-cart" method="post">
          <input type="hidden" name="_method" value="PATCH">
          <input type="hidden" name="_token" :value="product.token">
          <input type="hidden" name="productId" :value="product.id">
          <input type="hidden" name="option" value="DECREASE">
          <input type="hidden" name="amount" value="5">
          <button class="py-2 px-4 bg-red-200">-5</button>
        </form>
      </div>
    </div>
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