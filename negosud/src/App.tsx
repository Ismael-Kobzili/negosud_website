import React, { useState } from 'react';
import { Wine, CartItem } from './types';
import { wines } from './data/wines';
import { WineCard } from './components/WineCard';
import { Cart } from './components/Cart';
import { GlassWater, ShoppingCart } from 'lucide-react';

function App() {
  const [cartItems, setCartItems] = useState<CartItem[]>([]);
  const [isCartOpen, setIsCartOpen] = useState(false);

  const addToCart = (wine: Wine) => {
    setCartItems(items => {
      const existingItem = items.find(item => item.wine.id === wine.id);
      if (existingItem) {
        return items.map(item =>
          item.wine.id === wine.id
            ? { ...item, quantity: item.quantity + 1 }
            : item
        );
      }
      return [...items, { wine, quantity: 1 }];
    });
  };

  const updateQuantity = (id: string, change: number) => {
    setCartItems(items =>
      items
        .map(item =>
          item.wine.id === id
            ? { ...item, quantity: Math.max(0, item.quantity + change) }
            : item
        )
        .filter(item => item.quantity > 0)
    );
  };

  const removeItem = (id: string) => {
    setCartItems(items => items.filter(item => item.wine.id !== id));
  };

  const totalItems = cartItems.reduce((sum, item) => sum + item.quantity, 0);

  return (
    <div className="min-h-screen bg-gray-50">
      {/* Header */}
      <header className="bg-burgundy-600 text-white">
        <div className="container mx-auto px-4 py-6">
          <div className="flex justify-between items-center">
            <div className="flex items-center gap-3">
              <GlassWater size={40} className="text-white" />
              <div>
                <h1 className="text-3xl font-bold">Negosud</h1>
                <p className="text-sm text-burgundy-100">Négociant en Vins de Gascogne</p>
              </div>
            </div>
            <button
              onClick={() => setIsCartOpen(true)}
              className="flex items-center gap-2 bg-burgundy-700 px-4 py-2 rounded-md hover:bg-burgundy-800"
            >
              <ShoppingCart />
              <span className="font-semibold">Panier ({totalItems})</span>
            </button>
          </div>
        </div>
      </header>

      {/* Hero Section */}
      <div
        className="bg-cover bg-center h-[600px] flex items-center relative"
        style={{
          backgroundImage: 'url(https://images.unsplash.com/photo-1528823872057-9c018a7a7553?auto=format&fit=crop&q=80&w=1920)'
        }}
      >
        <div className="absolute inset-0 bg-black bg-opacity-40"></div>
        <div className="container mx-auto px-4 relative">
          <div className="max-w-3xl text-white">
            <h2 className="text-5xl font-bold mb-6">L'Excellence des Vins de Gascogne</h2>
            <p className="text-xl mb-8 leading-relaxed">
              Depuis plus de 20 ans, Negosud sélectionne avec passion les meilleurs vins 
              de Gascogne. Notre expertise œnologique et notre connaissance approfondie 
              du terroir nous permettent de vous proposer des vins d'exception.
            </p>
            <div className="flex gap-6">
              <div className="text-center">
                <p className="text-4xl font-bold mb-2">25+</p>
                <p className="text-sm">Années d'Expertise</p>
              </div>
              <div className="text-center">
                <p className="text-4xl font-bold mb-2">150+</p>
                <p className="text-sm">Vignerons Partenaires</p>
              </div>
              <div className="text-center">
                <p className="text-4xl font-bold mb-2">1000+</p>
                <p className="text-sm">Clients Satisfaits</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      {/* About Section */}
      <section className="py-16 bg-white">
        <div className="container mx-auto px-4">
          <div className="max-w-3xl mx-auto text-center">
            <h3 className="text-3xl font-bold mb-6 text-burgundy-800">Notre Engagement</h3>
            <p className="text-gray-600 leading-relaxed mb-8">
              En tant qu'œnologues passionnés, nous parcourons les vignobles de Gascogne 
              à la recherche des meilleurs vins. Notre expertise nous permet de sélectionner 
              des vins authentiques qui reflètent la richesse de notre terroir.
            </p>
            <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
              <div className="p-6 bg-burgundy-50 rounded-lg">
                <h4 className="font-semibold text-lg mb-2">Sélection Rigoureuse</h4>
                <p className="text-gray-600">Chaque vin est soigneusement choisi pour sa qualité exceptionnelle</p>
              </div>
              <div className="p-6 bg-burgundy-50 rounded-lg">
                <h4 className="font-semibold text-lg mb-2">Conseil Expert</h4>
                <p className="text-gray-600">Notre équipe d'œnologues vous guide dans vos choix</p>
              </div>
              <div className="p-6 bg-burgundy-50 rounded-lg">
                <h4 className="font-semibold text-lg mb-2">Livraison Soignée</h4>
                <p className="text-gray-600">Transport dans des conditions optimales</p>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Wine Selection */}
      <main className="container mx-auto px-4 py-16">
        <h3 className="text-3xl font-bold mb-8 text-center text-burgundy-800">Notre Sélection de Vins</h3>
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          {wines.map(wine => (
            <WineCard
              key={wine.id}
              wine={wine}
              onAddToCart={addToCart}
            />
          ))}
        </div>
      </main>

      {/* Footer */}
      <footer className="bg-burgundy-900 text-white py-12">
        <div className="container mx-auto px-4">
          <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
              <h4 className="text-xl font-bold mb-4">Negosud</h4>
              <p className="text-burgundy-100">
                Expert en vins de Gascogne depuis 1998
              </p>
            </div>
            <div>
              <h4 className="text-xl font-bold mb-4">Contact</h4>
              <p className="text-burgundy-100">
                123 Route des Vignes<br />
                32000 Auch<br />
                05.62.XX.XX.XX<br />
                contact@negosud.fr
              </p>
            </div>
            <div>
              <h4 className="text-xl font-bold mb-4">Horaires</h4>
              <p className="text-burgundy-100">
                Lundi - Vendredi: 9h - 18h<br />
                Samedi: 10h - 16h<br />
                Dimanche: Fermé
              </p>
            </div>
          </div>
        </div>
      </footer>

      {/* Cart */}
      <Cart
        items={cartItems}
        onUpdateQuantity={updateQuantity}
        onRemoveItem={removeItem}
        isOpen={isCartOpen}
        onClose={() => setIsCartOpen(false)}
      />
    </div>
  );
}

export default App;