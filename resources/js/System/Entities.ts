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