export interface Wine {
  id: string;
  name: string;
  description: string;
  price: number;
  image: string;
  type: 'red' | 'white' | 'rosé';
  year: number;
  region: string;
}

export interface CartItem {
  wine: Wine;
  quantity: number;
}