import { defineStore } from "pinia"
import { ItemShoppingCart } from "@/interfaces/ItemShoppingCart"

interface ItemShoppingCartObj {
  [key: string]: ItemShoppingCart
}

interface ShoppingCartState {
  itemsShoppingCart: ItemShoppingCartObj,
  totalPrice: number,
  totalItemsAmount: number,
  isLoading: boolean,
}

export const useShoppingCartStore = defineStore('shoppingCart', {
  state: (): ShoppingCartState => ({
    itemsShoppingCart: {},
    totalPrice: 0,
    totalItemsAmount: 0,
    isLoading: true,
  }),
  getters: {
    getItems: (state: ShoppingCartState) => {
      return Object.values(state.itemsShoppingCart)
    },
    getItem: (state: ShoppingCartState) => (productId: string) => {
      return state.itemsShoppingCart[productId]
    },
    getTotalPrice: (state: ShoppingCartState) => {
      return Object.values(state.itemsShoppingCart).reduce((acc: number, cur: ItemShoppingCart) => {
        return parseFloat((acc + cur.price * cur.amount).toFixed(2))
      }, 0)
    },
    getItemsAmount: (state: ShoppingCartState) => {
      return Object.values(state.itemsShoppingCart).reduce((acc: number, cur: ItemShoppingCart) => {
        return acc + cur.amount
      }, 0)
    },
    hasItem: (state: ShoppingCartState) => (productId: string) => {
      return Object.hasOwn(state.itemsShoppingCart, productId)
    }
  },
  actions: {
    incrementCartItem(productId: string, amount: number) {
      this.itemsShoppingCart[productId].amount += amount
    },
    decrementCartItem(productId: string, amount: number) {
      this.itemsShoppingCart[productId].amount -= amount
      if (this.itemsShoppingCart[productId].amount <= 0) {
        delete this.itemsShoppingCart[productId]
      }
    },

    addCartItem(itemShoppingCart: ItemShoppingCart) {
      if (Object.hasOwn(this.itemsShoppingCart, itemShoppingCart.productId)) {
        this.itemsShoppingCart[itemShoppingCart.productId].amount += 1
      } else {
        this.itemsShoppingCart[itemShoppingCart.productId] = itemShoppingCart
      }
    },

    removeCartItem(productId: string) {
      if (this.itemsShoppingCart[productId]) {
        delete this.itemsShoppingCart[productId]
      }
    },

    loadShoppingCart(data: ItemShoppingCart[]) {
      data.forEach(cartItem => {
        this.itemsShoppingCart[cartItem.productId] = cartItem
      })
      this.isLoading = false
    }
  },
})
