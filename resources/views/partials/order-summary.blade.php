<div class="order-summary">
    <h2 class="summary-title">Order Summary</h2>


    <div class="summary-rows">
        <div class="summary-row">
            <span class="summary-label">Subtotal</span>
            <span class="summary-value" id="subtotal">Rs. {{ number_format($total) }}</span>
        </div>

        <div class="summary-row">
            <span class="summary-label">Shipping</span>
            <span class="summary-value">Rs. {{ number_format($shipping) }}</span>
        </div>

        <div class="summary-row summary-note">
            <span>( Flat rate delivery island wide )</span>
        </div>

        <div class="summary-divider"></div>

        <div class="summary-total-row">
            <span class="summary-total-label">Total</span>
            <span class="summary-total-value" id="totalPrice">Rs. {{ number_format($grandTotal) }}</span>
        </div>

    </div>
