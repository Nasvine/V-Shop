https://www.linkedin.com/pulse/how-install-vue-3-laravel-10-vite-mahmoud-adel

























https://tailwindui.com/?ref=top



https://flowbite.com/docs/getting-started/vue/

https://inertiajs.com/links

https://element-plus.org/en-US/guide/installation.html

https://www.npmjs.com/package/vue-sweetalert2

https://heroicons.com/

https://tailblocks.cc/

https://headlessui.com/vue/menu

https://www.fakexy.com/

https://app.logo.com/editor/colors?logo=logo_817b696c-8da3-4afa-9474-adb7ce50823b&mode=edit




 npm install @headlessui/vue
 npm install @heroicons/vue@latest



public static function getCookieCartItems()
    {
        return json_decode(request()->cookie('cart_items', '[]'), true);
    }

Cette fonction est utilisée pour récupérer les éléments du panier stockés dans un cookie au format JSON. Voici une explication ligne par ligne :

    public static function getCookieCartItems(): C'est une méthode statique, ce qui signifie qu'elle peut être appelée directement sur la classe sans avoir besoin d'instancier un objet de cette classe.

    return json_decode(request()->cookie('cart_items', '[]'), true);: Cette ligne retourne les éléments du panier stockés dans un cookie au format JSON.

        request()->cookie('cart_items', '[]'): Utilise la façade request() de Laravel pour accéder aux données de la requête. En particulier, la méthode cookie('cart_items', '[]') récupère la valeur du cookie nommé 'cart_items'. Si ce cookie n'existe pas, la valeur par défaut est définie comme '[]' (une chaîne vide représentant un tableau JSON vide).

        json_decode(..., true): Utilise la fonction json_decode pour décoder la chaîne JSON récupérée à partir du cookie en un tableau associatif PHP. Le deuxième argument true indique que le résultat doit être retourné en tant que tableau associatif.

En résumé, cette fonction récupère les éléments du panier stockés dans un cookie nommé 'cart_items'. Si le cookie n'existe pas, elle retourne un tableau vide. Si le cookie existe, elle retourne le contenu du cookie, converti en tableau associatif à l'aide de json_decode. Cette approche est couramment utilisée pour stocker des informations temporaires côté client, comme les éléments d'un panier d'achat.