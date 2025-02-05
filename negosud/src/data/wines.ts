import { Wine } from '../types';

export const wines: Wine[] = [
  {
    id: '1',
    name: 'Fleur de Gascogne Blanc',
    description: 'Un vin blanc d\'exception, aux arômes intenses d\'agrumes et de fruits exotiques. Notes de pamplemousse et de fruit de la passion.',
    price: 15.90,
    image: 'https://images.unsplash.com/photo-1566754436893-98224ee05be4?auto=format&fit=crop&q=80&w=800',
    type: 'white',
    year: 2022,
    region: 'Saint-Mont'
  },
  {
    id: '2',
    name: 'Château Montus Prestige',
    description: 'Notre fierté, un Madiran d\'exception aux tanins soyeux et aux arômes complexes de fruits noirs, de cuir et d\'épices.',
    price: 45.00,
    image: 'https://images.unsplash.com/photo-1510812431401-41d2bd2722f3?auto=format&fit=crop&q=80&w=800',
    type: 'red',
    year: 2019,
    region: 'Madiran'
  },
  {
    id: '3',
    name: 'Rosé des Coteaux',
    description: 'Un rosé élégant et rafraîchissant, aux délicates notes de fraise des bois et de pêche blanche. Finale minérale.',
    price: 12.90,
    image: 'https://images.unsplash.com/photo-1558001373-7b93ee48ffa0?auto=format&fit=crop&q=80&w=800',
    type: 'rosé',
    year: 2022,
    region: 'Côtes de Gascogne'
  },
  {
    id: '4',
    name: 'Saint-Mont Réserve',
    description: 'Un rouge d\'exception, élevé en fûts de chêne. Notes de fruits rouges mûrs, de vanille et d\'épices douces.',
    price: 28.50,
    image: 'https://images.unsplash.com/photo-1506377247377-2a5b3b417ebb?auto=format&fit=crop&q=80&w=800',
    type: 'red',
    year: 2020,
    region: 'Saint-Mont'
  },
  {
    id: '5',
    name: 'Pacherenc du Vic-Bilh',
    description: 'Un blanc moelleux d\'exception, aux arômes de fruits confits, de miel et d\'abricot. Une douceur parfaitement équilibrée.',
    price: 32.00,
    image: 'https://images.unsplash.com/photo-1516594915697-87eb3b1c14ea?auto=format&fit=crop&q=80&w=800',
    type: 'white',
    year: 2021,
    region: 'Vic-Bilh'
  },
  {
    id: '6',
    name: 'Cuvée des Terroirs',
    description: 'Une cuvée spéciale issue de nos meilleures parcelles. Notes de cassis, de myrtille et de poivre noir.',
    price: 38.50,
    image: 'https://images.unsplash.com/photo-1586370434639-0fe43b2d32d6?auto=format&fit=crop&q=80&w=800',
    type: 'red',
    year: 2018,
    region: 'Madiran'
  }
];