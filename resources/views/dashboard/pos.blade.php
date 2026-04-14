@extends('layouts.dashboard')

@section('title', 'POS')
@section('page-title', 'Point of Sale')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-cart-fill me-2"></i>New Sale
                </h5>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <i class="bi bi-info-circle-fill me-2"></i>
                    <strong>Coming Soon!</strong> The POS feature is under development. You'll be able to process sales quickly here.
                </div>

                <div class="text-center py-5">
                    <i class="bi bi-cash-register fs-1 text-primary mb-3"></i>
                    <h4>Point of Sale</h4>
                    <p class="text-muted">Quickly process customer purchases</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Cart</h5>
            </div>
            <div class="card-body">
                <p class="text-center text-muted py-4">
                    <i class="bi bi-cart fs-1 d-block mb-2"></i>
                    Cart is empty
                </p>
                <hr>
                <div class="d-flex justify-content-between mb-2">
                    <span>Subtotal</span>
                    <strong>TZS 0.00</strong>
                </div>
                <div class="d-flex justify-content-between mb-3">
                    <span>Total</span>
                    <strong class="fs-5">TZS 0.00</strong>
                </div>
                <button class="btn btn-success w-100" disabled>
                    <i class="bi bi-credit-card me-2"></i>Checkout
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
