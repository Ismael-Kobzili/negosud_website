import React from 'react';
import { CartItem } from '../types';
import { Minus, Plus, ShoppingCart, X } from 'lucide-react';

interface CartProps {
  items: CartItem[];
  onUpdateQuantity: (id: string, change: number) => void;
  onRemoveItem: (id: string) => void;
  isOpen: boolean;
  onClose: () => void;
}

export function Cart({ items, onUpdateQuantity, onRemoveItem, isOpen, onClose }: CartProps) {
  const total = items.reduce((sum, item) => sum + item.wine.price * item.quantity, 0);

  if (!isOpen) return null;

  return (
    <div className="fixed inset-0 bg-black bg-opacity-50 z-50 flex justify-end">
      <div className="bg-white w-full max-w-md h-full p-6 overflow-y-auto">
        <div className="flex justify-between items-center mb-6">
          <h2 className="text-2xl font-bold text-burgundy-800 flex items-center gap-2">
            <ShoppingCart className="text-burgundy-600" />
            Votre Panier
          </h2>
          <button 
            onClick={onClose}
            className="text-gray-500 hover:text-burgundy-600 transition-colors"
          >
            <X size={24} />
          </button>
        </div>

        {items.length === 0 ? (
          <div className="text-center py-8">
            <p className="text-gray-500 mb-4">Votre panier est vide</p>
            <button
              onClick={onClose}
              className="text-burgundy-600 font-semibold hover:text-burgundy-700"
            >
              Continuer mes achats
            </button>
          </div>
        ) : (
          <>
            <div className="space-y-6">
              {items.map((item) => (
                <div key={item.wine.id} className="flex gap-4 border-b border-gray-100 pb-6">
                  <img
                    src={item.wine.image}
                    alt={item.wine.name}
                    className="w-24 h-24 object-cover rounded-lg"
                  />
                  <div className="flex-1">
                    <div className="flex justify-between">
                      <h3 className="font-semibold text-burgundy-800">{item.wine.name}</h3>
                      <button
                        onClick={() => onRemoveItem(item.wine.id)}
                        className="text-gray-400 hover:text-burgundy-600 transition-colors"
                      >
                        <X size={20} />
                      </button>
                    </div>
                    <p className="text-burgundy-600 font-semibold mt-1">
                      {item.wine.price.toFixed(2)} €
                    </p>
                    <div className="flex items-center gap-3 mt-3">
                      <button
                        onClick={() => onUpdateQuantity(item.wine.id, -1)}
                        className="p-1 rounded-full hover:bg-burgundy-50 text-burgundy-600"
                      >
                        <Minus size={16} />
                      </button>
                      <span className="font-medium w-8 text-center">{item.quantity}</span>
                      <button
                        onClick={() => onUpdateQuantity(item.wine.id, 1)}
                        className="p-1 rounded-full hover:bg-burgundy-50 text-burgundy-600"
                      >
                        <Plus size={16} />
                      </button>
                    </div>
                  </div>
                </div>
              ))}
            </div>
            <div className="mt-8 border-t border-gray-100 pt-6">
              <div className="flex justify-between items-center text-xl font-bold text-burgundy-800 mb-6">
                <span>Total</span>
                <span>{total.toFixed(2)} €</span>
              </div>
              <button className="w-full bg-burgundy-600 text-white py-4 rounded-lg font-semibold hover:bg-burgundy-700 transition-colors">
                Finaliser la commande
              </button>
              <button
                onClick={onClose}
                className="w-full text-burgundy-600 py-3 mt-3 font-semibold hover:text-burgundy-700"
              >
                Continuer mes achats
              </button>
            </div>
          </>
        )}
      </div>
    </div>
  );
}