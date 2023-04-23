<?php

namespace App\Http\Controllers;

use App\Enums\PaymentStatus;
use App\Models\DownloadItem;
use Carbon\Carbon;
use App\Models\Order;
use GuzzleHttp\Client;
use App\Models\Downloadable;
use Illuminate\Http\Request;
use App\Enums\DownloadLinkType;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Http;


class DashboardController extends Controller
{
    public function index()
    {
        return view('my-account.dashboard');
    }
    public function orders()
    {

        $orders = auth()->user()->orders()->withCount('products')->latest()->paginate(10);

        return view('my-account.orders', compact('orders'));
    }
    public function showOrder(Order $order)
    {
        Gate::authorize('view', $order);

        $order = $order->loadMissing('products');


        if ($order->is_paid) {

            $calculated_order_total = 0;
            foreach ($order->products as $product) {

                $calculated_order_total += $product->selling_price * ($product->pivot->quantity ?? 1);
            }
            if ($order->order_total != $calculated_order_total) {
                $order->update(['order_total' => $calculated_order_total]);
                return back()->with('message', 'Price updated');
            }

        }


        return view('my-account.order-details', compact('order'));
    }
    public function downloads()
    {
        $products = auth()->user()->purchasedItems()->with('downloadItems')->latest()->paginate(10);
        return view('my-account.downloads.index', compact('products'));

    }

    public function showDownload(Request $request, DownloadItem $downloadItem)
    {

        Gate::authorize('view', $downloadItem);
        if ($downloadItem->type == DownloadLinkType::googleDriveId) {
            $url = 'https://www.googleapis.com/drive/v3/files/' . $downloadItem->content . '/?key=' . env('GOOGLE_API_KAY');

            $response = Http::get($url);

            $jsonRes = $response->json();


            if (isset($jsonRes['name'])) {
                $filename = $jsonRes['name'];
                $mimeType = $jsonRes['mimeType'];

                header('Content-Type: ' . $mimeType);
                header('Content-Disposition: attachment; filename="' . $filename . '"');
                readfile($url . '&alt=media');
            } else {
                return back()->with('message', 'File not found');
            }



        } else if ($downloadItem->type == DownloadLinkType::localPath) {


            $path = storage_path($downloadItem->content);
            if (file_exists($path)) {
                return response()->download($path);
            } else {
                return back()->with('message', 'File not found');
            }

        } else if ($downloadItem->type == DownloadLinkType::directLink) {
            $url = $downloadItem->content;

            $client = new Client();
            $response = $client->head($url);

            $filename = pathinfo($url, PATHINFO_BASENAME);


            // Set content type header
            header('Content-Type: ' . $response->getHeaderLine('Content-Type'));

            // Set content disposition header to force download
            header('Content-Disposition: attachment; filename="' . $filename . '"');

            // Output file to browser
            readfile($url);
        }

    }

}