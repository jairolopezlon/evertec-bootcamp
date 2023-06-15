import { useShoppingCartStore } from "@/store/"
import { storeToRefs } from "pinia";
import { everstoreApi } from "@/api";

export const useShoppingCart = () => {

  const shoppingCartStore = useShoppingCartStore()

  const {
    getItem,
    getItems,
    getItemsAmount,
    getTotalPrice,
    hasItem,
    itemsShoppingCart,
    totalItemsAmount,
    totalPrice,
    isLoading,
  } = storeToRefs(shoppingCartStore)

  const loadShoppingCart = async () => {

    const response = await everstoreApi.get(`shopping-cart`)

    if (response.status === 200) {
      shoppingCartStore.loadShoppingCart(Object.values(response.data))
    }
  }
  const removeCartItem = async (productId: string) => {

    const response = await everstoreApi.delete(`shopping-cart/${productId}`)

    if (response.status === 200) {
      shoppingCartStore.removeCartItem(productId)
    }
  }
  const addCartItem = async (productId: string, amount: number, _token: string) => {

    const response = await everstoreApi.post('shopping-cart', {
      _token,
      amount,
      productId
    })
    if (response.status === 200) {
      shoppingCartStore.addCartItem(response.data[productId])
    }
  }
  const decrementCartItem = async (productId: string, amount: number, _token: string) => {

    const response = await everstoreApi.patch(`shopping-cart/${productId}`, {
      _token,
      amount,
      option: 'DECREMENT',
    })

    if (response.status === 200) {
      shoppingCartStore.decrementCartItem(productId, amount)
    }
  }
  const incrementCartItem = async (productId: string, amount: number, _token: string) => {

    const response = await everstoreApi.patch(`shopping-cart/${productId}`, {
      _token,
      amount,
      option: 'INCREMENT',
    })

    if (response.status === 200) {
      if (shoppingCartStore.hasItem(productId)) {
        shoppingCartStore.incrementCartItem(productId, amount)
      } else {
        shoppingCartStore.addCartItem(response.data[productId])
      }
    }
  }

  return {
    // Properties
    totalPrice,
    totalItemsAmount,
    itemsShoppingCart,
    isLoading,

    // Computed
    getItem,
    getItemsAmount,
    getItems,
    getTotalPrice,

    // Methods
    loadShoppingCart,
    removeCartItem,
    addCartItem,
    decrementCartItem,
    incrementCartItem,
  }
}