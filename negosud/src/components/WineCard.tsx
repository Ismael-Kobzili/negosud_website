import React from 'react';
import { Wine } from '../types';
import { Plus } from 'lucide-react';

interface WineCardProps {
  wine: Wine;
  onAddToCart: (wine: Wine) => void;
}

export function WineCard({ wine, onAddToCart }: WineCardProps) {
  return (
    <div className="bg-white rounded-lg shadow-lg overflow-hidden transform transition-transform hover:scale-[1.02]">
      <div className="relative">
        <img 
          src={wine.image} 
          alt={wine.name} 
          className="w-full h-64 object-cover"
        />
        <div className="absolute top-4 right-4">
          <span className="bg-burgundy-600 text-white px-3 py-1 rounded-full text-sm font-semibold">
            {wine.year}
          </span>
        </div>
      </div>
      <div className="p-6">
        <div className="flex justify-between items-start mb-3">
          <h3 className="text-xl font-bold text-burgundy-800">{wine.name}</h3>
          <span className="text-xl font-bold text-burgundy-600">{wine.price.toFixed(2)} €</span>
        </div>
        <p className="text-gray-600 mb-4 leading-relaxed">{wine.description}</p>
        <div className="flex gap-2 mb-4">
          <span className="text-sm bg-burgundy-50 text-burgundy-800 px-3 py-1 rounded-full font-medium">
            {wine.type}
          </span>
          <span className="text-sm bg-burgundy-50 text-burgundy-800 px-3 py-1 rounded-full font-medium">
            {wine.region}
          </span>
        </div>
        <button
          onClick={() => onAddToCart(wine)}
          className="w-full bg-burgundy-600 text-white px-4 py-3 rounded-md hover:bg-burgundy-700 flex items-center justify-center gap-2 font-semibold transition-colors"
        >
          <Plus size={18} />
          Ajouter au panier
        </button>
      </div>
    </div>
  );
}