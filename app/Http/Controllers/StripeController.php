<?php

namespace App\Http\Controllers;

use App\Models\Carro;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class StripeController extends Controller
{
    public function checkout(Request $request)
    {
        $carroIds = array_filter(array_map('intval', $request->input('carros', [])));
        $carros   = Carro::whereIn('id', $carroIds)->get();

        if ($carros->isEmpty()) {
            return redirect()->route('carrinho');
        }

        Stripe::setApiKey(config('services.stripe.secret'));

        $lineItems = $carros->map(fn($c) => [
            'price_data' => [
                'currency'     => 'brl',
                'product_data' => ['name' => $c->veiculo_nome],
                'unit_amount'  => (int) round($c->preco * 100),
            ],
            'quantity' => 1,
        ])->values()->toArray();

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items'           => $lineItems,
            'mode'                 => 'payment',
            'metadata'             => [
                'carros'     => implode(',', $carroIds),
                'cliente_id' => Auth::guard('cliente')->id(),
            ],
            'success_url' => route('stripe.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url'  => route('checkout'),
        ]);

        return redirect($session->url);
    }

    public function success(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $session  = Session::retrieve($request->query('session_id'));
        $carroIds = explode(',', $session->metadata->carros);
        $cliente  = Auth::guard('cliente')->user();

        $ultimoPedido = null;

        foreach ($carroIds as $carroId) {
            $carro = Carro::find((int) $carroId);
            if (! $carro) continue;

            $ultimoPedido = Pedido::create([
                'cliente_id' => $cliente->id,
                'carro_id'   => $carro->id,
                'status'     => 'em_separacao',
                'pagamento'  => 'credito',
                'valor'      => $carro->preco,
            ]);

            $carro->update(['status' => 'reservado']);
        }

        if (! $ultimoPedido) {
            return redirect()->route('home');
        }

        return redirect()->route('pedido.show', $ultimoPedido->id);
    }

    public function cancel()
    {
        return redirect()->route('checkout')->with('error', 'Pagamento cancelado. Tente novamente.');
    }
}
