<?php

namespace App\Helper;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cookie;

class Cart
{
    public static function getCount(): int
    {
        if ($user = auth()->user()) {
            return CartItem::whereUserId($user->id)->count(); //sum('quantity')
        } else {
            return array_reduce(self::getCookieCartItems(), fn ($carry) => $carry + 1, 0);
        }
    }

    public static function getCartItems()
    {
        if ($user = auth()->user()) {
            return CartItem::whereUserId($user->id)->get()->map(fn (CartItem $item) => ['product_id' => $item->product_id, 'quantity' => $item->quantity]);
        } else {
            return self::getCookieCartItems();
        }
    }

    public static function getCookieCartItems()
    {
        return json_decode(request()->cookie('cart_items', '[]'), true);
    }

    public static function setCookieCartItems(array $cartItems)
    {
        Cookie::queue('cart_items', json_encode($cartItems), 60*24*30);
    }

    public static function saveCookieCartItems()
    {
        $user = auth()->user();
        $userCartItems = CartItem::where(['user_id' => $user->id])->get()->keyBy('product_id');
        $savedCartItems = [];
        foreach (self::getCookieCartItems() as $cartItem) {
            if (isset($userCartItems[$cartItem['product_id']])) {
                $userCartItems[$cartItem['product_id']]->update(['quantity' => $cartItem['quantity']]);
                continue;
            }
            $savedCartItems[] = [
                'user_id' => $user->id,
                'product_id' => $cartItem['product_id'],
                'quantity' => $cartItem['quantity'],
            ];
        }
        if (!empty($savedCartItems)) {
            CartItem::insert($savedCartItems);
        }
    }

    public static function moveCartItemsIntoDb()
    {
        $request = request();
        $cartItems = self::getCookieCartItems();
        $newCartItems = [];
        foreach ($cartItems as $cartItem) {
            // Check if the record already exists in the database
            $existingCartItem = CartItem::where([
                'user_id' => $request->user()->id,
                'product_id' => $cartItem['product_id'],
            ])->first();

            if (!$existingCartItem) {
                // Only insert if it doesn't already exist
                $newCartItems[] = [
                    'user_id' => $request->user()->id,
                    'product_id' => $cartItem['product_id'],
                    'quantity' => $cartItem['quantity'],
                ];
            }
        }


        if (!empty($newCartItems)) {
            // Insert the new cart items into the database
            CartItem::insert($newCartItems);
        }
    }


    public static function getProductsAndCartItems()
    {
        $cartItems = self::getCartItems();

        $ids = Arr::pluck($cartItems, 'product_id');
        $products = Product::whereIn('id', $ids)->with('product_images')->get();
        $cartItems = Arr::keyBy($cartItems, 'product_id');
        return [$products, $cartItems];
    }
}

// Bien sûr, je vais expliquer chaque fonction dans cet assistant Cart pas à pas :

//     getCount:
//         Cette fonction retourne le nombre total d'articles dans le panier.
//         Si l'utilisateur est authentifié, elle compte le nombre d'articles dans le panier de l'utilisateur enregistré en base de données.
//         Sinon, elle compte le nombre d'articles dans le panier stocké dans les cookies.

//     getCartItems:
//         Cette fonction retourne les articles du panier.
//         Si l'utilisateur est authentifié, elle récupère les articles du panier de l'utilisateur enregistré en base de données.
//         Sinon, elle récupère les articles du panier stocké dans les cookies.

//     getCookieCartItems:
//         Cette fonction récupère les articles du panier stockés dans les cookies et les renvoie sous forme de tableau.

//     setCookieCartItems:
//         Cette fonction enregistre les articles du panier dans les cookies.
//         Elle prend un tableau d'articles du panier en paramètre et le convertit en format JSON avant de le stocker dans les cookies.

//     saveCookieCartItems:
//         Cette fonction sauvegarde les articles du panier stockés dans les cookies dans la base de données de l'utilisateur authentifié.
//         Elle compare les articles du panier dans les cookies avec ceux déjà enregistrés en base de données et met à jour les quantités si nécessaire. Elle insère également les nouveaux articles dans la base de données.

//     moveCartItemsIntoDb:
//         Cette fonction déplace les articles du panier stockés dans les cookies vers la base de données de l'utilisateur authentifié.
//         Elle vérifie d'abord si un article du panier existe déjà en base de données avant de décider de l'insérer.
//         Elle insère les nouveaux articles du panier dans la base de données.

//     getProductsAndCartItems:
//         Cette fonction retourne à la fois les produits associés aux articles du panier et les articles du panier eux-mêmes.
//         Elle utilise les IDs des produits dans le panier pour récupérer les détails des produits depuis la base de données.
//         Elle retourne deux tableaux, l'un avec les produits et l'autre avec les articles du panier, organisés par l'ID du produit.

// Cet assistant semble être un gestionnaire de panier pour un site e-commerce, qui gère à la fois les informations du panier enregistrées dans la base de données et les informations temporaires stockées dans les cookies.
