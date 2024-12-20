export interface Variants {
    id: number;
    variant_name: string;
    variant_index: number;
    image_path: string;
    product: Product;
}

export interface Product {
    id: number;
    variant_id: number;
    price: number;
}

export interface CartItem {
    id: number;
    product_id: number;
    quantity: number;
    price: number;
    product: {
        id: number;
        variant: {
            variant_name: string;
            image_path: string;
        };
    };
}

export interface CartProps {
    cartItems: Array<CartItem>;
    totalPrice: number;
}

export interface User {
    first_name: string;
    last_name: string;
    email:string;
}

export interface OrderItem {
    id: number;
    quantity: number;
    price: number;
    product: {
      id: number;
      variant: {
        variant_name: string;
        image_path: string;
      };
    };
  }

  export interface Order {
    id: number;
    address: string;
    city: string;
    postal_code: string;
    order_date: string;
    total_amount: number;
    items: Array<OrderItem>;
  }