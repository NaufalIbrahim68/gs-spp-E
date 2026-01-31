@extends('layouts.front')
@section('title', 'Detail Pesanan')
@section('content')
<div class="page-title light-background">
    <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Detail Pesanan</h1>
        <nav class="breadcrumbs">
            <ol>
                <li><a href="{{ route('front.index') }}">Home</a></li>
                <li><a href="{{ route('customer.dashboard') }}">Akun</a></li>
                <li class="current">Detail Pesanan</li>
            </ol>
        </nav>
    </div>
</div>

<section class="section">
    <div class="container">

      <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card card-body border-0 shadow-sm">
                <h5 class="mb-3">
                    <i class="bi bi-truck me-2" style="color: #ff6b35;"></i>
                    Status Pengiriman
                </h5>
                
                <div class="tracking-container">
                    <!-- Asphalt Road -->
                    <div class="road">
                        <div class="road-line"></div>
                        <div class="road-line"></div>
                        <div class="road-line"></div>
                    </div>
                    
                    <!-- Delivery Truck -->
                    <div class="delivery-truck" id="truck-icon">
                        <!-- Truck Body -->
                        <div class="truck-body">
                            <div class="truck-cabin"></div>
                            <div class="truck-cargo"></div>
                            <div class="truck-window"></div>
                        </div>
                        <!-- Wheels -->
                        <div class="wheels">
                            <div class="wheel wheel-front">
                                <div class="wheel-inner"></div>
                            </div>
                            <div class="wheel wheel-back">
                                <div class="wheel-inner"></div>
                            </div>
                        </div>
                        <!-- Dust Effect -->
                        <div class="dust-container">
                            <span class="dust"></span>
                            <span class="dust"></span>
                            <span class="dust"></span>
                        </div>
                        <!-- Natural Shadow -->
                        <div class="truck-shadow-realistic"></div>
                    </div>
                    
                    <!-- Milestones / Checkpoints -->
                    <div class="milestones">
                        <div class="milestone {{ $order->shipping_status == 'pending' || $order->shipping_status == 'packed' || $order->shipping_status == 'shipped' || $order->shipping_status == 'in_transit' || $order->shipping_status == 'delivered' ? 'reached' : '' }}">
                            <div class="milestone-marker">
                                <i class="bi bi-hourglass-split"></i>
                            </div>
                            <span class="milestone-label">Pending</span>
                        </div>
                        <div class="milestone {{ $order->shipping_status == 'packed' || $order->shipping_status == 'shipped' || $order->shipping_status == 'in_transit' || $order->shipping_status == 'delivered' ? 'reached' : '' }}">
                            <div class="milestone-marker">
                                <i class="bi bi-box-seam"></i>
                            </div>
                            <span class="milestone-label">Packed</span>
                        </div>
                        <div class="milestone {{ $order->shipping_status == 'shipped' || $order->shipping_status == 'in_transit' || $order->shipping_status == 'delivered' ? 'reached' : '' }}">
                            <div class="milestone-marker">
                                <i class="bi bi-send"></i>
                            </div>
                            <span class="milestone-label">Shipped</span>
                        </div>
                        <div class="milestone {{ $order->shipping_status == 'in_transit' || $order->shipping_status == 'delivered' ? 'reached' : '' }}">
                            <div class="milestone-marker">
                                <i class="bi bi-arrow-repeat"></i>
                            </div>
                            <span class="milestone-label">In Transit</span>
                        </div>
                        <div class="milestone {{ $order->shipping_status == 'delivered' ? 'reached' : '' }}">
                            <div class="milestone-marker">
                                <i class="bi bi-house-check"></i>
                            </div>
                            <span class="milestone-label">Delivered</span>
                        </div>
                    </div>
                </div>
                
                <style>
                    /* Main Container - Realistic Scene */
                    .tracking-container {
                        position: relative;
                        background: linear-gradient(to bottom, #87CEEB 0%, #E0F6FF 50%, #90EE90 100%);
                        padding: 80px 20px 50px;
                        border-radius: 15px;
                        overflow: hidden;
                        min-height: 200px;
                    }
                    
                    /* Asphalt Road */
                    .road {
                        position: absolute;
                        bottom: 70px;
                        left: 0;
                        right: 0;
                        height: 60px;
                        background: linear-gradient(to bottom, #4a4a4a 0%, #333 50%, #2a2a2a 100%);
                        box-shadow: inset 0 3px 8px rgba(0,0,0,0.4), 
                                    0 2px 0 rgba(255,255,255,0.05);
                        z-index: 1;
                    }
                    
                    /* Road Dashed Lines */
                    .road-line {
                        position: absolute;
                        top: 50%;
                        transform: translateY(-50%);
                        width: 40px;
                        height: 3px;
                        background: #FFD700;
                        border-radius: 2px;
                        opacity: 0.8;
                        animation: roadLineMove 2s linear infinite;
                    }
                    
                    .road-line:nth-child(1) { left: 10%; animation-delay: 0s; }
                    .road-line:nth-child(2) { left: 40%; animation-delay: 0.6s; }
                    .road-line:nth-child(3) { left: 70%; animation-delay: 1.2s; }
                    
                    @keyframes roadLineMove {
                        0% { opacity: 0.3; }
                        50% { opacity: 0.8; }
                        100% { opacity: 0.3; }
                    }
                    
                    /* Delivery Truck - Realistic Design */
                    .delivery-truck {
                        position: absolute;
                        bottom: 90px;
                        left: 5%;
                        z-index: 3;
                        transition: left 3s cubic-bezier(0.45, 0.05, 0.55, 0.95);
                    }
                    
                    /* Truck Body */
                    .truck-body {
                        position: relative;
                        display: flex;
                        align-items: flex-end;
                        transform: scaleX(-1); /* Flip truck to face right */
                    }
                    
                    /* Truck Cabin */
                    .truck-cabin {
                        width: 35px;
                        height: 40px;
                        background: linear-gradient(135deg, #ff6b35 0%, #ff8555 100%);
                        border-radius: 6px 6px 0 0;
                        position: relative;
                        box-shadow: 2px 2px 8px rgba(0,0,0,0.3);
                        border: 2px solid #e55525;
                    }
                    
                    /* Truck Cargo Box */
                    .truck-cargo {
                        width: 50px;
                        height: 35px;
                        background: linear-gradient(135deg, #f5f5f5 0%, #e0e0e0 100%);
                        border-radius: 3px 3px 0 0;
                        position: relative;
                        margin-left: -3px;
                        box-shadow: 2px 2px 8px rgba(0,0,0,0.3);
                        border: 2px solid #ccc;
                    }
                    
                    .truck-cargo::before {
                        content: '📦';
                        position: absolute;
                        top: 50%;
                        left: 50%;
                        transform: translate(-50%, -50%);
                        font-size: 18px;
                    }
                    
                    /* Truck Window */
                    .truck-window {
                        position: absolute;
                        left: 5px;
                        top: 8px;
                        width: 20px;
                        height: 15px;
                        background: linear-gradient(135deg, #87CEEB 0%, #b0e0f0 100%);
                        border-radius: 3px;
                        border: 1px solid #333;
                        box-shadow: inset 0 0 5px rgba(255,255,255,0.5);
                    }
                    
                    /* Wheels */
                    .wheels {
                        position: absolute;
                        bottom: -15px;
                        width: 100%;
                        display: flex;
                        justify-content: space-between;
                    }
                    
                    .wheel {
                        width: 22px;
                        height: 22px;
                        background: radial-gradient(circle, #1a1a1a 30%, #000 70%);
                        border-radius: 50%;
                        border: 3px solid #333;
                        box-shadow: 0 2px 5px rgba(0,0,0,0.5),
                                    inset 0 0 5px rgba(255,255,255,0.2);
                        animation: wheelRotate 0.6s linear infinite;
                        position: relative;
                    }
                    
                    .wheel-front { margin-left: 8px; }
                    .wheel-back { margin-right: 15px; }
                    
                    .wheel-inner {
                        position: absolute;
                        top: 50%;
                        left: 50%;
                        transform: translate(-50%, -50%);
                        width: 8px;
                        height: 8px;
                        background: #666;
                        border-radius: 50%;
                    }
                    
                    .wheel-inner::before,
                    .wheel-inner::after {
                        content: '';
                        position: absolute;
                        background: #666;
                        top: 50%;
                        left: 50%;
                        transform: translate(-50%, -50%);
                    }
                    
                    .wheel-inner::before {
                        width: 2px;
                        height: 12px;
                    }
                    
                    .wheel-inner::after {
                        width: 12px;
                        height: 2px;
                    }
                    
                    @keyframes wheelRotate {
                        0% { transform: rotate(0deg); }
                        100% { transform: rotate(360deg); }
                    }
                    
                    /* Natural Truck Shadow */
                    .truck-shadow-realistic {
                        position: absolute;
                        bottom: -18px;
                        left: 10px;
                        width: 75px;
                        height: 8px;
                        background: rgba(0, 0, 0, 0.25);
                        border-radius: 50%;
                        filter: blur(3px);
                    }
                    
                    /* Dust Effect */
                    .dust-container {
                        position: absolute;
                        bottom: -10px;
                        left: -15px;
                        width: 30px;
                        height: 20px;
                    }
                    
                    .dust {
                        position: absolute;
                        width: 6px;
                        height: 6px;
                        background: rgba(139, 90, 43, 0.4);
                        border-radius: 50%;
                        animation: dustMove 1.2s ease-out infinite;
                    }
                    
                    .dust:nth-child(1) { 
                        left: 0; 
                        animation-delay: 0s; 
                    }
                    .dust:nth-child(2) { 
                        left: 8px; 
                        animation-delay: 0.3s; 
                    }
                    .dust:nth-child(3) { 
                        left: 16px; 
                        animation-delay: 0.6s; 
                    }
                    
                    @keyframes dustMove {
                        0% {
                            transform: translate(0, 0) scale(1);
                            opacity: 0.6;
                        }
                        100% {
                            transform: translate(-30px, -10px) scale(0);
                            opacity: 0;
                        }
                    }
                    
                    /* Truck Vibration (Natural Road Movement) */
                    @if($order->shipping_status == 'in_transit')
                        .delivery-truck {
                            animation: truckVibrate 0.15s ease-in-out infinite;
                        }
                        @keyframes truckVibrate {
                            0%, 100% { transform: translateY(0); }
                            25% { transform: translateY(-1px); }
                            75% { transform: translateY(1px); }
                        }
                        
                        .wheel {
                            animation: wheelRotate 0.3s linear infinite !important;
                        }
                        
                        .dust {
                            animation: dustMove 0.8s ease-out infinite !important;
                        }
                    @endif
                    
                    /* Stopped Truck */
                    @if($order->shipping_status == 'delivered')
                        .wheel {
                            animation: none !important;
                        }
                        .dust {
                            display: none;
                        }
                    @endif
                    
                    /* Truck Positions */
                    @if($order->shipping_status == 'pending')
                        #truck-icon { left: 2%; }
                    @elseif($order->shipping_status == 'packed')
                        #truck-icon { left: 20%; }
                    @elseif($order->shipping_status == 'shipped')
                        #truck-icon { left: 42%; }
                    @elseif($order->shipping_status == 'in_transit')
                        #truck-icon { left: 65%; }
                    @elseif($order->shipping_status == 'delivered')
                        #truck-icon { left: 88%; }
                    @endif
                    
                    /* Milestones */
                    .milestones {
                        position: absolute;
                        bottom: 20px;
                        left: 20px;
                        right: 20px;
                        display: flex;
                        justify-content: space-between;
                        z-index: 2;
                    }
                    
                    .milestone {
                        text-align: center;
                        width: 18%;
                    }
                    
                    .milestone-marker {
                        width: 40px;
                        height: 40px;
                        background: #fff;
                        border: 3px solid #ddd;
                        border-radius: 50%;
                        display: inline-flex;
                        align-items: center;
                        justify-content: center;
                        margin-bottom: 8px;
                        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
                        transition: all 0.4s ease;
                    }
                    
                    .milestone-marker i {
                        font-size: 18px;
                        color: #999;
                        transition: all 0.3s ease;
                    }
                    
                    .milestone.reached .milestone-marker {
                        background: #28a745;
                        border-color: #28a745;
                        transform: scale(1.1);
                        box-shadow: 0 0 0 4px rgba(40, 167, 69, 0.2),
                                    0 4px 12px rgba(0,0,0,0.25);
                    }
                    
                    .milestone.reached .milestone-marker i {
                        color: #fff;
                    }
                    
                    .milestone-label {
                        display: block;
                        font-size: 11px;
                        font-weight: 600;
                        color: #666;
                        text-transform: uppercase;
                        letter-spacing: 0.5px;
                    }
                    
                    .milestone.reached .milestone-label {
                        color: #28a745;
                        font-weight: 700;
                    }
                    
                    /* Responsive */
                    @media (max-width: 768px) {
                        .tracking-container {
                            padding: 60px 15px 40px;
                        }
                        .truck-cabin {
                            width: 28px;
                            height: 32px;
                        }
                        .truck-cargo {
                            width: 40px;
                            height: 28px;
                        }
                        .truck-window {
                            width: 16px;
                            height: 12px;
                        }
                        .wheel {
                            width: 18px;
                            height: 18px;
                        }
                        .milestone-marker {
                            width: 32px;
                            height: 32px;
                        }
                        .milestone-marker i {
                            font-size: 14px;
                        }
                        .milestone-label {
                            font-size: 9px;
                        }
                    }
                </style>
            </div>
        </div>
        <div class="col-md-6">
          <h4>Data Pelanggan</h4>
          <table class="table table-borderless">
            <tr>
              <td width="40%">Invoice</td>
              <td width="1%">:</td>
              <th>{{ $order->invoice }}</th>
            </tr>
            <tr>
              <td>Nama Penerima</td>
              <td>:</td>
              <th>{{ $order->customer_name }}</th>
            </tr>
            <tr>
              <td>No Telpn</td>
              <td>:</td>
              <th>{{ $order->customer_phone }}</th>
            </tr>
            <tr>
              <td>Alamat</td>
              <td>:</td>
              <th>{{ $order->customer_address }}, {{ $order->district->name }},
                {{ $order->district->city->type }} {{ $order->district->city->name }},
                 {{ $order->district->city->province->name }}
              </th>
            </tr>
          </table>
        </div>
        <div class="col-md-6">
          <h4>Data Pembayaran</h4>
          @if ($order->status == 0)
           <div class="alert alert-danger">
            <a href="{{ url('/customer/payment?invoice=' . $order->invoice) }}" class="text-dark">Konfirmasi pembayaran disini</a>
           </div>
          @endif
    
          @if ($order->payment)
            <table class="table table-borderless">
              <tr>
                <td width="40%">Nama Pengirim</td>
                <td width="1%">:</td>
                <th>{{ $order->payment->name }}</th>
              </tr>
              <tr>
                <td>Tanggal Transfer</td>
                <td>:</td>
                <th>{{ $order->payment->transfer_date}}</th>
              </tr>
              <tr>
                <td>Jumlah Transfer</td>
                <td>:</td>
                <th>Rp {{ number_format($order->payment->amount) }}</th>
              </tr>
              <tr>
                <td>Tujuan Transfer</td>
                <td>:</td>
                <th>{{ $order->payment->transfer_to }}</th>
              </tr>
              <tr>
                <td>Bukti Transfer</td>
                <td>:</td>
                <th>
                  <a href="{{ asset('asset/payment/' . $order->payment->proof) }}" target="_blank">
                    Lihat detail
                  </a>
                </th>
              </tr>
            </table>
          @endif
        </div>
      </div>
    
      <div class="row">
        <div class="col-md-12">
          <div class="table-responsive">
            <table class="table table-bordered text-center">
              <thead>
                <tr>
                  <th>Nama Produk</th>
                  <th>Kuantitas</th>
                  <th>Harga</th>
                  <th>Subtotal</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($order->orderDetail as $item)
                <tr>
                  <td>{{ $item->product->name }}</td>
                  <td>{{ $item->qty }}</td>
                  <td>Rp {{ number_format($item->price) }}</td>
                  <td>Rp {{ number_format($item->price * $item->qty) }}</td>
                </tr>
                @endforeach
              </tbody>
              <tfoot>
                <tr class="bg-light">
                  <td colspan="3">Subtotal</td>
                  <td>Rp {{ number_format($order->subtotal) }}</td>
                </tr>
                <tr class="bg-light">
                  <td colspan="3">Biaya Pengiriman ({{ $order->shipping_method ?? '-' }})</td>
                  <td>Rp {{ number_format($order->shipping_cost) }}</td>
                </tr>
                <tr class="bg-light">
                  <td colspan="3"><strong>Total</strong></td>
                  <td><strong>Rp {{ number_format($order->subtotal + $order->shipping_cost) }}</strong></td>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    
    </div>
</section>
@endsection
