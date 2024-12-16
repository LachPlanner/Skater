import axios from 'axios';

// Hent den nuværende brugers kurv
export const getCart = async () => {
    try {
        const response = await axios.get('/cart');
        return response.data.cart; // Returner kurvens items
    } catch (error) {
        console.error('Error fetching cart:', error.response?.data?.message || error.message);
        throw error;
    }
};

// Tilføj et produkt til kurven
export const addToCart = async (productId: number, quantity: number = 1) => {
    try {
        const response = await axios.post('/cart', {
            product_id: productId,
            quantity: quantity,
        });
        return response.data.cart; // Returner den opdaterede kurv
    } catch (error) {
        console.error('Error adding to cart:', error.response?.data?.message || error.message);
        throw error;
    }
};

// Fjern et produkt fra kurven
export const removeFromCart = async (productId: number) => {
    try {
        const response = await axios.delete('/cart', {
            data: { product_id: productId },
        });
        return response.data.cart; // Returner den opdaterede kurv
    } catch (error) {
        console.error('Error removing from cart:', error.response?.data?.message || error.message);
        throw error;
    }
};

export const createOrder = async (orderDetails: {
    first_name: string;
    last_name: string;
    address: string;
    city: string;
    postal_code: string;
}) => {
    try {
        const response = await axios.post('/orders', orderDetails);
        return response.data;
    } catch (error: any) {
        console.error('Error creating order:', error.response?.data?.message || error.message);
        throw error.response?.data || error.message;
    }
};

